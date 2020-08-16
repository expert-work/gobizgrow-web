<?php use App\Customer; ?>

@extends('layouts.app')

@section('content')
 
                <!-- BEGIN CONTENT BODY -->
                     <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                   
                    <!-- END THEME PANEL -->
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
                                     <a href="{{url('estimates')}}" class="btn btn-light-warning font-weight-bolder btn-sm">Estimate</a>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Toolbar-->
                              
                            </div>
                        </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN DASHBOARD STATS 1-->
                       <div class="d-flex flex-column-fluid">
                            <!--begin::Container-->
                            <div class="container">
                                <!--begin::Dashboard-->
                                <!--begin::Row-->
                              <div class="row">
  <div class="col-lg-4">
    <!--begin::Mixed Widget 14-->
<div class="card card-custom card-stretch gutter-b">
    <!--begin::Header-->
<!--     <div class="card-header border-0 pt-5">
        <h3 class="card-title font-weight-bolder ">Action Needed</h3>
        <div class="card-toolbar">






         </div>
    </div>
 -->    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body d-flex flex-column">
               
                <div class="form-group row my-2"  
                   onclick="window.location='{{url('estimates/view/'.$selected_estimate->auth_token )}}'"
                   style="
                        padding-top: 15px;
                        border-bottom: 1px solid #e8eaf2;
                        margin-bottom: 20px !important;
                        cursor: pointer;
                        background: #fef4de;
                   ">
                    <div class="col-6">
                      <b><?php echo Customer::where('id',$selected_estimate->customer_id)->first()->name; ?></b>
                       <p>{{$selected_estimate->estimate_number}}</p>
                       <p>{{$selected_estimate->status}}</p>
                    </div>
                    <div class="col-6">
                         <b>{{usaCurrencyFormat($selected_estimate->total)}} </b>
                         <p>{{ date('m/d/Y', strtotime($selected_estimate->due_date)) }}</p>
                    </div>
                </div>


              @foreach ($estimates as $estimate)
                <div class="form-group row my-2"  
                   onclick="window.location='{{url('estimates/view/'.$estimate->auth_token )}}'"

                   style="border-bottom: 1px solid #e8eaf2;margin-bottom: 20px !important; cursor: pointer;">
                    <div class="col-6">
                      <b><?php echo Customer::where('id',$estimate->customer_id)->first()->name; ?></b>
                       <p>{{$estimate->estimate_number}}</p>
                       <p>{{$estimate->status}}</p>
                    </div>
                    <div class="col-6">
                         <b> {{usaCurrencyFormat($estimate->total)}} </b>
                         <p>{{ date('m/d/Y', strtotime($estimate->due_date)) }}</p>
                    </div>
                </div>
             @endforeach

             
            </div>

             
     <!--end::Body-->
</div>
<!--end::Mixed Widget 14-->
  </div>
  <div class="col-lg-8">
    <!--begin::Advance Table Widget 4-->
<div class="card card-custom card-stretch gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">Estimate Number: {{$selected_estimate->estimate_number}}</span>
            
        </h3>
        <div class="card-toolbar">
         @if($selected_estimate->status=='DRAFT')
          <a href="{{url('estimates/mark-as-sent/'.$selected_estimate->auth_token)}}" class="btn btn-info font-weight-bolder font-size-sm mr-3">Mark as Sent</a>
           <a href="{{url('estimates/send/'.$selected_estimate->auth_token)}}" class="btn btn-danger font-weight-bolder font-size-sm">Send Estimate</a>
         @endif
 
         @if($selected_estimate->status=='SENT')
           <!-- <a href="{{url('estimates/record-payment/'.$selected_estimate->auth_token)}}" class="btn btn-danger font-weight-bolder font-size-sm">Record Payment</a>
 -->         @endif

            



            <ul class="nav" style=" margin-left: 10px;
                                    border-radius: 5px;
                                    height: 36px;
                                    color: #3798f7;
                                    border: 1px solid #3798f7;">
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                      Action
                  </a>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{url('estimates/edit/'.$selected_estimate->auth_token)}}">Edit</a>

                    
                      <a class="dropdown-item" href="{{url('estimates/delete/'.$selected_estimate->auth_token)}}">Delete</a>

                   </div>
               </li>
                                                               
           </ul>
        </div>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-0 pb-3">
        <div class="tab-content">
            <div class="invoice-pdf-section">
                <iframe src="{{url('estimate-pdf/'.$selected_estimate->auth_token)}}" width="100%" height="600px"></iframe>

            </div>
        </div>
    </div>
    <!--end::Body-->
</div>
<!--end::Advance Table Widget 4-->
  </div>
</div>
                            <!-- END SAMPLE FORM PORTLET-->
                          
                        </div>
                        
                    </div>
                  </div>

            
@endsection
@section('css')
  <style type="text/css">
                        span.input-group-addon {
    padding: 9px;
    border: 1px solid #e5eaee;
    margin-right: .5px;
}
                    </style>
  <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{url('')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
                <!-- END PAGE LEVEL PLUGINS -->

@endsection


@section('script')

<!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{url('')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="{{url('')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
 

@endsection



