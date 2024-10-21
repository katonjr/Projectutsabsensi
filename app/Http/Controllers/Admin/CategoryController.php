<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Log;
use App\Models\RecentBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $data = Category::all();
        return view('admin.category.list',compact('data'));
    }


    public function create()
    {
        return view('admin.category.add');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_category' => 'required|unique:categories',
        ]);

        $newdata = new Category;
        $newdata->nama_category=$request->nama_category;
        $newdata->save();

        $log = new Log();
        $log->nama_table = 'categories';
        $log->items = json_encode($newdata);
        $log->deskripsi = 'Add New Categories Content';
        $log->type = 'create';
        $log->table_id = $newdata->id;
        $log->user_id = Auth::user()->id;
        $log->save();

        return redirect('admin/category')->with('success','Data Upload Successfully');


    }


    public function edit($id)
    {
        //untuk mengedit satu data berbentuk objek
        $data = Category::findOrFail($id);

        //untuk melooping banyak data
        // $datas = Category::where('id',$id)->get();
        // dd($data,$datas);

        return view('admin.category.edit',compact('data'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'nama_category' => 'required|unique:categories',
        ]);

        $data=[
            'nama_category'=>$request->nama_category
        ];

        //contoh deklarasi data banyak dengan bulk data atau memanggil variabel yang telah diberikan rumus
        $items = Category::find($id);

        $items->update($data);

        //contoh deklarasi data sendiri dengan banyak
        // Category::where('id',$id)->update(['nama_category'=>$request->nama_category]);

        $log = new Log();
        $log->nama_table = 'categories';
        $log->items = json_encode($items);
        $log->deskripsi = 'Update Categories Content';
        $log->type = 'update';
        $log->table_id = $id;
        $log->user_id = Auth::user()->id;
        $log->save();

        return redirect('admin/category')->with('success','Data Update Successfully');


    }

    public function destroy($id)
    {

        $verif=RecentBlog::where('category_id',$id)->first();
        if ($verif){
            Alert::error('Data Tidak Bisa dihapus','kategori Telah Dipakai');
            return redirect()->back();
        }

        $data = Category::findOrFail($id);

        $log = new Log();
        $log->nama_table = 'categories';
        $log->items = json_encode($data);
        $log->deskripsi = 'Delete Categories Content';
        $log->type = 'delete';
        $log->table_id = $id;
        $log->user_id = Auth::user()->id;
        $log->save();

        $data->delete();
        Alert::success('Data Telah dihapus','kategori Telah Dihapus');
        return redirect('admin/category')->with('success', 'Data Deleted Successfully ');

    }

    public function logdatacategory(Request $request, $id)
    {
       $data = Log::where('table_id', $id)->where('nama_table', 'categories')->orderByDesc('created_at')->get();
        return view('admin.category.show', compact('data'));

    }





}
