<?php use App\Customer; ?>

@extends('layouts.app')

@section('content')
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Subheader-->
                        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center flex-wrap mr-2">
                                    <!--begin::Page Title-->
                                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{$page_name}}</h5>
                                    <!--end::Page Title-->
                                    <!--begin::Actions-->
                                      <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                                     <a href="{{url('shop-admins')}}" class="btn btn-light-warning font-weight-bolder btn-sm"> Shop Admins</a>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Toolbar-->
                              
                            </div>
                        </div>
                        <!--end::Subheader-->
                        <!--begin::Entry-->
                        <div class="d-flex flex-column-fluid">
                            <!--begin::Container-->
                            <div class="container">
                                <!--begin::Dashboard-->
                                <!--begin::Row-->
                                <div class="card"> 
<!-- ////////////////////////////////////////////////////////////////////////////////////// -->

    <div class="card-body form">
                                                                          <form  action="{{url('shop-admins/edit/'.$user->id)}}" method="post">
                                       {{ csrf_field() }}
                                        <div class="form-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                                    <input disabled type="email" name="email" value="{{$user->email}}"  class="form-control" placeholder="Email Address"> </div>
                                                     
                                            </div>
                                            @error('email')
                                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                     @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                    <input type="text" name="name"  value="{{$user->name}}" class="form-control" placeholder="Name"> 
                                                </div>
                                            </div>
                                             @error('name')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                 <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                    <input type="text" name="phone" value="{{$user->phone}}" class="form-control" placeholder="Phone"> 
                                                </div>
                                              </div>
                                               @error('phone')
                                                        <span class="invalid-feedback" style="color:red" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                               @enderror
                                        </div>  

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Industry</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-industry"></i>
                                                    </span>
                                                    
                                                     <select class="form-control" name="industry">
                                                         <option value="">Select Industry</option>
                                                          @foreach($industries as $industry)
                                                              <option value="{{$industry->id}}"  @if($user->industry==$industry->id) selected @endif >
                                                                  {{$industry->industry_name}}
                                                              </option>
                                                          @endforeach
                                                    </select> 
                                                     
                                                </div>
                                            </div>
                                            @error('industry')
                                                        <span class="invalid-feedback" style="color:red" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                          <div class="form-group">
                                               <div class="input-group">
                                                 <button style="margin-left: 15px;" type="submit"  class="btn btn-primary">Submit</button>
                                             </div>
                                         </div>



                                     </div>
                                   </form>
                                </div>
<!-- ////////////////////////////////////////////////////////////////////////////////////// -->


 
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->
                    </div>
                    <style type="text/css">
                        span.input-group-addon {
    padding: 9px;
    border: 1px solid #e5eaee;
    margin-right: .5px;
}
                    </style>
@endsection
 
 

 

