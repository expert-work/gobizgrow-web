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
                                     <a href="{{url('payments')}}" class="btn btn-light-warning font-weight-bolder btn-sm"> Payments</a>
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
                                       <form  action="{{url('payments/new')}}{{isset($invoice->auth_token)? '/'.$invoice->auth_token:''}}" method="post" onsubmit="return validateForm();">
                                       {{ csrf_field() }}
                                        <div class="row">
                                      


                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="display: block;">Customer</label>
                                                  <select onchange="getInvoicesByCustomerId(this.value)" name="customer_id" id="customer_id" class="form-control" >
                                                          <option value="">Select</option>
                                                        @if(isset($customer->id))
                                                          <option selected value="{{$customer->id}}">{{$customer->name}}</option>
                                                        @endif
                                                    </select>
                                             </div>
                                             @error('customer_id')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Payment Date</label>
                                                <div class="input-group">
                                                   <div class="input-group input-medium date date-picker" data-date-format="dd/mm/yyyy" data-date-start-date="+0d">
                                                        <input type="text" class="form-control" readonly="" id="due_date" name="payment_date" value="{{(old('payment_date') !==null)?old('payment_date'):date('d/m/Y')}}" >
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>

                                         </div>
                                             @error('payment_date')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label style="display: block;">Invoice</label>
                                                      
                                                   <select name="invoice_id" onchange="setAmounts(this.value)"  id="invoice_id" class="form-control" >
                                                        <option value="">Select</option>
                                                          @if(isset($invoice->id))
                                                             <option selected value="{{$invoice->id}}">{{$invoice->invoice_number}}</option>
                                                          @endif
                                                    </select>
                                             </div>
                                             @error('invoice_id')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>



                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Payment Number</label>
                                                <div class="input-group">
                                                    
                                                    <input type="text" name="payment_number"  value="{{$payment_id}}" class="form-control" placeholder="Payment Number"> 
                                                </div>
                                            </div>
                                             @error('payment_number')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Amount($)</label>
                                                <div class="input-group">
                                                     
                                                    <input type="number" name="amount" id="amount"  onkeypress="return isNumberKey(event)" value="{{(old('amount')!==null)?old('amount'):(isset($invoice->due_amount)?$invoice->due_amount:0)}}" class="form-control" placeholder="Amount"> 

                                                    <input type="hidden" name="total_due_amount" id="total_due_amount" value="{{isset($invoice->due_amount)?$invoice->due_amount:0}}">
                                                </div>
                                                <div class="total_due_amount" style="display: block;color: #3798f7;"> @if(isset($invoice->due_amount)) Total Due Amount: $ {{$invoice->due_amount}} @endif  </div>
                                            </div>
                                             @error('amount')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Notes</label>
                                                <div class="input-group">
                                                     
                                                    <input type="text" name="notes"  value="{{old('notes')}}" class="form-control" placeholder="Notes"> 
                                                </div>
                                            </div>
                                             @error('notes')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Payment Method</label>
                                                <div class="input-group">
                                                     
                                                   <select name="payment_method_id"  class="form-control" >
                                                        @foreach($PaymentMethods as $methods)
                                                             <option value="{{ $methods->id}}" > {{ $methods->name}}</option>
                                                       @endforeach
                                                       
                                                    </select>
                                                </div>
                                            </div>
                                             @error('payment_method_id')
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
 
 

 
@section('css')
   
<style type="text/css">
    .block{
        display: block;
        clear:both;
        width: 100%;
    }

 .item_block_header{    
    padding: 10px;
    line-height: 33px;
    height: 54px;
    border: 1px solid #d4d5d6;
    font-size: 16px;
    color: #5b5b5f;
    font-weight: 600;
    margin-bottom: 5px;
    background-color: #d4d5d6;
}
 .item_block_footer{   
     margin-top: 30px;
    text-align: center;
    padding: 5px;
    line-height: 33px;
    height: 42px;
    border: 1px solid #d4d5d6;
    font-size: 16px;
    color: #3798dc;
    font-weight: 600;
    margin-bottom: 5px;
    background-color: #ffffff;
    cursor: pointer;
}

span.item_amount {
    font-size: 18px;
    color: #3798dc;
    line-height: 1.5;
}
.itmes_container {
    padding: 15px;
}
.row.block.items_row {

    margin: 0;
        margin-top: 5px;
    background: #d4d5d6;
    padding: 10px;
}
span.select2.select2-container.select2-container--bootstrap {
    background: white;
    border-radius: 5px !important;
    border: 1px solid blue;
    height: 34px;
    line-height: 33px;
    max-width: 100%;
}
</style>
@endsection



@section('script')

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

        <script type="text/javascript">

            var INVOICES_DATA=[];

    $(function() {

    $('.date-picker').datepicker({
               rtl: KTUtil.isRTL(),
               todayBtn: "linked",
               clearBtn: true,
               todayHighlight: true,
               
              });


        $("#customer_id").select2({
            minimumInputLength: 2,
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

     $("#invoice_id").select2();
    })


    function getInvoicesByCustomerId(id){ 

                                  $('#amount').val(0);
                                  $('#total_due_amount').val(0);
                                  $('.total_due_amount').html('');


           $("#invoice_id").empty();

           $("#invoice_id").select2("destroy");
           $("#invoice_id").select2({
              ajax: {
                url: API_URL+'get-invoices-by-customer_id?company_id={{Auth::user()->company_id}}&customer_id='+id,
                dataType: 'json',
                type: "POST",
                quietMillis: 50,
                 processResults: function (data) {
                        var res = data.results.map(function (item) {
                            return {id: item.id, text: item.text};
                        });
                        INVOICES_DATA= data.results; 
                    return {
                        results: res
                    };
                }
             }
        });

    }
  function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }

      function setAmounts(invoice_id) {
                        INVOICES_DATA.map(function (item) {
                            if(invoice_id==item.id){
                                  $('#amount').val(item.due_amount);
                                  $('#total_due_amount').val(item.due_amount);
                                  $('.total_due_amount').html('Total Due Amount: $ '+ item.due_amount);
                              }
                            });
      }
   

  function validateForm(){
    var amount=parseFloat($('#amount').val());
    var total_due_amount=parseFloat($('#total_due_amount').val());

     if(amount>total_due_amount){
        swal("error!", "Amount must be less or equal to total due amount ", "error");
     return false;
    }
     if(amount<1 ){
        swal("error!", "Amount must be greater or equal to zero ", "error");
     return false;
    }

  }    
        </script>
@endsection
