@extends('layouts.auth')

@section('content')
 


                    <div class="login-form ">
                            <!--begin::Form-->
                            @if (session('status'))
<div class="alert alert-success" role="alert" style="margin-top: 0;">
        {{ session('status') }}
    </div>
@endif
                            <form method="POST" action="{{ route('password.email') }}" class="form" >
  @csrf
                                 <!--begin::Title-->
                                <div class="pb-13 pt-lg-0 pt-5">
                                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
                                    <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
                                </div>
                                <!--end::Title-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                 <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6  @error('email') is-invalid @enderror " type="text" autocomplete="off" placeholder="{{ __('E-Mail Address') }}" name="email"   value="{{ old('email') }}"  required/>
                                    @error('email')
                                        <span class="invalid-feedback" style="color:red" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group d-flex flex-wrap pb-lg-0">
                                    <button type="submit" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                                    <button type="reset" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
                                </div>
                                <!--end::Form group-->
                            </form>
                            <!--end::Form-->
                        </div>

<!--  <form method="POST" action="{{ route('password.email') }}" class="login-form" >
  @csrf

    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span>Enter your email. </span>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <input class="form-control form-control-solid placeholder-no-fix form-group  @error('email') is-invalid @enderror " type="text" autocomplete="off" placeholder="{{ __('E-Mail Address') }}" name="email"   value="{{ old('email') }}"  required/>
            @error('email')
                <span class="invalid-feedback" style="color:red" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


        </div>
    
    </div>
   <div class="row">
        <div class="col-sm-12 text-right">
            <button style="width: 100%" class="btn blue" type="submit">Send Password Reset Link</button>
        </div>
    </div>

     <div class="row">
         <div style="text-align: center; margin-top: 20px">
             Don't have an account?  
             <a  class="forget-password"  href="{{ url('register') }}">
                    {{ __('Sign Up') }}
                </a> now
            </div>
    </div>


    <div class="row">
         <div style="text-align: center; ">
              
             <a  class="forget-password"  href="{{ url('login') }}">
                    {{ __('Log In') }} your account
            </a>
            </div>
    </div>
</form>


 
  -->


@endsection
