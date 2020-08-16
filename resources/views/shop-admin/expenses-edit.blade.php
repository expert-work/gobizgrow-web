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
                                     <a href="{{url('expenses')}}" class="btn btn-light-warning font-weight-bolder btn-sm"> Expenses</a>
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
 
   <form  action="{{url('expenses/edit/'.$expense->auth_token)}}" method="post" enctype="multipart/form-data">
                                       {{ csrf_field() }}
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Expense Date</label>
                                                <div class="input-group">
                                                     <div class="input-group input-medium date date-picker" data-date-format="mm/dd/yyyy" data-date-start-date="+0d">
                                                        <input type="text" class="form-control" readonly="" name="expense_date"  value="{{date('m/d/Y',strtotime($expense->expense_date))}}" >
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>

                                                </div>
                                                     
                                            </div>
                                            @error('expense_date')
                                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                     @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <div class="input-group">
                                                   
                                                    <input type="text" name="amount"  value="{{$expense->amount}}" class="form-control" placeholder="Amount"> 
                                                </div>
                                            </div>
                                             @error('amount')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Expenses Category</label>
                                                 <div class="input-group">
                                                    <select name="expense_category_id"  class="form-control" >
                                                        <option>Select</option>
                                                        @foreach($expense_categories as $expenses)
                                                        <option value="{{ $expenses->id }}" {{$expense->expense_category_id == $expenses->id  ? 'selected' : ''}}>
                                                            {{ $expenses->name }}
                                                        </option>
                                                        @endforeach
                                                    </select> 
                                                </div>
                                              </div>
                                               @error('expense_category_id')
                                                        <span class="invalid-feedback" style="color:red" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                               @enderror
                                        </div>
                                       



                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Receipt </label>
                                                      <div class="input-group">
                                                         <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="input-group input-large">
                                                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                                        <span class="fileinput-filename"></span>
                                                                    </div>
                                                                    <span class="input-group-addon btn default btn-file">
                                                                        <span class="fileinput-new"> Select file </span>
                                                                        <span class="fileinput-exists"> Change </span>
                                                                        <input type="hidden" value="" name="..."><input type="file" name="receipt"> </span>
                                                                   
                                                                </div>
                                                         </div>
                                                     </div>
                                            </div>
                                            @if(isset($expense->attachment_receipt) && $expense->attachment_receipt !='')
                                             <a href="{{url('uploads/attachment_receipt/'.$expense->attachment_receipt)}}" target="_BLANK"> Download</a>
                                            @endif
                                             @error('receipt')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label >Notes</label>
                                                <textarea class="form-control" placeholder="Notes" name="notes">{{$expense->notes}}</textarea>
                                             </div>
                                            @error('notes')
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
span.input-group-btn {
    height: 38px !important;
    border: 1px solid #e5eaee;
}
                    </style>
@endsection
 @section('script')
        <script type="text/javascript">
                 $(function() {

                         $('.date-picker').datepicker({
                           rtl: KTUtil.isRTL(),
                           todayBtn: "linked",
                           clearBtn: true,
                           todayHighlight: true,
                           
                          });
                  })
        </script>
@endsection


 


