@extends('layouts.auth')

@section('content')
            <div class="login-form ">

 

 
                    <form method="POST" action="{{ route('password.update') }}" class="form">
                        @csrf
                         <div class="pb-13 pt-lg-0 pt-5">
                                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg"><h1>BizRun {{ __('Reset Password') }}</h1></h3>
                                 
                                </div>
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group  ">
                            
                                 <input id="email" type="email"class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6  @error('email') is-invalid @enderror "  name="email" value="{{ $email ?? old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                      </div>




                         <div class="form-group ">
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('password') is-invalid @enderror" type="password" autocomplete="off" placeholder="{{ __('Password') }}" name="password" required/>  

                            @error('password')
                                <span class="invalid-feedback" style="color:red" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>      

                        <div class="form-group">
                            <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6  " type="password" autocomplete="off" placeholder="{{ __('Confirm Password') }}"  name="password_confirmation"  required/>  
                        </div>



 
                
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
      </div>          
@endsection
