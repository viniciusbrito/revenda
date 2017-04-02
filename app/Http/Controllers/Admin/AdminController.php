<?php

namespace Revenda\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Revenda\Client\User;
use Revenda\Http\Controllers\Controller;

class AdminController extends Controller
{

    function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.dashboard',['users' => User::all()]);
    }
}
