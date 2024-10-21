<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\TagsBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TagsBlogController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $data = TagsBlog::all();
        return view('admin.tagsblog.list',compact('data'));
    }

    public function create()
    {
        return view('admin.tagsblog.add');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'tags' => 'required',
        ]);

        $newdata = new TagsBlog;
        $newdata->tags=$request->tags;
        $newdata->save();

        $log = new Log();
        $log->nama_table = 'tags_blog';
        $log->items = json_encode($newdata);
        $log->deskripsi = 'Add New Tags Content';
        $log->type = 'create';
        $log->table_id = $newdata->id;
        $log->user_id = Auth::user()->id;
        $log->save();


        return redirect('admin/tagsblog')->with('success','Data Upload Successfully');


    }


    public function edit($id)
    {
        //untuk mengedit satu data berbentuk objek
        $data = TagsBlog::findOrFail($id);


        return view('admin.tagsblog.edit',compact('data'));
    }



    public function update(Request $request, $id)
    {

        $request->validate([
            'tags' => 'required',
        ]);

        $data=
        [
            'tags'=>$request->tags
        ];

        //contoh deklarasi data banyak dengan bulk data atau memanggil variabel yang telah diberikan rumus
        $items=TagsBlog::where('id',$id)->update($data);

        //contoh deklarasi data sendiri dengan banyak
        // Category::where('id',$id)->update(['nama_category'=>$request->nama_category]);

        $log = new Log();
        $log->nama_table = 'tags_blog';
        $log->items = json_encode($items);
        $log->deskripsi = 'Update Tags Content';
        $log->type = 'update';
        $log->table_id = $id;
        $log->user_id = Auth::user()->id;
        $log->save();

        return redirect('admin/tagsblog')->with('success','Data Update Successfully');


    }


    public function destroy($id)
    {
        $data = TagsBlog::findOrFail($id);
        $data->delete();

        $log = new Log();
        $log->nama_table = 'tags_blog';
        $log->items = json_encode($data);
        $log->deskripsi = 'Delete Tags Content';
        $log->type = 'delete';
        $log->table_id = $id;
        $log->user_id = Auth::user()->id;
        $log->save();

        Alert::success('Data Sukses Terhapus','Tags Telah Dihapus');
        return redirect('admin/tagsblog')->with('success', 'Data Deleted Successfully ');

    }






}
