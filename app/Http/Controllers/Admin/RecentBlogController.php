<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Log;
use App\Models\RecentBlog;
use App\Models\TagsBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class RecentBlogController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $data = RecentBlog::get();
        return view('admin.blog.list',compact('data'));
    }


        public function create()
    {

        $data = [
            "datakategori"  => Category::all(),
            "datatags"      => TagsBlog::get()
        ];
        return view('admin.blog.add',compact('data'));

    }

    public  function compress_image($source_url, $destination_url, $quality) {
        $info = getimagesize($source_url);
            if ($info['mime'] == 'image/jpeg')
                    $image = imagecreatefromjpeg($source_url);
            elseif ($info['mime'] == 'image/gif')
                    $image = imagecreatefromgif($source_url);
            elseif ($info['mime'] == 'image/png')
                    $image = imagecreatefrompng($source_url);
            imagejpeg($image, $destination_url, $quality);
        return $destination_url;
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'tanggal' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            // 'tags_id' => 'required|exists:tags_blog,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ],
        [
            'image.required' => 'Gambar Tidak Boleh Kosong',
            'tanggal.required' => 'Tanggal Tidak Boleh Kosong',
            'category_id.required' => 'Kategori Tidak Boleh Kosong',
            'judul.required' => 'Judul Tidak Boleh Kosong',
            'deskripsi.required' => 'Konten Tidak Boleh Kosong'

        ]);
        $tags       = implode(",",$request->tags_id);
        if($request->hasfile('image'))
        {
            $file = $request->file('image');

            $extenstion = $file->getClientOriginalExtension();

            $upload_imagename = Str::slug($request->judul,"-").'.'.$extenstion;

            $img = Image::make(file_get_contents($file));
            $img->save(\public_path('uploads/'. $upload_imagename));

        }

       $blog = RecentBlog::create([
            'image' => $upload_imagename,
            'tanggal' => $request->tanggal,
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul,"-"),
            'deskripsi' => $request->deskripsi,
            'user_id' => Auth::id(),
        ]);

        $tags = [];
        foreach ($request->tags_id as $tagName) {
            $tag = TagsBlog::where('tags', $tagName)->first();

            if ($tag) {
                $tags[] = $tag->id;
            }

            if (!$tag) {
                $tag = new TagsBlog();
                $tag->tags = $tagName;
                $tag->save();

                $tags[] = $tag->id;
            }
        }
        $blog->tags()->sync($tags);

        $blogLog = RecentBlog::with(['tags','namacategory'])->find($blog->id);

        $log = new Log();
        $log->nama_table = 'recent_blogs';
        $log->items = json_encode($blogLog);
        $log->deskripsi = 'Create Blog Content';
        $log->type = 'create';
        $log->table_id = $blogLog->id;
        $log->user_id = Auth::user()->id;
        $log->save();
        return redirect()->route('recentblog.index')->with('success','Data Upload Successfully');
    }


    public function edit($id)
    {
        //untuk mengedit satu data berbentuk objek
        $data           = RecentBlog::findOrFail($id);
        $datakategori   = Category::get();
        $datatag        = TagsBlog::get();

        $valtags        = explode(",", $data->tags_id);
        //untuk melooping banyak data
        // $datas = Category::where('id',$id)->get();
        // dd($data,$datas);

        // $labeltag = explode();
        return view('admin.blog.edit',compact('data','datakategori','datatag','valtags'));
    }



    public function update(Request $request, $id)
    {
     $request->validate([
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'tanggal' => 'required|date',
        'category_id' => 'required|exists:categories,id',
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',

    ],
    [
            'image.required' => 'Gambar Tidak Boleh Kosong',
            'tanggal.required' => 'Tanggal Tidak Boleh Kosong',
            'category_id.required' => 'Kategori Tidak Boleh Kosong',
            'judul.required' => 'Judul Tidak Boleh Kosong',
            'deskripsi.required' => 'Konten Tidak Boleh Kosong'

        ]
    );

    $data = RecentBlog::findOrFail($id);

    if($request->hasFile('image'))
    {
        $file = $request->file('image');
        $extenstion = $file->getClientOriginalExtension();

        $upload_imagename = Str::slug($request->judul,"-").'.'.$extenstion;

        $img = Image::make(file_get_contents($file));
        $img->save(\public_path('uploads/'. $upload_imagename));
        $data->image        = $upload_imagename;
    }
    $data->tanggal      = $request->tanggal;
    $data->category_id  = $request->category_id;
    $data->judul        = $request->judul;
    $data->deskripsi    = $request->deskripsi;
    $data->slug         = Str::slug($request->judul,"-");
    $data->save();

    $tags = [];

    foreach ($request->tags_id as $tagName) {
        $tag = TagsBlog::firstOrCreate(['tags' => $tagName]);
        $tags[] = $tag->id;
    }

    $data->tags()->sync($tags);

    // Mencatat update
    $blogLog = RecentBlog::with(['tags','namacategory'])->find($data->id);

    $log = new Log();
    $log->nama_table = 'recent_blogs';
    $log->items = json_encode($blogLog);
    $log->deskripsi = 'Update Blog Content';
    $log->type = 'update';
    $log->table_id = $blogLog->id;
    $log->user_id = Auth::user()->id;
    $log->save();

    return redirect()->route('recentblog.index')->with('success', 'Data Updated Successfully');
}


    public function destroy($id)
    {
        $data = RecentBlog::findOrFail($id);
        File::delete(public_path('uploads/'.$data->image));

        $log = new Log();
        $log->nama_table = 'recent_blogs';
        $log->items = json_encode($data);
        $log->deskripsi = 'Delete Blog Content';
        $log->type = 'delete';
        $log->table_id = $id;
        $log->user_id = Auth::user()->id;
        $log->save();

        $data->delete();
        Alert::success('Data Sukses Terhapus','Artikel Telah Dihapus');
        return redirect()->route('recentblog.index')->with('success', 'Data Deleted Successfully ');

    }


    public function logdatarecentblog(Request $request, $id)
    {
       $data = Log::where('table_id', $id)->where('nama_table', 'recent_blogs')->orderByDesc('created_at')->get();
        return view('admin.blog.show', compact('data'));

    }


 }
