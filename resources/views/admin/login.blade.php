<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Portal | {{ ($setting)?$setting->title:trans('panel.site_title') }}</title>
    @if(isset($setting))
    <link rel = "icon" href ="{{asset('storage/uploads/logo/'.$setting->logo)}}" type = "image/x-icon">
    @else
    <link rel = "icon" href ="{{asset('logo.svg')}}" type = "image/x-icon">
    @endif
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- to accept http while server running on https -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">  
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('/backend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/backend/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('/backend/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/backend/dist/css/adminlte.min.css')}}">

    <link rel="stylesheet" href="{{ asset('/css/admin/login.css')}}">
</head>

<body class="hold-transition login-page">
    <section>
        <div class="imgBx">
            @if(isset($setting))
            <img src="{{asset('storage/uploads/logo/'.$setting->logo)}}" alt="logo" style="height:auto" />
            @else
            <img src="{{asset('logo.svg')}}" alt="logo" style="height:auto" />
            @endif
        </div>
        <div class="contentBx">
            <div class="formBx">
                <h2 style="border-bottom: 4px solid #F68635;" >Login</h2>
                <form action="{{ route('admin.login') }}" method="post">
                    {{ csrf_field() }}
                    <div class="inputBx">
                        <span>Email</span>
                        <input type="text" name="email" />
                    </div>
                    <div class="inputBx">
                        <span>Password</span>
                        <input type="password" name="password" />
                    </div>
                    <div class="remember-container">
                        <input class="form-check-input remember-checkbox" style="cursor: pointer;" type="checkbox"
                            name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label offset-md-1" for="remember"
                            style="margin: 3px 2em; cursor: pointer;">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="inputBx">
                        <input type="submit" class="submit" value="Log In" style="background:#F68635" />
                    </div>
                    <div class="error-container">
                        @if ($errors->has('email'))
                        <span class="error" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                        @if ($errors->has('password'))
                        <span class="error" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                        @if ($errors->has('invalid'))
                        <span class="error invalid" role="alert">
                            <strong>{{ $errors->first('invalid') }}</strong>
                        </span>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- jQuery 3 -->
    <script src="{{ asset('/backend/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('/backend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>


</body>

</html>
