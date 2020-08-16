@extends('layouts.app')

@section('content')
 
                <!-- BEGIN CONTENT BODY -->
                     <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                   
                    <!-- END THEME PANEL -->
                    <h3 class="page-title"> {{$page_name}}
                     </h3>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="{{url('')}}">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>{{$page_name}}</span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <a href="{{url('customers')}}" type="button" class="btn btn-fit-height grey-salt " data-delay="1000" data-close-others="true"> Customer
                                 </a>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN DASHBOARD STATS 1-->
                        <div class="row">
                        <div class="col-md-12 ">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-red-sunglo">
                                        <i class="icon-settings font-red-sunglo"></i>
                                        <span class="caption-subject bold uppercase"> {{$page_name}}</span>
                                    </div>
                               
                                </div>
                                <div class="portlet-body form">
                                    <form  action="{{url('customers/edit/'.$customer->id)}}" method="post">
                                       {{ csrf_field() }}
                                        <div class="form-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                                    <input disabled type="email" name="email" value="{{$customer->email}}"  class="form-control" placeholder="Email Address"> </div>
                                                     
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
                                                    <input type="text" name="name"  value="{{$customer->name}}" class="form-control" placeholder="Name"> 
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
                                                    <input type="text" name="phone" value="{{$customer->phone}}" class="form-control" placeholder="Phone"> 
                                                </div>
                                              </div>
                                               @error('phone')
                                                        <span class="invalid-feedback" style="color:red" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                               @enderror
                                        </div>  

                                       
                                          <div class="form-group">
                                               <div class="input-group">
                                                 <button style="    margin-top: 23px; margin-left: 15px;" type="submit"  class="btn blue">Submit</button>
                                             </div>
                                         </div>



                                     </div>
                                   </form>
                                </div>
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->
                          
                        </div>
                        
                    </div>
                 <!-- END CONTENT BODY -->
@endsection
@section('css')

  <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{url('')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
                <!-- END PAGE LEVEL PLUGINS -->

@endsection


@section('script')

<!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{url('')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="{{url('')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
 

@endsection



