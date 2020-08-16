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


                                <!-- ////////////////////////////////////Filter -->
                                  <div class="alert alert-custom alert-white alert-shadow gutter-b filter-section" role="alert">
                                  <form id="filter-form" style="width: 100%">
                                     <div class="row" style="width: 100%">
                                       <div class="col-md-4">
                                         <label>Report Type</label>
                                         <div class="form-group">
                                               <select name="type" id="type" class="form-control" >
                                                            <option value="customer">By Customer</option>
                                                            <option value="item">By Item</option>
                                               </select>
                                           </div>
                                       </div>
                                
                                    <?php
                                          $date=strtotime(date("Y-m-d H:i:s"));
                                          $month=date('m',$date);
                                          $year=date('Y',$date);
                                          $days=date('t',$date);
                                          $sdates=$year."-".$month."-01 00:00:00";
                                          $edates=$year."-".$month."-".$days." 23:59:59";
                                          $range= date('m/d/Y', strtotime($sdates)).' / '.date('m/d/Y', strtotime($edates));
                                    ?>


                                       <div class="col-md-4">
                                         <label>Select Date Range</label>     
                                              <div class='input-group' id='kt_daterangepicker_6'>
                                                  <input type='text' id="filter_date_range"  value="{{$range}}" class="form-control" readonly="readonly" placeholder="Select date range" />
                                                  <div class="input-group-append">
                                                    <span class="input-group-text">
                                                      <i class="la la-calendar-check-o"></i>
                                                    </span>
                                                  </div>
                                                </div>
                                       </div>
                                        
                                       <div class="col-md-4">
                                          <label>&nbsp;</label>
                                              <button type="button"   onclick="filterFuncton();" style="margin-top: 25px;float: right;" class="btn-xs btn   btn-primary">Update Report</button>
                                               
                                       </div>
                                     </div>
                                  </form>
                              </div>

                                <!-- ////////////////////FilterClose -->
                                <div class="card"> 
<!-- ////////////////////////////////////////////////////////////////////////////////////// -->

                                    <div class="card-body" style="display: block;">
                                      <!-- Content put here -->
                                       <div class="card-body" style="display: block;">
                                          <!-- Content put here -->
                                           <div id="report-div"> 
                                             
                                           </div>
                                        </div>
                                    </div>
<!-- ////////////////////////////////////////////////////////////////////////////////////// -->


 
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->
                    </div>
@endsection
 
@section('script')

     <script src="{{url('theme/html/demo1/dist')}}/assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js?v=7.0.4"></script>
     <script type="text/javascript">
         function filterFuncton(){
               var type= $('#type').val();
               var range= $('#filter_date_range').val();
               var url= '{{url('pdf/reports/sales?company_id='.Auth::user()->company_id)}}&type='+type+'&range='+range;
               var html=`<iframe style="width: 100%; height: 500px" src="`+url+`"> </iframe>`;
               $('#report-div').html(html);
         }
        
        $(function() {
          filterFuncton();
        });

     </script>
@endsection 

