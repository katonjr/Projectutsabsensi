<?php

namespace App\Http\Controllers;

use App\Models\AboutMe;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\ContactUs;
use App\Models\Destiny;
use App\Models\FeaturedPlace;
use App\Models\Galerry;
use App\Models\Log;
use App\Models\RecentBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class WebController extends Controller
{
    public function index()
    {
        $datablog = RecentBlog::get();

        $datafeatured = FeaturedPlace::get();
        return view('index',compact('datablog','datafeatured'));
    }

    public function page(Request $request)
    {
        $slug                = $request->segment(1);
        // $path                = $request->path();

        if($slug == 'about'){
            $dataabout = AboutMe::first();
            return view('about',compact('dataabout'));
            // return view('about');
        }


        // if($slug == 'gallery'){
        //     $datagallery = Galerry::get();

        //     $datapopular = Destiny::get();

        //     $datafeatured = FeaturedPlace::get();
        //     return view('gallery',compact('datagallery','datafeatured','datapopular'));

        // }
        if ($slug == 'gallery') {
            $datagallery = Galerry::paginate(3);
            $datapopular = Destiny::get();
            $datafeatured = FeaturedPlace::get();

            if (request()->ajax()) {
                return view('partials.gallery-items', compact('datagallery'))->render();
            }

            return view('gallery', compact('datagallery', 'datafeatured', 'datapopular'));
        }


        if($slug == 'contact'){

            $datacontact = Contact::first();
            return view('contact',compact('datacontact'));

        }

        if($slug == 'blog'){

            $datablog = RecentBlog::where('judul','like','%'.$request->search.'%')->get();

            return view('blog',compact('datablog'));

        }

        if($slug == 'detail'){
            return view('detail');

        }
            return redirect('/');
    }


    public function comment(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'pesan' => 'required|string'
        ]);

        Comment::create([
            'nama' => $request->nama,
            'pesan' => $request->pesan,
            'status' => Comment::PENDING,
            'recent_blog_id' =>  $request->blog_id
        ]);


        Alert::success('Horayy', 'Comment Send Successfully');
        return redirect()->back();

    }




    public function showComments()
    {
        $approvedComments = Comment::approved();
        return view('page.comments', compact('approvedComments'));
    }


    public function detailblog($slug)
    {
        $blog = RecentBlog::with('tags')->where('slug',$slug)->first();
        $datablog = RecentBlog::where('category_id', $blog->category_id)
                          ->where('id', '!=', $blog->id)
                          ->inRandomOrder()
                          ->paginate(4);
        $approvedComments = Comment::where('recent_blog_id',$blog->id)
        ->where('status', Comment::APPROVED)
        ->get();
        return view('detail',compact('blog','datablog','approvedComments'));
    }


    public function contactUs(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required|string'
        ]);

        $newdata = new ContactUs;
        $newdata->nama=$request->nama;
        $newdata->email=$request->email;
        $newdata->pesan=$request->pesan;
        $newdata->status= ContactUs::UNREAD;
        $newdata->save();


        // $log = new Log();  // Corrected variable initialization
        // $log->nama_table = 'contact_us';
        // $log->items = json_encode($newdata);  // Log the saved data
        // $log->deskripsi = 'Incoming Email From User';
        // $log->type = 'update';
        // $log->save();

        // Session::flash('sukses','Pesan Anda Telah Terkirim');
        Alert::success('Horayy', 'Message Send Successfully');
        return redirect()->back();

    }

}
