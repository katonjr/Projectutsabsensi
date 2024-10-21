<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    //
    public function index(Request $request)
    {
        $logs = Log::orderBy('created_at', 'desc')->paginate(20);

        if($request->key=='view'){
            $datalog = Log::find($request->iddetail);
            return view('admin.log.view',compact('datalog'));
        }
        else{

            return view('admin.log.list', ['logs' => $logs]);
        }


    }

}
