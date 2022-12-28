<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;
use App\Services\User\UserService;
use App\Ultities\Constants;
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
    private OrderService $orderService;

    protected LoginForm $loginForm;
    protected RegisterFrom $registerFrom;

    public function __construct(UserService $userService,
                                OrderService $orderService,
                                LoginForm $loginForm,
                                RegisterFrom $registerFrom)
    {
        $this->userService = $userService;
        $this->orderService = $orderService;
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
//            return \redirect('./');
            return redirect()->intended('');
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
        $formData['level'] = Constants::USER_LEVEL_CLIENT;
        $formData['password'] = Hash::make($formData['password']);
        $this->userService->Create($formData);

        return redirect('account/login')
                ->with('notification','Register success! Please login to continue.');
    }

    public function myOrder()
    {
        $orders= $this->orderService->getOrdersByUserId(Auth::id());
        return view('front.account.my-order.index',compact('orders'));
    }

    public function orderDetails($orderId)
    {
        $order = $this->orderService->Find($orderId);
        return view('front.account.my-order.show',compact('order'));
    }
}
