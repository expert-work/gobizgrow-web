@extends('layouts.auth')

@section('content')

 <div class="login-form login-signin">
                            <!--begin::Form-->
                             <form method="POST" action="{{ route('login') }}" class="form"  >
                                {{ csrf_field() }}

                                 <!--begin::Title-->
                                <div class="pb-13 pt-lg-0 pt-5">
                                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Welcome to GoBizGrow</h3>
                                    <span class="text-muted font-weight-bold font-size-h4">New Here?
                                    <a href="{{ url('register') }}"  class="text-primary font-weight-bolder">Create an Account</a></span>
                                </div>
                                <!--begin::Title-->
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                    <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('email') is-invalid @enderror" type="text" autocomplete="off" placeholder="{{ __('E-Mail Address') }}" name="email"   value="{{ old('email') }}"  required/>
                                    @error('email')
                                    <span class="invalid-feedback" style="color:red" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--end::Form group-->
                                <!--begin::Form group-->
                                <div class="form-group">

                                    <div class="d-flex justify-content-between mt-n5">
                                        <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                                        <a href="{{ route('password.request') }}" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" >Forgot Password ?</a>
                                    </div>
                                    
                                     <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg @error('password') is-invalid @enderror" type="password" autocomplete="off" placeholder="{{ __('Password') }}" name="password" id="currentPass" required/>  
                                       <i onclick="show('currentPass')" class="fas fa-eye-slash password_eye" style="position: absolute;margin-top: -40px;right: 40px;" id="display"></i>


                                    @error('password')
                                        <span class="invalid-feedback" style="color:red" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror


                                </div>
                                <!--end::Form group-->
                                <!--begin::Action-->
                                <div class="pb-lg-0 pb-5">
                                    <button   type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign In</button>
                                    
                                </div>
                                <!--end::Action-->
                            </form>
                            <!--end::Form-->
                        </div>


 


    @endsection
