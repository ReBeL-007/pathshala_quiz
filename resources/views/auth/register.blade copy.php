<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- to accept http while server running on https -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="css/style.css" /> -->
    <link rel = "icon" href ="{{asset('fav.png')}}" type = "image/x-icon">
    <link rel="stylesheet" href="{{asset('css/login/register-sign-in.css')}}" />
    <title>Pathshala</title>
</head>

<body>
    <div class="container sign-up-mode">
        <div class="forms-container">
            <div class="signin-signup">
                @php
                    $courses = App\Course::get();
                @endphp
                <form action="{{route('register')}}" method="POST" class="sign-up-form">
                    @csrf
                
                    <h2 class="title">Sign up</h2>
                    <div class="col-md-6">
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Name" name="new-name" value="{{ old('new-name', null) }}" autocomplete="new-name" />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-envelope"></i>
                            <input type="email" placeholder="Email"  value="{{ old('new-email', null) }}" name="new-email" autocomplete="new-email"  autocomplete="off"/>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Password" name="password"  autocomplete="password"/>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Confirm Password" name="password_confirmation"  autocomplete="password_confirmation" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-field">
                            <i class="fas fa-envelope"></i>
                            <input type="text" placeholder="Contact"  value="{{ old('new-contact', null) }}" name="new-contact" autocomplete="new-contact"  autocomplete="off"/>
                        </div>
                        
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <select class="input-field {{ $errors->has('course_id') ? 'is-invalid' : '' }}" name="course_id" id="course_id" >
                                <option value="">Select course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course') ? 'selected' : '' }}>{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="text" placeholder="Previous School" value="{{ old('new-school', null) }}" name="new-school"  autocomplete="new-school"/>
                        </div>

                        <input type="submit" class="btn" value="Sign up" />
                        @if ($errors->has('new-name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ str_replace('new-','',$errors->first('new-name')) }}</strong>
                        </span>
                        @endif
                        @if ($errors->has('new-email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ str_replace('new-','',$errors->first('new-email'))}}</strong>
                        </span>
                        @endif
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password')}}</strong>
                        </span>
                        @endif
                        @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password_confirmation')}}</strong>
                        </span>
                        @endif
                        @if ($errors->has('new-school'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ str_replace('new-','',$errors->first('new-school'))}}</strong>
                        </span>
                        @endif
                        @if ($errors->has('new-invalid'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ str_replace('new-','',$errors->first('new-invalid')) }}</strong>
                        </span>
                        @endif
                        <!-- <p class="social-text">Or Sign up with social platforms</p>
                        <div class="social-media">
                            <a href="#" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div> -->
                    </div>
                </form>
            </div>
        </div>

        <!-- <div class="panels-container">
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p style="text-transform:uppercase">
                    Pathshala Nepal Foundation
                    </p>
                    <p>
                    Pathshala was founded in 2004 AD as co-educational English Medium School to cater the need of quality schooling in the context of 21st century learning.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">Sign in</button>
                </div>
                <img src="{{asset('img/register.svg')}}" class="image" alt="" />
            </div>
        </div> -->
    </div>
    <script src="{{ asset('/backend/plugins/jquery/jquery.min.js')}}"></script>
    <!-- <script src="{{asset('js/login/registerSigninapp.js')}}"></script> -->
    {{-- <script>
       $(function(){
            const href = window.location.href.split('#');
            const modal = href[href.length-1];
            if(window.location.href.indexOf(modal) != -1) {
            if(modal == 'register'){
                $('.container').addClass('sign-up-mode');
            }
            }

            $(document).on('click','#sign-in-btn','#sign-up-btn',function(){
                $('.invalid-feedback').remove();
            });
        });
    </script>--}}
</body>

</html>
