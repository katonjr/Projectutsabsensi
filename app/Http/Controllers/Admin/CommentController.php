<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    public function index()
    {
        $data = Comment::all();
        $showApproveButton = true;

        // dd($datas);
        return view('admin.comment.list', compact('data', 'showApproveButton'));
    }


    public function show (Request $request, $id)
    {
        $data = Comment::find($id);
        if($request->key == 'view')
        {
            // Ubah status menjadi READ jika komentar dilihat
            Comment::where('id',$id)->update(['status' => Comment::READ]);
            return view('admin.comment.show', compact('data'));
        }
        else
        {
            // Tambahkan logika untuk menampilkan tombol approve
            $showApproveButton = ($data->status == Comment::PENDING || $data->status == Comment::UNREAD);

            // Simpan status komentar dalam session
            session(['comment_status' => $data->status]);

            return view('admin.comment.show', compact('data', 'showApproveButton'));
        }
    }


    public function store (Request $request)
    {
        // dd ($request->all());
        $request->validate([
            'nama' => 'required',
            'pesan' => 'required'
        ]);

        Comment::create([
            'nama' => $request->nama,
            'pesan' => $request->pesan,
            'status' => Comment::PENDING
        ]);


        return redirect()->route('comment.index')->with('success','komen terkirim');

    }


    public function destroy($id)
    {
        $data = Comment::findOrFail($id);
        $data->delete();

        $log = new Log();
        $log->nama_table = 'comments';
        $log->items = json_encode($data);
        $log->deskripsi = 'Deleted Comment Blog';
        $log->type = 'delete';
        $log->table_id = $id;
        $log->user_id = Auth::user()->id;
        $log->save();

        Alert::success('Komentar Sukses Terhapus');
        return redirect()->route('comment.index')
        ->with('success','Comment Deleted Successfully');

    }

    public function approve($id)
{
    $comment = Comment::findOrFail($id);
    $comment->update(['status' => Comment::APPROVED]);

    Alert::success('Pesan Berhasil Di Tampilkan');

    return redirect()->route('comment.index')->with('success', 'Comment Approved Successfully');
}

}
