@extends('layouts.app')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Winku Social Network Toolkit</title>

<link rel="icon" href="{{URL::asset('assets/images/fav.png')}}" type="image/x-icon"/>

<link href="{{URL::asset('assets/css/main.min.css')}}" rel="stylesheet">

<link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet"/>

<link href="{{URL::asset('assets/css/color.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{URL::asset('assets/css/responsive.css')}}">
        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">
	<div class="container-fluid pdng0">
		<div class="row merged">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="land-featurearea">
					<div class="land-meta">
						<h1>Winku</h1>
						<p>
							Winku is free to use for as long as you want with two active projects.
						</p>
						<div class="friend-logo">
							<span><img src="{{URL::asset('assets/images/wink.png')}}" alt=""></span>
						</div>
						<a href="#" title="" class="folow-me">Follow Us on</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="login-reg-bg">

                <!--login -->
					<div class="log-reg-area sign">
						<h2 class="log-title">Login</h2>
							<p>
								Don’t use Winku Yet? <a href="#" title="">Take the tour</a> or <a href="#" title="">Join now</a>
							</p>
						   <form method="POST" action="{{ route('login') }}">
                              @csrf
							<div class="form-group">
							  <input id="input" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
							  <label class="control-label" for="input">Email</label><i class="mtrl-select"></i>

                               @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


							</div>
							<div class="form-group">
							  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>

							  <label class="control-label" for="input">Password</label><i class="mtrl-select"></i>

                               @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

							</div>

							<div class="checkbox">
							  <label>
								<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                                /><i class="check-box"></i>Always Remember Me.
							  </label>
							</div>
							<a href="{{ route('password.request') }}" title="" class="forgot-pwd">Forgot Password?</a>
							<div class="submit-btns">
								<button class="mtr-btn signin" type="submit"><span>Login</span></button>
                                <button class="mtr-btn signup" type="button"><span>Register</span></button>
							</div>
						</form>
					</div>

                <!--register -->
                    <div class="log-reg-area reg">
                                <h2 class="log-title">Register</h2>
                                    <p>
                                        Don’t use Winku Yet? <a href="#" title="">Take the tour</a> or <a href="#" title="">Join now</a>
                                    </p>
                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                            {{-- name --}}
							<div class="form-group">
							  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
							  <label class="control-label" for="input">Name</label><i class="mtrl-select"></i>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>


                            {{-- email --}}
							<div class="form-group">
							  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"/>

							  <label class="control-label" for="input">Email</label><i class="mtrl-select"></i>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>

                            {{-- Password --}}
							<div class="form-group">
							  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"/>
							  <label class="control-label" for="input">Password</label><i class="mtrl-select"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>


                           {{-- Confirm Password --}}
							<div class="form-group">
							  <input id="password-confirm" type="password"class="form-control" name="password_confirmation" required autocomplete="new-password"/>
							  <label class="control-label" for="input">Confirm Password</label><i class="mtrl-select"></i>
							</div>


							<div class="form-radio">
							  <div class="radio">
								<label>
								  <input type="radio" name="gender" checked="checked" value="1"/><i class="check-box"></i>Male
								</label>
							  </div>
							  <div class="radio">
								<label>
								  <input type="radio" name="gender" value="2"/><i class="check-box"></i>Female
								</label>
							  </div>
							</div>



							<div class="submit-btns">
								<button class="mtr-btn " type="submit"><span>Register</span></button>
                                <a href="{{ route('login') }}" title="" class="already-have">Already have an account ?</a>
							</div>
						</form>
                            </div>


                        </div>
                        </div>



	</div>
</div>



    <script src="{{URL::asset('assets/../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
	<script src="{{URL::asset('assets/js/main.min.js')}}"></script>
	<script src="{{URL::asset('assets/js/script.js')}}"></script>

</body>

</html>


@endsection




