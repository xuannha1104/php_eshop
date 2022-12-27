@extends('front.layout.master')

@section('title','Register')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="./"><i class="fa fa-home">Home</i> </a>
                        <span>Register</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Register Section Begin -->
    <div class="register-login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Register</h2>
                        <form action="" method="post">
                            @csrf
                            <div class="group-input">
                                <label for="username">Username<span>*</span></label>
                                <input type="text" id="name" name="name">
                                @if (count($errors) > 0)
                                    @if($errors->has("name"))
                                            <ul>
                                            @foreach ($errors->get('name') as $message)
                                                <li style="color:red">{{ $message }}</li>
                                            @endforeach
                                            </ul>
                                    @endif
                                @endif
                            </div>
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
                            <div class="group-input">
                                <label for="confirm-pass">Confirm Password <span>*</span></label>
                                <input type="password" id="confirm-pass" name="password_confirmation">
                                @if (count($errors) > 0)
                                    @if($errors->has("password_confirmation"))
                                        <ul>
                                            @foreach ($errors->get('password_confirmation') as $message)
                                                <li style="color:red">{{ $message }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            </div>
                            <button type="submit" class="site-btn register-btn">Sign Up</button>
                        </form>
                        <div class="switch-login">
                            <a href="{{route('login')}}" class="or-login">Or Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Section End -->
@endsection
