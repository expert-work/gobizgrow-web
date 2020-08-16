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
                                     <a href="{{url('expenses-categories')}}" class="btn btn-light-warning font-weight-bolder btn-sm"> Expense Categories</a>
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
                                      

                                      <form  action="{{url('expenses-categories/new')}}" method="post">
                                       {{ csrf_field() }}
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div class="input-group">
                                                    
                                                    <input type="text" name="name" value="{{old('name')}}"  class="form-control" placeholder="Name"> </div>
                                                     
                                            </div>
                                            @error('name')
                                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                     @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <div>
                                                    <textarea class="form-control" name="description">{{old('description')}}</textarea>
                                                </div>           
                                            </div>
                                            @error('description')
                                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                     @enderror
                                        </div>

                                        
                                          

                                        
                                        <div class="form-group">
                                               <div class="input-group">
                                                 <button style="min-width: 250px;    margin-top: 23px; margin-left: 15px;" type="submit"  class="btn btn-primary">Submit</button>
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
 
 

 

