
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Register</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/backend/images/Laravel.png')}}">
    <link href="{{asset('/backend/css/style.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/91662dfc40.js" crossorigin="anonymous"></script>
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
					
					<div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="{{asset('/backend/images/laravel_logo.png')}}" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4 text-white">Sign up your account</h4>
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf
                                        {{-- Name Section Starts --}}
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Name</strong></label>
                                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your name" value="{{ old('name') }}">

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- Name Section Ends --}}

                                        {{-- Email Section Starts --}}
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Email</strong></label>
                                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="hello@example.com" value="{{ old('email') }}">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- Email Section Ends --}}

                                        {{-- Password Section Starts --}}
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Password</strong></label>
                                            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="Password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- Password Section Ends --}}

                                        {{-- Confirm Password Section Starts --}}
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Confirm Password</strong></label>
                                            <input name="password_confirmation" type="password" class="form-control" value="Password">
                                        </div>
                                        {{-- Confirm Password Section Ends --}}

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn bg-white text-primary btn-block">Sign me up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <span class="text-white">Already have an account? <a class="text-white" href="{{ route('login') }}"><span class="font-italic font-weight-bold">Sign in</span></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{asset('/backend/vendor/global/global.min.js')}}"></script>
<script src="{{asset('/backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('/backend/js/custom.min.js')}}"></script>
<script src="{{asset('/backend/js/deznav-init.js')}}"></script>

</body>
</html>

