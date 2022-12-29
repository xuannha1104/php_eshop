<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Ultities\Constants;
use App\Ultities\Validation\FormValidationException;
use App\Ultities\Validation\LoginForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    protected LoginForm $loginForm;

    public function __construct(LoginForm $loginForm)
    {
        $this->loginForm = $loginForm;
    }

    public function getLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $formData = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        try {
            //validate
            $this->loginForm->validate($formData);
        }
        catch (FormValidationException $e){
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }

        $formData['level'] = [Constants::USER_LEVEL_HOST,Constants::USER_LEVEL_ADMIN];

        $remember = $request->remember;
        if(Auth::attempt($formData,$remember))
        {
            return redirect()->intended(route('UserManager'));
        }
        else
        {
            return Redirect::back()->with('notification','Error! E-mail or Password is incorrect.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('adminLogin'));
    }
}
