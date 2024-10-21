<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutMe;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutMeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $data = AboutMe::get();
        // dd($datas);
        return view('admin.aboutme.list', compact('data'));
    }



    public function edit($id)
    {
        $data = AboutMe::findOrFail($id);
        return view('admin.aboutme.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'nama' => 'required|string',
            'deskripsi' => 'required|string'
        ]);

        // dd($request->all());

        $data = AboutMe::findOrFail($id);

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads', $filename);
            $data->image = $filename;
        }


        $data->nama = $request->nama;
        $data->deskripsi = $request->deskripsi;
        $data->save();

        $log = new Log();
        $log->nama_table = 'about_me';
        $log->items = json_encode($request);
        $log->deskripsi = 'Update Information About Me';
        $log->type = 'update';
        $log->table_id = $data->id;
        $log->user_id = Auth::user()->id;
        $log->save();

        return redirect()->route('aboutme.index')->with('success','Data Updated Successfully');
    }




}
