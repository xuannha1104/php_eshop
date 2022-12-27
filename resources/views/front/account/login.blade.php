@extends('front.layout.master')

@section('title','Login')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./"><i class="fa fa-home">Home</i> </a>
                        <span>Login</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Login Section Begin -->
    <div class="register-login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Login</h2>

                        @if(session('notification'))
                            @if(str_contains(session('notification'),'Error:'))
                                <div class="alert alert-danger">
                                    {{session('notification')}}
                                </div>
                            @else
                                <div class="alert alert-success">
                                    {{session('notification')}}
                                </div>
                            @endif
                        @endif

                        <form action="" method="post">
                            @csrf
                            <div class="group-input">
                                <label for="email">E-mail address <span>*</span></label>
                                <input type="email" id="email" name="email">
                                @if (count($errors) > 0)
                                    @if($errors->has("email"))
                                        <ul>
                                            @foreach ($errors->get('email') as $message)
                                                <li style="color:red">{{ $message }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            </div>
                            <div class="group-input">
                                <label for="password">Password <span>*</span></label>
                                <input type="password" id="password" name="password">
                                @if (count($errors) > 0)
                                    @if($errors->has("password"))
                                        <ul>
                                            @foreach ($errors->get('password') as $message)
                                                <li style="color:red">{{ $message }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <label for="save-pass">
                                        Save Password
                                        <input type="checkbox" id="save-pass" name="remember">
                                        <span class="checkmark"></span>
                                    </label>
                                    <a href="#" class="forget-pass">Forget your Password?</a>
                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn">Sign In</button>
                        </form>
                        <div class="switch-login">
                            <a href="{{route('register')}}" class="or-login">Or Create An Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Section End -->
@endsection
