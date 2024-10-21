<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destiny;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DestinyController extends Controller
{
    public function index()
    {
        $data = Destiny::get();
        return view('admin.destiny.list',compact('data'));
    }

    public function create(){
        return view('admin.destiny.add');
    }

    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|string'
        ]);

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads', $filename);
            $image = $filename;
        }

       $destinasi= Destiny::create([
            'image' => $image,
            'deskripsi' => $request->deskripsi
        ]);

        $log = new Log();
        $log->nama_table = 'destiny';
        $log->items = json_encode($destinasi);
        $log->deskripsi = 'Add New Content Destination';
        $log->type = 'create';
        $log->table_id = $destinasi->id;
        $log->user_id = Auth::user()->id;
        $log->save();

        return redirect()->route('destiny.index')->with('success','Data Upload Successfully');
    }


    public function edit($id)
    {
        //untuk mengedit satu data berbentuk objek
        $data           = Destiny::findOrFail($id);

        return view('admin.destiny.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required|string'
        ]);

        // dd($request->all());

        $data = Destiny::findOrFail($id);

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads', $filename);
            $data->image = $filename;
        }

        $data->deskripsi = $request->deskripsi;
        $data->save();

        $log = new Log();
        $log->nama_table = 'destiny';
        $log->items = json_encode($data);
        $log->deskripsi = 'Update Content Destination';
        $log->type = 'update';
        $log->table_id = $id;
        $log->user_id = Auth::user()->id;
        $log->save();

        return redirect()->route('destiny.index')->with('success','Data Updated Successfully');
    }

    public function destroy($id)
    {
        $data = Destiny::findOrFail($id);
        $data->delete();

        $log = new Log();
        $log->nama_table = 'destiny';
        $log->items = json_encode($data);
        $log->deskripsi = 'Delete Content Destination';
        $log->type = 'delete';
        $log->table_id = $id;
        $log->user_id = Auth::user()->id;
        $log->save();

        Alert::success('Data Sukses Terhapus','Artikel Telah Dihapus');
        return redirect()->route('destiny.index')->with('success', 'Data Deleted Successfully ');

    }


}
