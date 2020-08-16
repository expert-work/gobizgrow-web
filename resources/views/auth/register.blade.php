<?php 
use App\Industry;   

$Industries=Industry::where('status','1')->get();
?>
@extends('layouts.auth')

@section('content')
<div class="login-form">
                            <!--begin::Form-->
                            <form method="POST" action="{{ route('register') }}" class="form" >
@csrf

                                <!--begin::Title-->
                                <div class="pb-13 pt-lg-0 pt-5">
                                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Sign Up</h3>
                                    <span class="text-muted font-weight-bold font-size-h4">Already have Account?
                                    <a href="{{ url('login') }}"  class="text-primary font-weight-bolder">Login now</a></span>

                                </div>
                                <!--end::Title-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                     
                                      <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('name') is-invalid @enderror" type="text" autocomplete="off" placeholder="{{ __('Your name/Company Name') }}" name="name"   value="{{ old('name') }}"  />
                                        @error('name')
                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                   
                                     <input class=" form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror" type="text" autocomplete="off" placeholder="{{ __('E-Mail Address') }}" name="email"   value="{{ old('email') }}"  required/>
                                    @error('email')
                                        <span class="invalid-feedback" style="color:red" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>









                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                     
                                     <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('password') is-invalid @enderror" type="password" id="password" autocomplete="off" placeholder="{{ __('Password') }}" name="password" required/>
                                     <i onclick="show('password')" class="fas fa-eye-slash password_eye" style="position: absolute;margin-top: -40px;right: 40px;" id="display"></i>  

                                    @error('password')
                                        <span class="invalid-feedback" style="color:red" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                               <div class="form-group">
                                 <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6  " type="password" autocomplete="off" placeholder="{{ __('Confirm Password') }}"  name="password_confirmation" id="confirm-password"  required/>
                                <i onclick="show('confirm-password')" class="fas fa-eye-slash password_eye" style="position: absolute;margin-top: -40px;right: 40px;" id="display"></i>  
                               </div>
                                <!--end::Form group-->
                                   


                               <div class="form-group">
                                   
                                   <input class=" form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('phone') is-invalid @enderror" type="text" autocomplete="off" placeholder="{{ __('Phone Number') }}" name="phone"   value="{{ old('phone') }}"  required/>
                                    @error('phone')
                                        <span class="invalid-feedback" style="color:red" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <select class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('industry') is-invalid @enderror" name="industry" required style="border: 0; margin-bottom: 28px;border-bottom: 1px solid #a2a2af;"> 
                                        <option value=""> Industry</option>
                                        @foreach($Industries as $Industry)
                                        <option value="{{$Industry->id}}">{{$Industry->industry_name}}</option>
                                         @endforeach
                                    </select>
                                   
                                    @error('industry')
                                        <span class="invalid-feedback" style="color:red" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                                              <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <label class="checkbox mb-0">
                                    <input type="checkbox" required name="agree" />I Agree the
                                    <a href="">terms and conditions</a>.
                                    <span></span></label>
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
                                    <button type="submit" id="kt_login_signup_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                                    <button type="reset" id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</button>
                                </div>
                                <!--end::Form group-->
                            </form>
                            <!--end::Form-->
                        </div>



<!-- 
<h1>BizRun SignUp</h1>
<p> </p>
 <form method="POST" action="{{ route('register') }}" class="login-form" >
@csrf

    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span>Enter All required fields. </span>
    </div>
    <div class="row">

        <div class="col-xs-6">
            <input class="form-control form-control-solid placeholder-no-fix form-group @error('name') is-invalid @enderror" type="text" autocomplete="off" placeholder="{{ __('Name') }}" name="name"   value="{{ old('name') }}"  required/>
            @error('name')
                <span class="invalid-feedback" style="color:red" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-xs-6">
            <input class="form-control form-control-solid placeholder-no-fix form-group @error('email') is-invalid @enderror" type="text" autocomplete="off" placeholder="{{ __('E-Mail Address') }}" name="email"   value="{{ old('email') }}"  required/>
            @error('email')
                <span class="invalid-feedback" style="color:red" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-xs-12">

        	<select class="form-control form-control-solid placeholder-no-fix form-group @error('industry') is-invalid @enderror" name="industry" required style="border: 0; margin-bottom: 28px;border-bottom: 1px solid #a2a2af;"> 
        		<option value=""> Industry</option>
                @foreach($Industries as $Industry)
        		<option value="{{$Industry->id}}">{{$Industry->industry_name}}</option>
        		 @endforeach
        	</select>
           
            @error('industry')
                <span class="invalid-feedback" style="color:red" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


         <div class="col-xs-6">
            <input class="form-control form-control-solid placeholder-no-fix form-group @error('password') is-invalid @enderror" type="password" autocomplete="off" placeholder="{{ __('Password') }}" name="password" required/>  

            @error('password')
                <span class="invalid-feedback" style="color:red" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>       
        <div class="col-xs-6">
            <input class="form-control form-control-solid placeholder-no-fix form-group " type="password" autocomplete="off" placeholder="{{ __('Confirm Password') }}"  name="password_confirmation"  required/>  
        </div>
    </div>
    <div class="row">
        
        <div class="col-sm-12 text-right">
            <button style="width: 100%" class="btn blue" type="submit">Sign Up</button>
        </div>

    </div>
    <div class="row">
    	 <div style="text-align: center; margin-top: 20px">
             Already have an account?  
             <a  class="forget-password"  href="{{ url('login') }}">
                    {{ __('Log In') }}
                </a>
            </div>
    </div>
</form>
  -->


<style type="text/css">
    @media only screen and (max-width: 600px) {
     .aside-img.d-flex.flex-row-fluid.bgi-no-repeat.bgi-position-y-bottom.bgi-position-x-center {
    display: none !important;
}
    .login-aside.d-flex.flex-column.flex-row-auto {
            padding-bottom: 40px !important;
            background-color: #ffffff  !important;
        }


    }

</style>
@endsection
