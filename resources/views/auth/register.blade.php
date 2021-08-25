<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pathshala</title>
    <link rel = "icon" href ="{{asset('fav.png')}}" type = "image/x-icon">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
      integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{ asset('site/css/login.css')}}" />
    <style>
        .btn--log {
            padding: 1rem 2rem;
            border: none;
            cursor: pointer;
            background-color: hsl(25, 91%, 40%);
        }
        .invalid-feedback {
            color: red !important;
        }
    </style>
    <script src="{{ asset('site/js/formManipulate.js')}}" defer></script>
  </head>
  <body>
    <section class="section-log">
      <div class="row-log">
        <div class="brandLogo">
          <img src="{{ asset('pathshala.png')}}" alt="Pathshala" />
        </div>
        <div class="logIn__form">
            @php
                $courses = App\Course::get();
            @endphp
          <form action="{{route('register')}}" method="POST" class="form">
            @csrf
            <div class="form__group">
                <input type="text" class="form__input" placeholder="Full Name*" name="new-name" value="{{ old('new-name', null) }}" autocomplete="new-name" required/>     
                <label for="fullName" class="form__label">Full Name*</label>
                @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form__group">
                <input type="email" class="form__input" placeholder="Email*"  value="{{ old('new-email', null) }}" name="new-email" autocomplete="new-email"  autocomplete="off" required/>
                <label for="email" class="form__label">Email*</label>
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email')}}</strong>
                </span>
                @endif
            </div>

            <div class="form__group">
                <input type="password" class="form__input" placeholder="Password*" name="password"  autocomplete="password" required/>   
                <label for="password" class="form__label">Password*</label>
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password')}}</strong>
                </span>
                @endif
            </div>

            <div class="form__group">
                <input type="password" class="form__input" placeholder="Confirm Password*" name="password_confirmation"  autocomplete="password_confirmation"  required/>
                <label for="password" class="form__label">Confirm Password*</label>
                @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password_confirmation')}}</strong>
                </span>
                @endif
            </div>

            <div class="form__group">
                <input type="number" class="form__input" placeholder="Contact*" value="{{ old('new-contact', null) }}" name="new-contact" autocomplete="new-contact"  autocomplete="off" required/>
                <label for="phoneNumber" class="form__label">Contact*</label>
                @if ($errors->has('contact'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('contact') }}</strong>
                </span>
                @endif
            </div>

            <div class="form__group">
                <select class="form__input form__input--select {{ $errors->has('course_id') ? 'is-invalid' : '' }}" name="course_id" id="course_id" required>
                    <option value="">Select course*</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course') ? 'selected' : '' }}>{{ $course->title }}</option>
                    @endforeach
                </select>
                <label
                for="course_id"
                class="form__label select-effect select-label__hide"
                >Select course*</label>
                @if ($errors->has('course_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('course_id') }}</strong>
                </span>
                @endif
            </div>

            <div class="form__group">
                <input type="text" class="form__input" placeholder="Previous School*" name="new-school" value="{{ old('new-school', null) }}" autocomplete="new-school"  required/>
                <label for="new-school" class="form__label">Previous School*</label>
                @if ($errors->has('school'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('school')}}</strong>
                </span>
                @endif
            </div>

            <div class="form__group align-end invalid-feedback">
              <p>* : required fields</p>
            </div>

            <div class="form__group align-center">
              <button class="btn btn--log">Register</button>
            </div>

            <div class="form__group">
              <div class="other--option">
                <ul class="options__links">
                  <li>
                    <a href="{{route('login')}}">
                      <span class="icon"
                        ><i class="fas fa-arrow-right"></i
                      ></span>
                      <span class="effect">Log In</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{route('home')}}">
                      <span class="icon"
                        ><i class="fas fa-arrow-right"></i
                      ></span>
                      <span class="effect">Home</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

            <!-- <div class="form-group">
              <span>Or Sign In With</span>
            </div> -->
          </form>
        </div>
      </div>
    </section>
  </body>
</html>
