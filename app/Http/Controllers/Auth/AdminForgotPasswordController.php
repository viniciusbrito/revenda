<?php

namespace Revenda\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Revenda\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class AdminForgotPasswordController extends Controller
{

    function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('guest:admin');
    }

    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    public function sendResetLinkEmail()
    {
        $this->validate($this->request, [
            'email' => 'required|email'
        ]);

        $response = $this->broker()->sendResetLink(
            $this->request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->sendResetLinkFailedResponse($this->request, $response);
    }

    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', trans($response));
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()->withErrors(
            ['email' => trans($response)]
        );
    }

    public function broker()
    {
        return Password::broker('admins');
    }
}
