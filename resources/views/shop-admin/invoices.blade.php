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
                                     
                                  @if((Auth::user()->subscription_status  !='ACTIVE') && ($subscriptionStatus['days']<1))
                                       <a href="javascript:;"  onclick="openNewInvEstiPopup('{{url('invoices/new')}}')" class="btn btn-light-warning font-weight-bolder btn-sm">Add Invoice</a>
                                  @else
                                      <a href="{{url('invoices/new')}}" class="btn btn-light-warning font-weight-bolder btn-sm">Add Invoice</a>
                                  @endif

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


                              <div class="alert alert-custom alert-white alert-shadow gutter-b filter-section" role="alert" @if(isset($_REQUEST['filter']) && $_REQUEST['filter']=='show') @else   style="display: none;"  @endif  >
                                  <form id="filter-form" style="width: 100%">
                                     <div class="row" style="width: 100%">
                                       <div class="col-md-3">
                                         <label>Customer</label>
                                         <div class="form-group">
                                               <select name="customer_id" id="filter_customer_id" class="form-control" >
                                                            <option value="">Select</option>
                                                          @if(isset($_REQUEST['filter_customer_id']) && $_REQUEST['filter_customer_id']>0)

                                                          
                                                            <option selected value="{{$_REQUEST['filter_customer_id']}}">{{Customer::where('id',$_REQUEST['filter_customer_id'])->first()->name}}</option>
                                                          @endif
                                               </select>
                                           </div>
                                       </div>
                                       <div class="col-md-2">
                                         <label>Status</label>
                                         <div class="form-group">

                                          <?php
                                           if(!isset($_REQUEST['filter_status'])){
                                             if($type=='dues'){ $_REQUEST['filter_status']='DUE'; }
                                             if($type=='drafts'){ $_REQUEST['filter_status']='DRAFT'; }
                                            
                                           }
                                          ?>
                                           <select name="status" id="filter_status" class="form-control" >
                                                            <option value="">Select</option>
                                                              <option @if(isset($_REQUEST['filter_status']) && $_REQUEST['filter_status']=='DRAFT')  selected  @endif>DRAFT</option>
                                                              <option @if(isset($_REQUEST['filter_status']) && $_REQUEST['filter_status']=='SENT')  selected  @endif>SENT</option>
                                                              <option @if(isset($_REQUEST['filter_status']) && $_REQUEST['filter_status']=='DUE')  selected  @endif>DUE</option>
                                                              <option @if(isset($_REQUEST['filter_status']) && $_REQUEST['filter_status']=='PAID')  selected  @endif>PAID</option>
                                                              <option @if(isset($_REQUEST['filter_status']) && $_REQUEST['filter_status']=='UNPAID')  selected  @endif>UNPAID</option>
                                                              <option @if(isset($_REQUEST['filter_status']) && $_REQUEST['filter_status']=='PARTIALLY PAID')  selected  @endif>PARTIALLY PAID</option>
                                                         
                                           </select>
                                         </div>
                                       </div>
                                       <div class="col-md-3">



                                         <label>From - To</label>     
                                              <div class='input-group' id='kt_daterangepicker_6'>
                                                  <input type='text' id="filter_date_range"  @if(isset($_REQUEST['filter_date_range']) && $_REQUEST['filter_date_range'] !='') value="{{$_REQUEST['filter_date_range']}}"   @endif class="form-control" readonly="readonly" placeholder="Select date range" />
                                                  <div class="input-group-append">
                                                    <span class="input-group-text">
                                                      <i class="la la-calendar-check-o"></i>
                                                    </span>
                                                  </div>
                                                </div>

                                        
                                             
                                       </div>
                                       <div class="col-md-2">
                                         <label>Invoice Number</label>
                                          <div class="input-group">
                                            <input type="text"  @if(isset($_REQUEST['filter_invoice_number']) && $_REQUEST['filter_invoice_number'] !='') value="{{$_REQUEST['filter_invoice_number']}}"   @endif  class="form-control" id="filter_invoice_number" placeholder="INV00000001" name="">
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <label>&nbsp;</label>
                                              <button type="button"   onclick="filterFuncton();" style="margin-top: 25px;float: right;" class="btn-xs btn   btn-primary">Filter</button>
                                              <button  onclick="resetFilter();"  type="button" style="float: right;margin-right: 5px;margin-top: 25px;" class="btn-xs btn   btn-danger">Reset</button>
                                       </div>
                                     </div>
                                  </form>
                              </div>

                                <!--begin::Row-->
                                <div class="card"> 
<!-- ////////////////////////////////////////////////////////////////////////////////////// -->

                              <div class="card-body" style="display: block;">

 
                                        <div class="row">
                                      <div class=" col-sm-8 "> 
                                          <ul class="nav nav-tabs" id="myTab" role="tablist" style="max-width: 206px;">
                                              <li class="nav-item ">
                                                <a class="nav-link @if($type=='all') active @endif"  href="{{url('invoices')}}">
                                                  
                                                  <span class="nav-text">All</span>
                                                </a>
                                              </li>
                                              <li class="nav-item ">
                                                <a class="nav-link @if($type=='drafts') active @endif"    href="{{url('invoices/drafts')}}" >
                                                 
                                                  <span class="nav-text">Draft</span>
                                                </a>
                                              </li>
                                              
                                              <li class="nav-item ">
                                                <a class="nav-link @if($type=='dues') active @endif "   href="{{url('invoices/dues')}}" >
                                                  <span class="nav-text">Due</span>
                                                </a>
                                              </li>
                                            </ul>
                                       </div>

                                      <div class="col-sm-4 "> 
                                        <div class="topnav">
                                          <button type="button" style="float: right;border-bottom-right-radius: 0;border-bottom-left-radius: 0;" class="btn pull-right btn-primary text-uppercase font-weight-bolder px-15 py-3"

                                           onclick="
                                               
                                                $( '.filter-section' ).toggle();
                                           " 
                                          >Filter</button>
 
                                          </div>

                                       </div>
                                    </div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->
                                    <div class="my_custom_table">   
                                      <div class="d-flex align-items-center  custom_table_row">
                                      	 <div class="flexPoint4" style=""> <center> <input type="checkbox" id="selectall"/></center> </div>
                                      	 <div class="flexTwo" style=""><div class="border-right"> <b>Invoice Number</b> <br> Customer Name </div></div>
                                      	 <div class="flexOne" style=""><div class="border-right"> <b>Date </b><br> Due Date </div></div>
                                      	 <div class="flexOnePoint5" style=""> <div class="border-right"> <b>Status</b><br> Due Amount </div></div>
                                      	 <div class="flexPoint8" style="">Action </div>
                                       </div>
                                      <form  action="{{url('multidelete')}}" id="tableForm" method="post" onsubmit="return confirmOnce(event);" >
                                        
                                       {{ csrf_field() }}
                                       @foreach ($invoices as $invoice)
                                       <div class="d-flex align-items-center  custom_table_row">
                                      	 
                                      	 <div class="flexPoint4" style="">
                                      	          <center> <input type="checkbox" class="case" name="isdelete[]" value="{{$invoice->id }}"/></center>
                                      	 </div>

                                      	 <div class="flexTwo" style=""><div class="border-right"> 
                                      	 	        <b>{{$invoice->invoice_number}}</b> <br> <?php echo Customer::where('id',$invoice->customer_id)->first()->name; ?> 
                                      	 </div></div>

                                      	 <div class="flexOne" style=""><div class="border-right">
                                      	      <b>{{ date('m/d/Y', strtotime($invoice->invoice_date)) }} </b><br> {{ date('m/d/Y', strtotime($invoice->due_date)) }} 
                                      	 </div></div>


                                      	 <div class="flexOnePoint5" style=""> <div class="border-right"> 
                                      	 	     <b>{{$invoice->status}}</b><br> {{usaCurrencyFormat($invoice->due_amount)}} 
                                      	 </div></div>

                                      	 <div class="flexPoint8" style="">
                                                             <ul class="nav">
                                                                  <li class="nav-item dropdown">
                                                                      <a href="javascript:;" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<i class="ki ki-bold-more-hor"></i>
																		</a>
                                                                      <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                                          <a class="dropdown-item" href="{{url('invoices/edit/'.$invoice->auth_token)}}">Edit</a>
                                                                          <a class="dropdown-item" href="{{url('invoices/view/'.$invoice->auth_token)}}">View</a>
                                                                          <a class="dropdown-item" onclick="deleteInvoice('{{$invoice->auth_token}}')" href="javascript:;">Delete</a>
                                                                          <a class="dropdown-item" href="{{url('invoices/clone/'.$invoice->auth_token)}}">Clone Invoice</a>
                                                                          @if($invoice->status=='DRAFT')
                                                                            <a class="dropdown-item" href="{{url('invoices/send/'.$invoice->auth_token)}}">Send Invoice</a>
                                                                            <a class="dropdown-item" href="{{url('invoices/mark-as-sent/'.$invoice->auth_token)}}">Mark as Sent</a>
                                                                          @endif
                                                                          @if($invoice->status=='SENT')
                                                                            <a class="dropdown-item" href="{{url('invoices/send/'.$invoice->auth_token)}}">Resend Invoice</a>
                                                                            <a class="dropdown-item" href="{{url('/payments/new/'.$invoice->auth_token)}}">Record Payment</a>
                                                                          @endif

                                                                          @if($invoice->status=='COMPLETED') @endif 
                                                                       </div>
                                                                   </li>
                                                              </ul>

                                      	  </div>
                                       </div>
                                       @endforeach
                                       <input type="hidden" name="model" value="Invoice">
                                        <div class="row">
                                           <div class="col-md-6">
                                              {{ $invoices->withQueryString()->links() }}
                                           </div>
                                           <div class="col-md-6">
                                            <input type="hidden" name="" id="confirm_delete">
                                                 <button onclick="deleteAll()" style="float: right;" type="submit"  class="btn btn-danger pull-right btn-sm">Multiple Delete</button>
                                            </div>
                                        </div>
                                      </form> 
                                     </div>
 									 
<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->

 

                                   
                                </div>
<!-- ////////////////////////////////////////////////////////////////////////////////////// -->


 
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->
                    </div>

<!--                   <div class="fab"> + </div>
 -->
 @endsection
 
 @section('css')
<style type="text/css">
     .inv-status-sent{ 
      background: rgba(246, 208, 154, 0.4);
    font-size: 13px;
    color: #A96E1A;
    padding: 5px 10px;
  }
  .inv-status-draft {
    font-size: 13px;
    color: rgb(108, 67, 46);
    background: rgb(248, 237, 203);
    padding: 5px 10px;
}
.inv-status-unpaid {
    background: #F8EDCB;
    font-size: 13px;
    color: #6C432E;
    padding: 5px 10px;
  }
  .inv-status-paid {
    background: rgba(246, 208, 154, 0.4);
    font-size: 13px;
    color: #A96E1A;
    padding: 5px 10px;
  }

span.select2.select2-container.select2-container--bootstrap {
    background: white;
    border-radius: 5px !important;
    border: 1px solid blue;
    height: 34px;
    line-height: 33px;
    max-width: 100%;
}

span.select2.select2-container {
    width: 100% !important;
}
</style>

  
@endsection


@section('script')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
          <script src="{{url('theme/html/demo1/dist')}}/assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js?v=7.0.4"></script>

        <script type="text/javascript">
                function deleteInvoice(id){
                       swal({
                              title: "Are you sure?",
                              text: "Once deleted, you will not be able to recover!",
                              icon: "warning",
                              buttons: true,
                              dangerMode: true,
                            })
                            .then((willDelete) => {
                              if (willDelete) { window.location.href='{{url('invoices/delete/')}}/'+id; }  
                       });
                    }




function confirmOnce(e){
  var confirm_delete= $('#confirm_delete').val();
  if(confirm_delete !='confirm'){
                e.preventDefault();
               swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                     $('#confirm_delete').val('confirm');
                     $('#tableForm').submit();
                } else {
                        return false;

                }
              });

    }
  }


  $(function() {
      $('#filter_status').select2();
      $('.date-picker_1').datepicker({
               rtl: KTUtil.isRTL(),
               todayBtn: "linked",
               clearBtn: true,
               todayHighlight: true,
               
              });


            $('.date-picker_2').datepicker({
               rtl: KTUtil.isRTL(),
               todayBtn: "linked",
               clearBtn: true,
               todayHighlight: true,
               
              });


        $("#filter_customer_id").select2({
              ajax: {
                url: API_URL+'get-customers?company_id={{Auth::user()->company_id}}',
                dataType: 'json',
                type: "POST",
                quietMillis: 50,
                 processResults: function (data) {
                        var res = data.results.map(function (item) {
                            return {id: item.id, text: item.text};
                        });
                    return {
                        results: res
                    };
                }
             }
        });


     })





function resetFilter(){
   var status= $('#filter_status').val();
   if(status=='DRAFT'){
    window.location='{{url("invoices/drafts")}}'
   }
   if(status=='DUE'){
    window.location='{{url("invoices/dues")}}'
   }
   window.location='{{url("invoices")}}'

}


 function filterFuncton(){
       var filter_status= $('#filter_status').val();
       var filter_customer_id= $('#filter_customer_id').val();
       var filter_invoice_number= $('#filter_invoice_number').val();
       var filter_date_range= $('#filter_date_range').val();

    var url='';
    url='{{url("invoices")}}'
   if(filter_status=='DRAFT'){
    url='{{url("invoices/drafts")}}'
   }
   if(filter_status=='DUE'){
    url='{{url("invoices/dues")}}'
   }
 window.location= url+'?filter=show&filter_customer_id='+filter_customer_id+'&filter_status='+filter_status+'&filter_invoice_number='+filter_invoice_number+'&filter_date_range='+filter_date_range;
 }                                                                                                                                                                                                                                                                                                                                                                                                                                                                    


$(function(){
$('#selectall').on('click' ,function(){
if($(this). prop("checked") == true){
$(".case").parent('span').addClass('checked');
$(".case"). prop("checked", true);
}else{
$(".case").parent('span').removeClass('checked');
$(".case"). prop("checked", false);
}
});
});
       </script>
@endsection

