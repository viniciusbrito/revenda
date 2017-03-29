<?php

namespace Revenda\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Revenda\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    protected $redirectTo = '/admin';

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('guest:admin');
    }

    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login()
    {
        /*Validaçao das credenciais*/
        $this->validate($this->request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $credenciais = [
            'email' => $this->request->email,
            'password' => $this->request->password,
        ];
        $lembrarme = $this->request->remember;

        /*Tenta realizar login*/
        if(Auth::guard('admin')->attempt($credenciais, $lembrarme)) {

            return redirect()->intended(route('admin.dashboard'));
        }

        /*Se falhar retorna p/ pg de login*/
        return redirect()->back()->withInput($this->request->only('email', 'remember'));
    }

    public function logout()
    {
        $this->guard()->logout();

        $this->request->session()->flush();

        $this->request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
