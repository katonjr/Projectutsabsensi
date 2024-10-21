<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\FeaturedPlace;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class FeaturedPlaceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //Tampil Data Function
    public function index()
    {
        $data = FeaturedPlace::all();
        return view('admin.featuredplace.list',compact('data'));
    }

    public function addfeaturedplace(){
        return view('admin.featuredplace.add');
    }


    // Tambah Data Function
    public function insertdatafeatured(Request $request){

    $request->validate([
        'tempat' => 'required',
        'deskripsi' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk tipe dan ukuran gambar
    ]);

        $FeaturedPlace = new FeaturedPlace;
        $FeaturedPlace->tempat = $request->input('tempat');
        $FeaturedPlace->deskripsi = $request->input('deskripsi');

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads', $filename);
            $FeaturedPlace->image = $filename;
        }
        $FeaturedPlace->save();

        $log = new Log();
        $log->nama_table = 'featured_place';
        $log->items = json_encode($FeaturedPlace);
        $log->deskripsi = 'Add New Featured Content';
        $log->type = 'create';
        $log->table_id = $FeaturedPlace->id;
        $log->user_id = Auth::user()->id;
        $log->save();

        return redirect('admin/featured/featuredplace')->with('success','Image Upload Successfully');
    }

    // Edit Data Function
    public function tampildatafeatured($id){
    $data = FeaturedPlace::find($id);
    return view('admin.featuredplace.edit', compact('data'));
    }

    //Update Data Function
    public function updatedatafeatured(Request $request, $id){
        $FeaturedPlace = FeaturedPlace::find($id);
        $FeaturedPlace->tempat = $request->input('tempat');
        $FeaturedPlace->deskripsi = $request->input('deskripsi');

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads', $filename);
            $FeaturedPlace->image = $filename;
        }

        $log = new Log();
        $log->nama_table = 'featured_place';
        $log->items = json_encode($FeaturedPlace);
        $log->deskripsi = 'Update Featured Content';
        $log->type = 'update';
        $log->table_id = $id;
        $log->user_id = Auth::user()->id;
        $log->save();

        $FeaturedPlace->save();
        return redirect('admin/featured/featuredplace')->with('success','Data Update Successfully');
    }

    //Delete Data
    public function destroy($id)
    {
        $featuredPlace = FeaturedPlace::findOrFail($id);

        $log = new Log();
        $log->nama_table = 'featured_place';
        $log->items = json_encode($featuredPlace);
        $log->deskripsi = 'Delete Image Galerry';
        $log->type = 'delete';
        $log->table_id = $id;
        $log->user_id = Auth::user()->id;
        $log->save();

        $featuredPlace->delete();
        Alert::success('Data Sukses Terhapus','konten unggulan Telah Dihapus');
        return redirect('admin/featured/featuredplace')->with('success', 'Data Successfully Deleted');
    }
    public function logdatafeatured(Request $request, $id)
    {
       $data = Log::where('table_id', $id)->where('nama_table', $request->nama_table)->orderByDesc('created_at')->get();
        return view('admin.featuredplace.show', compact('data'));

    }

}
