<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    //Alternatif routing
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated(Request $request)
    {
        return redirect('/admin/home');
    }

    public function __construct()
    {
        $this->middleware('guest');
    }


}
