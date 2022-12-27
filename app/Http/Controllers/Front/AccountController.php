<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use App\Ultities\Validation\FormValidationException;
use App\Ultities\Validation\LoginForm;
use App\Ultities\Validation\RegisterFrom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    private UserService $userService;

    protected LoginForm $loginForm;
    protected RegisterFrom $registerFrom;

    public function __construct(UserService $userService,
                                LoginForm $loginForm,
                                RegisterFrom $registerFrom)
    {
        $this->userService = $userService;
        $this->loginForm = $loginForm;
        $this->registerFrom = $registerFrom;
    }

    public function login()
    {
        return view('front.account.login');
    }
    public function checkLogin(Request $request)
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
        $remember = $request->remember;
        if(Auth::attempt($formData,$remember))
        {
            return \redirect('./');
        }
        else
        {
            return Redirect::back()->with('notification','Error: E-mail or Password is incorrect.');
        }


    }

    public function logout()
    {
        Auth::logout();
        return back();
    }

    public function register()
    {
        return view('front.account.register');
    }

    public function checkRegister(Request $request)
    {

        $formData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ];
        try {
            //validate
            $this->registerFrom->validate($formData);
        }
        catch (FormValidationException $e){
            return Redirect::back()->withInput()->withErrors($e->getErrors());
        }
        $formData['level'] = 2;
        $formData['password'] = Hash::make($formData['password']);
        $this->userService->Create($formData);

        return redirect('account/login')
                ->with('notification','Register success! Please login to continue.');
    }
}
