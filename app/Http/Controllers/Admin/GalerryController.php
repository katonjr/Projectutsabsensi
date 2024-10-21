<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galerry;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class GalerryController extends Controller
{
    public function index()
    {
        $data = Galerry::get();
        return view('admin.galerry.list',compact('data'));
    }

    public function create(){
        return view('admin.galerry.add');
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads', $filename);
            $image = $filename;
        }
        $gambar=Galerry::create([
            'image' => $image,
        ]);

        $log = new Log();
        $log->nama_table = 'image';
        $log->items = json_encode($gambar);
        $log->deskripsi = 'Add New Image Galerry';
        $log->type = 'create';
        $log->table_id = $gambar->id;
        $log->user_id = Auth::user()->id;
        $log->save();

        return redirect()->route('galerry.index')->with('success','Data Upload Successfully');
    }

    public function edit($id)
    {
        //untuk mengedit satu data berbentuk objek
        $data           = Galerry::findOrFail($id);

        return view('admin.galerry.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // dd($request->all());

        $data = Galerry::findOrFail($id);

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads', $filename);
            $data->image = $filename;
        }

        $data->save();

        $log = new Log();
        $log->nama_table = 'image';
        $log->items = json_encode($data);
        $log->deskripsi = 'Update Image Galerry';
        $log->type = 'update';
        $log->table_id = $id;
        $log->user_id = Auth::user()->id;
        $log->save();

        return redirect()->route('galerry.index')->with('success','Data Updated Successfully');
    }


    public function destroy($id)
{
    $data = Galerry::findOrFail($id);

    // Create a new log entry
    $log = new Log();
    $log->nama_table = 'image';
    $log->items = json_encode($data);
    $log->deskripsi = 'Delete Image Galerry';
    $log->type = 'delete';
    $log->table_id = $id;
    $log->user_id = Auth::user()->id;
    $log->save();

    // Delete the data after logging
    $data->delete();

    Alert::success('Data Sukses Terhapus','Gambar Telah Dihapus');
    return redirect()->route('galerry.index')->with('success', 'Data Deleted Successfully');
}



}

