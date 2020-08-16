@extends('layouts.app')

@section('content')
@include('includes.add-customer')
@include('includes.add-item')
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
                                     <a href="{{url('estimates')}}" class="btn btn-light-warning font-weight-bolder btn-sm">Estimates</a>
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
                                <div class="row"> 






<!-- ////////////////////////////////////////////////////////////////////////////////////// -->
<div class="col-lg-12"> 
    <div class="card card-custom card-stretch gutter-b"> 
       <div class="card-body pt-0 pb-3">
           
  
                                     <form  action="{{url('estimates/edit/'.$estimate->auth_token)}}" method="post"  enctype="multipart/form-data" onsubmit="return formValidation();" >
                                       {{ csrf_field() }}
                                        <div class="form-body">
                                <div class="row" style="    padding-top: 40px !important;padding: 20px;">     

                                      <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Estimate Date</label>
                                                <div class="input-group">
                                                   <div class="input-group input-medium date date-picker_1" data-date-format="mm/dd/yyyy" data-date-start-date="+0d">
                                                        <input type="text" class="form-control" readonly="" id="estimate_date" name="estimate_date" value="{{date('m/d/Y',strtotime($estimate->estimate_date))}}" >
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('estimate_date')
                                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                     @enderror
                                        </div>

                                      <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Due Date</label>
                                                <div class="input-group">
                                                   <div class="input-group input-medium date date-picker_2" data-date-format="mm/dd/yyyy" data-date-start-date="+0d">
                                                        <input type="text" class="form-control" readonly="" id="due_date" name="due_date" value="{{date('m/d/Y',strtotime($estimate->estimate_date))}}" >
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                                     @error('due_date')
                                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                     @enderror
                                        </div>                                        


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>estimate Number/Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                     </span>
                                                    <input type="text" name="estimate_number" id="estimate_number" value="{{$estimate->estimate_number}}" class="form-control" placeholder="123453"> 
                                                </div>
                                            </div>
                                             @error('estimate_number')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                         <div class="col-md-3">
                                            <div class="form-group">
                                                <label style="display: block;">Customer</label>
                                                      <div class=" block item_block_footer" onclick="selectCustomerModelPopup()">
                                                     <div class="col-md-12 col-sm-12 col-xs-12"> 
                                                       <span id="customer_name">{{isset($customer->name)?$customer->name:''}}</span>
                                                     </div>
                                                </div>
                                                <input type="hidden"  name="customer_id" value="{{isset($customer->id)?$customer->id:''}}" id="customer_id">


                                            </div>
                                             @error('customer_id')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                  </div>
 
<!-- ============================Add New Items Start================================ -->
<div class="itmes_container">

    <div class="row block item_block_header" style="margin: 0;" >
        <div class="col-md-5 col-sm-5 col-xs-5"> 
           <span>Items</span>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <span>Quantity</span>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
         <span>Price</span>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
         <span>Amount</span>
        </div>
         <div class="col-md-1 col-sm-1 col-xs-1">
         <span></span>
        </div>
       
    </div>

   <?php
      $uniqId= 'it'.rand().rand().rand();
      $firstItem=$estimateItems[0];
    ?>
    
    <div class="row block items_row" id="{{$uniqId}}">
        <div class="col-md-5 col-sm-5 col-xs-5"> 
          


           
           <div class=" block item_block_footer" onclick="selectItemModelPopup('{{$uniqId}}')">
             <div class="col-md-12 col-sm-12 col-xs-12"> 
               <span id="{{$uniqId}}_item_name"> {{$firstItem->name}}</span>
             </div>
            </div>
            <input type="hidden"  id="{{$uniqId}}_item" required  value="{{$firstItem->item_id}}" name="item_id[{{$uniqId}}]"  >


            <textarea class="form-control" id="{{$uniqId}}_note"   name="note_id[{{$uniqId}}]"  rows="3" placeholder="Description...">{{$firstItem->notes}}</textarea>

        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <input type="number"  value="{{$firstItem->quantity}}"  name="quantity[{{$uniqId}}]" onchange="calCulate()"   onkeyup="calCulate()"   min="1"  class="form-control" id="{{$uniqId}}_quantity"  required   onkeypress="return isNumberKey(event)">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
         <input type="text"  class="form-control" required  value="{{$firstItem->price}}"  name="price[{{$uniqId}}]"   onchange="calCulate()" onkeyup="calCulate()"  min="1" id="{{$uniqId}}_price" onkeypress="return isNumberKey(event)">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
         $ <span class="item_amount" id="{{$uniqId}}_amount" >{{$firstItem->total}}</span>
        </div>
        <div class="col-md-1 col-sm-1 col-xs-1">
         <span></span>
        </div>
    </div>

    <div class="new_item_rows">
        <?php  $uniqIdFromSecArray=[]; ?>
        @foreach($estimateItems as $key=>$firstItem)
         @if($key)
            <?php
                $uniqIdFromSec= 'it'.rand().rand().rand();
                $uniqIdFromSecArray[]=$uniqIdFromSec;
             // 'name', 'price', 'quantity', 'total', 'estimate_id', 'item_id', 'company_id',
            //       print_r($firstItem);
                ?>
               <div class="row block items_row" id="{{$uniqIdFromSec}}">
                    <div class="col-md-5 col-sm-5 col-xs-5"> 
                       

                       <div class=" block item_block_footer" onclick="selectItemModelPopup('{{$uniqIdFromSec}}')">
                         <div class="col-md-12 col-sm-12 col-xs-12"> 
                           <span id="{{$uniqIdFromSec}}_item_name"> {{$firstItem->name}}</span>
                         </div>
                        </div>
                        <input type="hidden"  id="{{$uniqIdFromSec}}_item" required  value="{{$firstItem->item_id}}" name="item_id[{{$uniqIdFromSec}}]"  >
                        

                       <textarea class="form-control" id="{{$uniqIdFromSec}}_note"   name="note_id[{{$uniqIdFromSec}}]"  rows="3" placeholder="Description...">{{$firstItem->notes}}</textarea>

                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <input type="number"  value="{{$firstItem->quantity}}"  name="quantity[{{$uniqIdFromSec}}]" onchange="calCulate()"   onkeyup="calCulate()"   min="1"  class="form-control" id="{{$uniqIdFromSec}}_quantity"  required   onkeypress="return isNumberKey(event)">
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                     <input type="text"  class="form-control" required  value="{{$firstItem->price}}"  name="price[{{$uniqIdFromSec}}]"   onchange="calCulate()" onkeyup="calCulate()"  min="1" id="{{$uniqIdFromSec}}_price" onkeypress="return isNumberKey(event)">
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                     $ <span class="item_amount" id="{{$uniqIdFromSec}}_amount" >{{$firstItem->total}}</span>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-1">
                     <span><i class="fa fa-trash" onclick="removeItemRow('{{$uniqIdFromSec}}');"></i> </span>
                    </div>
                </div>

         @endif
        @endforeach
    </div>



    <div class=" block item_block_footer" onclick="addItemRow()">
        <div class="col-md-12 col-sm-12 col-xs-12"> 
           <span>Add an Item</span>
        </div>
    </div>

</div>
<!-- ============================Add New Items End================================ -->

                                       

                                        <div class="row" style="margin: 0;margin-top: 40px">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                     <label>Notes</label>
                                                     <textarea class="form-control" rows="5" name="notes">{{$estimate->notes}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                
                                            </div>
                                            <div class="col-md-4">
                                                 <div style="padding: 10px;padding: 10px;background: #d4d5d6; margin-top: 24px;font-size: 16px;line-height: 24px;">
                                                     <div class="row">
                                                         <div class="col-md-7 col-sm-7 col-xs-7"><span>SUB TOTAL</span></div>
                                                         <div class="col-md-5 col-sm-5 col-xs-5"><input type="hidden" name="sub_total" value="{{$estimate->sub_total}}" id="sub_total"> $<span class="sub_total">{{$estimate->sub_total}}</span></div>
                                                     </div>
                                                      <hr>
                                                     <div class="row">
                                                         <div class="col-md-7 col-sm-7 col-xs-7"><span>DISCOUNT</span></div>
                                                         <div class="col-md-5 col-sm-5 col-xs-5"><input type="text"  onchange="calCulate()"   onkeyup="calCulate()" value="{{$estimate->discount}}"  name="discount" id="discount"  style="width: 50px" onkeypress="return isNumberKey(event)">
                                                            <select style="width: 60px;height: 30px;"  onchange="calCulate()" name="discount_type" id="discount_type" >
                                                                <option @if($estimate->discount_type =='Fixed') selected @endif>Fixed</option> 
                                                                <option @if($estimate->discount_type =='Percentage') selected @endif>Percentage</option>
                                                            </select>
                                                         </div>
                                                         <input type="hidden" name="discount_val" id="discount_val" value="{{$estimate->discount_val}}">
                                                     </div>




 <div id="selected-taxes-div">
                                                     </div>
                                                     <div class="row">
                                                         <div class="col-md-7 col-sm-7 col-xs-7"></div>
                                                         <div class="col-md-5 col-sm-5 col-xs-5" style="padding-top:15px"><a data-toggle="modal" data-target="#addTaxPopup"  onclick="openTaxModel()"  href="javascript:;">Add/Remove Tax</a></div>
                                                        <input type="hidden" name="total_tax" id="total_tax" value="0">
                                                     </div>




                                                       <div class="row" style="    margin-top: 20px;padding: 15px;background: white;color: #3798dc;font-size: 18px;font-weight: 700;">
                                                         <div class="col-md-7 col-sm-7 col-xs-7"><span>TOTAL</span></div>
                                                         <div class="col-md-5 col-sm-5 col-xs-5"><input type="hidden" name="total" id="total_amount" value="{{$estimate->total}}"> $<span class ="total_amount">{{$estimate->total}}</span></div>
                                                     </div>

                                                 </div>
                                            </div>

                                        </div>

     
 <div class="form-group">
                                               <div class="input-group">
                                                 <button style="min-width: 250px;    margin-top: 23px; margin-left: 15px;" type="submit"  class="btn btn-primary">Save Estimate</button>
                                             </div>
                                         </div>

                                        
                                        

<br><br><br>
                                     </div>
                                   </form>















     </div>
    </div>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////////// -->

                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->
                    </div>












<div id="addTaxPopup" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Taxes</h4>
      </div>
      <div class="modal-body">
                         <form action="javascript:;" method="post">
                                         <div class="form-body row">
                                             <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <div class="input-group">
                                                            <input type="text" name="name"  id="new_tax_name" class="form-control" placeholder="Name"> 
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Percent(%)</label>
                                                    <div class="input-group">
                                                       <input type="text"  id="new_tax_percentage" class="form-control currency_input" placeholder="Percent" name="percent">
                                                     </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <div>
                                                        <textarea class="form-control" name="description"   id="new_tax_description" ></textarea>
                                                    </div>           
                                                </div>
                                            </div>
                                       

                                             
                                            <div class="col-md-12">
                                                <button style="width: 100%" type="submit" class="btn btn-primary" onclick="addNewTax(this);">Submit</button>
                                            </div>



                                     </div>
                                   </form>

                                  <div style="    margin-top: 20px;margin-bottom: 20px;">
                                     <h4 class="modal-title">Select Existing Tax</h4>
                                     <div id="already-existing-taxes-div"></div>
                                  </div>
      </div>
    </div>

  </div>
</div>









<!-- SELECT CUSTOMER MODEL  START -->



        <div class="  modal fade bd-example-modal-lg" id="selectCustomerModelPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable"  role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Choose Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                                <div class=" block item_block_footer" onclick="addNewCustomerModelPopUp()"> 
                                    <div class="col-md-12 col-sm-12 col-xs-12"> 
                                       <span>+ Add Customer</span>
                                    </div>
                                </div>
                                <h4 class="modal-title">Choose Customer</h4>
                                <div id="already-existing-customers-div"> </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" >Close</button>
                <button type="button" class="btn btn-primary" onclick="updateSelectedCustomer();"  >Save changes</button>
              </div>
           </div>
          </div>
        </div>








       <div class="  modal fade bd-example-modal-lg" id="selectItemModelPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable"  role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Choose Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                                <div class=" block item_block_footer" onclick="addNewItemModelPopUp()"> 
                                    <div class="col-md-12 col-sm-12 col-xs-12"> 
                                       <span>+ Add Item</span>
                                    </div>
                                </div>
                                <h4 class="modal-title">Choose Item</h4>
                                <div id="already-existing-items-div"> </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" >Close</button>
                <input type="hidden" id="uniqId">
                <button type="button" class="btn btn-primary" onclick="updateSelectedItems();"  >Save changes</button>
              </div>
           </div>
          </div>
        </div>


@endsection
 

@section('css')

<style type="text/css">
    .block{
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
 


div#show_edit_image{
    width: 100%;
}
div#show_edit_image img {
    width: 150px;
    max-width: 150px;
    padding: 20px;
}
.selectable-tax-div {
    margin-top: 5px;
}

div#selected-taxes-div .row {
    background: #3798f7;
    color: #ffffff;
    font-size: 16px;
    font-weight: 700;
    padding: 5px;
}
div#selected-taxes-div {
    padding: 5px;
}


.item_block_footer {
    margin-top: 0px;
    text-align: center;
    padding: 5px;
    line-height: 24px;
    width: 100%;
    height: 38px;
    border: 2px solid #3798f7;
    font-size: 16px;
    color: #3798dc;
    font-weight: 600;
    margin-bottom: 5px;
    background-color: #ffffff;
    cursor: pointer;
}

    .row.selectCr span {
    font-size: 14px;
    color: #3798dc;
    font-weight: 600;
}

.row.selectCr {
    margin: 2px 0px 2px 0px;
    border: 1px solid #f7f7f7;
    padding: 5px;
}

.row.selectCr input {
    width: 1.5em;
    height: 1.5em;
}
.swal-overlay.swal-overlay--show-modal {
    z-index: 9999999999;
}  
</style>
 
 
@endsection




 @section('script')


 <script type="text/javascript">
    function addNewTax(btn){
      var tax_name=  $('#new_tax_name').val();
      var tax_percentage=  $('#new_tax_percentage').val();
      var tax_description=  $('#new_tax_description').val();

      if(tax_name.trim() !='' && tax_percentage.trim() !=''){
 

    $(btn).attr('disabled','disabled');
     showLoader('already-existing-taxes-div');
            $.ajax(API_URL+'taxes/add?company_id={{Auth::user()->company_id}}', {
                type: 'POST',  // http method
                dataType: 'json',
                data: { name:tax_name,description:tax_description,percent:tax_percentage  },  // data to submit
                success: function (data, status, xhr) {
                    if (typeof data.data !== 'undefined'){
                         $('#new_tax_name').val('');
                         $('#new_tax_percentage').val('');
                         $('#new_tax_description').val('');
                        $(btn).removeAttr('disabled');
                        getAllTaxes();  
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                        $('p').append('Error' + errorMessage);
                         $(btn).removeAttr('disabled');
                }
            });


      }

    }
</script> 

<script type="text/javascript">
  var ITEMS_DATA=[];
   var ALL_TAXES=[];
     var SELECTED_TAXES=<?php  echo json_encode($Estimate_tax); ?>;



  function openTaxModel(){
        $('#new_tax_name').val('');
        $('#new_tax_percentage').val('');
        $('#new_tax_description').val('');
        getAllTaxes();
  }


    function getAllTaxes(){
            showLoader('already-existing-taxes-div');
            $.ajax(API_URL+'get-taxes-all?company_id={{Auth::user()->company_id}}', {
                type: 'GET',  // http method
                dataType: 'json',
              //  data: { myData: 'This is my data.' },  // data to submit
                success: function (data, status, xhr) {
                    if (typeof data.data !== 'undefined'){
                          ALL_TAXES=data.data;
                          createSlectableTaxesHtml();
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                        $('p').append('Error' + errorMessage);
                }
            });
    }
 
    function createSlectableTaxesHtml(){
         var HTML='';
         if(ALL_TAXES.length){
          ALL_TAXES.map(function (tax) {

                var checked="";
                SELECTED_TAXES.map(function (sel_tax) {
                       if(tax.id==sel_tax.id){ checked='checked';}
                })
               

              HTML=HTML
                      +
                   `<div class="selectable-tax-div">
                    <div class="checkbox-inline">
                        <label class="checkbox checkbox-square checkbox-success">
                        <input class="taxes_checkbox" taxes_name="`+tax.name+`"  taxes_percent="`+tax.percent+`"  type="checkbox" `+checked+` value="`+tax.id+`" /><b>`+tax.name+` 
                        (`+tax.percent+`%)</b><span></span></label>
                    </div>
                   </div>` 
            });

            HTML=HTML+`<span style="min-width: 100%; margin-top:20px"   class="btn btn-primary" onclick="UpdateSelectedTaxes();" >Select Taxes</span>`; 
           }else{
            var HTML='<center>Please add some tax types...<center>';
           }

          $('#already-existing-taxes-div').html(HTML);
     }



function UpdateSelectedTaxes(){
      var all_selected_taxesArray=[];
      $.each($(".taxes_checkbox:checked"), function(){
        var TaxId=$(this). val();
        var TaxName=$(this).attr('taxes_name');
        var TaxPercent=$(this).attr('taxes_percent');


             var cat={
              id:TaxId,
              percent:TaxPercent,
              name:TaxName
             };
         
        all_selected_taxesArray.push(cat)
      });


      SELECTED_TAXES=all_selected_taxesArray;

      console.log(SELECTED_TAXES);
      generateSelectedTaxesHtml();
       $('#addTaxPopup').modal('toggle');
}



function generateSelectedTaxesHtml(){
         var HTML='';
         SELECTED_TAXES.map(function (tax) {
                                    HTML=HTML+    ` <div class="row"><div class="col-md-7 col-sm-7 col-xs-7"><span>`+tax.name+`(`+tax.percent+`%) </span></div>
                                                         <div class="col-md-5 col-sm-5 col-xs-5">  $<span id="apply_taxes_`+tax.id+`">0</span></div>
                                                            <input type="hidden" name="tax[`+tax.id+`]" id="taxes_`+tax.id+`" >
                                                    </div>`;



              

          });

         $('#selected-taxes-div').html(HTML);
         calCulate();

}













  function addItemRow(){
    var id=makeid(15);
   var html=`<div class="row block items_row" id="`+id+`">
        <div class="col-md-5 col-sm-5 col-xs-5"> 
         

          <div class=" block item_block_footer" onclick="selectItemModelPopup('`+id+`')">
                                                     <div class="col-md-12 col-sm-12 col-xs-12"> 
                                                       <span id="`+id+`_item_name"> Select Item</span>
                                                     </div>
                                                </div>
                        <input type="hidden"  id="`+id+`_item" required  name="item_id[`+id+`]"  >


           <textarea class="form-control" id="`+id+`_note"    name="note_id[`+id+`]"  rows="3" placeholder="Description..."></textarea>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <input id="`+id+`_quantity" required type="number" onchange="calCulate()"  onkeyup="calCulate()"   name="quantity[`+id+`]"  value="1"  min="1" class="form-control" onkeypress="return isNumberKey(event)">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
         <input type="text" id="`+id+`_price" required  name="price[`+id+`]"   onchange="calCulate()"  onkeyup="calCulate()"  class="form-control"  min="1"  onkeypress="return isNumberKey(event)">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
         $ <span class="item_amount" id="`+id+`_amount">0</span>
        </div>
        <div class="col-md-1 col-sm-1 col-xs-1">
         <span><i class="fa fa-trash" onclick="removeItemRow('`+id+`');"></i> </span>
        </div>
    </div>`;
   $('.new_item_rows').append(html);

 


  }  
 

  function calCulate(){
    // var quantity=$('#'+id+'_quantity').val();
    // var price=$('#'+id+'_price').val();
    // var amount=0;
    // if(IsNumeric(quantity) && IsNumeric(price)){
    //    amount=price*quantity;
    // }
    //   $('#'+id+'_amount').html(amount);
console.log('------------------');
console.log(ITEMS_DATA);

    var sub_total=0;
      $('.items_row').each(function(){
       var  id= $(this).attr('id');
                 var quantity=$('#'+id+'_quantity').val();
                        var price=$('#'+id+'_price').val();
                        var amount=0;
                        if(!IsNumeric(quantity)){ $('#'+id+'_quantity').val(0);  }
                        if(!IsNumeric(price)){ $('#'+id+'_price').val(0);  }
                        if(IsNumeric(quantity) && IsNumeric(price)){
                           amount=price*quantity;
                        }
                        $('#'+id+'_amount').html(amount);
                        sub_total=sub_total+amount;
      })
      $('.sub_total').html(sub_total);
      $('#sub_total').val(sub_total);
      
      
       var discountAmount=0;
       var discount=$('#discount').val();
       var discount_type=$('#discount_type').val();
       if(!IsNumeric(discount)){ $('#discount').val(0);  }
       if(IsNumeric(discount) && discount>0){ 
         if(discount_type=='Fixed' && sub_total>0){
               discountAmount=discount;
         }
         if(discount_type=='Percentage' && sub_total>0){
             discountAmount= (sub_total*discount)/100;
         }
         if(discountAmount>sub_total){ discount=0;discountAmount=0; $('#discount').val(0);}
        }

        $('#discount_val').val(discountAmount);
        
        // $('.total_amount').html(sub_total-discountAmount);
        // $('#total_amount').val(sub_total-discountAmount);





        var discountedSubTotal=sub_total-discountAmount;

          var TotalTax=0;
          SELECTED_TAXES.map(function (tax) {
             var ttlTax=0;
             if(discountedSubTotal>0){
                ttlTax=tax.percent * discountedSubTotal/ 100;
             }
                TotalTax= TotalTax +ttlTax;
                $('#apply_taxes_'+tax.id).text(ttlTax);
                $('#taxes_'+tax.id).val(ttlTax);
          })

                $('#total_tax').val(TotalTax);



           $('.total_amount').html(discountedSubTotal+TotalTax);
           $('#total_amount').val(discountedSubTotal+TotalTax);




    }
  function IsNumeric(n){
      return !isNaN(parseFloat(n)) && isFinite(n);

  }

  function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
 function removeItemRow(id){
    $('#'+id).remove();

    calCulate();
 }
function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

 



 </script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
     
 <script type="text/javascript">
     $(function() {
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
    

    
   
    

 
      
  




    

});


function calCulateOnSelect(id){
                          item_id=$('#'+id+'_item').val();
                             ITEMS_DATA.map(function (item) {
                            if(item_id==item.id){
                                     $('#'+id+'_quantity').val(1);
                                     $('#'+id+'_price').val(item.price);
                                }
                            });

     calCulate();
 }









 function formValidation(){
    var estimate_date= $('#estimate_date').val();
    var due_date= $('#due_date').val();
    var estimate_number= $('#estimate_number').val();
    var customer_id= $('#customer_id').val();
    var total_amount= $('#total_amount').val();


    if(estimate_date==''){ 
         swal({
              title: "Err!",
              text: "Please enter a Estimate date",
              icon: "warning",
             });
        return false;

    }

    if(due_date==''){ 
         swal({
              title: "Err!",
              text: "Please enter a due date",
              icon: "warning",
             });
        return false;

    }
    if(estimate_number==''){ 
         swal({
              title: "Err!",
              text: "Please enter a Estimate number/name",
              icon: "warning",
             });
        return false;
    }

    if(customer_id==''){ 
         swal({
              title: "Err!",
              text: "Please select a customer",
              icon: "warning",
             });
        return false;
    }
    if(total_amount=='' || total_amount=='0'){ 
         swal({
              title: "Err!",
              text: "Total amount must be greater then zero",
              icon: "warning",
             });
        return false;
    }
    var id='{{$uniqId}}';
    var item_id=$('#'+id+'_item').val();
    var quantity=$('#'+id+'_quantity').val();
    var price=$('#'+id+'_price').val();

    if(item_id==''){ 
     swal({
          title: "Err!",
          text: "Please select an item or remove row",
          icon: "warning",
         });
    return false;
    }

    if(quantity==''){ 
         swal({
              title: "Err!",
              text: "Please select  item quantity or remove row",
              icon: "warning",
             });
    return false;
    }
    if(price==''){ 
         swal({
              title: "Err!",
              text: "Please select  item quantity or remove row",
              icon: "warning",
             });
            return false;
    }




     // return false;
 } 


 $(document).ready(function() {
  setTimeout(function() {
    generateSelectedTaxesHtml();
  }, 2000);
});

</script>







<script type="text/javascript">

    function updateSelectedCustomer(){
        var radioValue = $("input[name='selectedCustomer']:checked")
         var customer_id=radioValue.val();
          if(customer_id=='' || typeof customer_id === 'undefined'){ return false;}
         var customer_name=radioValue.attr('customer_name');

         $('#customer_name').html(customer_name);
         $('#customer_id').val(customer_id);
         $('#selectCustomerModelPopup').modal('hide');

        // alert(customer_id+customer_name);
    }

    function selectCustomerModelPopup(){
              $('#selectCustomerModelPopup').modal({backdrop: 'static', keyboard: false});
               loadAlreadyExistsData();


    }
function selectCustomerModelPopup(){
              $('#selectCustomerModelPopup').modal({backdrop: 'static', keyboard: false});
               loadAlreadyExistsData();


    }

    function selectItemModelPopup(uniqId){
              $('#selectItemModelPopup').modal({backdrop: 'static', keyboard: false});
              $('#uniqId').val(uniqId);
               loadAlreadyExistsItemsData(uniqId);

              // calCulateOnSelect(uniqId);
    }

   function loadAlreadyExistsData(){
    showLoader('already-existing-customers-div');
                $.ajax(API_URL+'get-customer-all?company_id={{Auth::user()->company_id}}', {
                type: 'POST',  // http method
                dataType: 'json',
                 success: function (data, status, xhr) {
                    if (typeof data.data !== 'undefined' && data.data.length >0){
                    var HTML='';
                        data.data.map(function (customer) {
                                    var checked='';
                                    if($('#customer_id').val()==customer.id){ checked='checked'; }
                                    HTML=HTML+    ` <div class="row selectCr">
                                                                <div class="col-md-1 col-sm-1 col-xs-1">
                                                                     <input type="radio" name="selectedCustomer" `+checked+` class="selectedCustomer"  value="`+customer.id+`"  customer_name="`+customer.name+`"
                                                                     >
                                                                 </div>
                                                                 <div class="col-md-11 col-sm-11 col-xs-11">
                                                                   <span>`+customer.name+`  (`+customer.email+`) </span>
                                                                 </div>
                                                             
                                                    </div>`;
                        });

                       $('#already-existing-customers-div').html(HTML);
                    }else{
                       $('#already-existing-customers-div').html('<center style="padding: 60px;">No customer found, please add new</center>') 
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                        $('#already-existing-customers-div').html('<center style="padding: 60px;">Either No records found or somthing went wrong</center>')
                }
            });
   }


  function updateSelectedItems(){
       var uniqId= $('#uniqId').val();
        var radioValue = $("input[name='selectedItem']:checked")
         var item_id=radioValue.val();
          if(item_id=='' || typeof item_id === 'undefined'){ return false;}
         var item_name=radioValue.attr('item_name');

         $('#'+uniqId+'_item_name').html(item_name);
         $('#'+uniqId+'_item').val(item_id);
         $('#selectItemModelPopup').modal('hide');

       calCulateOnSelect(uniqId);
    }


function loadAlreadyExistsItemsData(uniqId){
    showLoader('already-existing-items-div');
                $.ajax(API_URL+'get-items-all?company_id={{Auth::user()->company_id}}', {
                type: 'POST',  // http method
                dataType: 'json',
                 success: function (data, status, xhr) {
                    if (typeof data.data !== 'undefined' && data.data.length >0){
                        ITEMS_DATA=data.data;
                    var HTML='';
                        data.data.map(function (Item) {
                                    var checked='';
                                     if($('#'+uniqId+'_item').val()==Item.id){ checked='checked'; }
                                    HTML=HTML+    ` <div class="row selectCr">
                                                                <div class="col-md-1 col-sm-1 col-xs-1">
                                                                     <input type="radio" name="selectedItem" `+checked+` class="selectedItem"  value="`+Item.id+`"  item_name="`+Item.name+`"
                                                                     >
                                                                 </div>
                                                                 <div class="col-md-11 col-sm-11 col-xs-11">
                                                                   <span>`+Item.name+`  (`+Item.price+`) </span>
                                                                 </div>
                                                             
                                                    </div>`;
                        });

                       $('#already-existing-items-div').html(HTML);
                    }else{
                       $('#already-existing-items-div').html('<center style="padding: 60px;">No customer found, please add new</center>') 
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                        $('#already-existing-items-div').html('<center style="padding: 60px;">Either No records found or somthing went wrong</center>')
                }
            });
   }
   function loadAlreadyExistsData(){
    showLoader('already-existing-customers-div');
                $.ajax(API_URL+'get-customer-all?company_id={{Auth::user()->company_id}}', {
                type: 'POST',  // http method
                dataType: 'json',
                 success: function (data, status, xhr) {
                    if (typeof data.data !== 'undefined' && data.data.length >0){
                    var HTML='';
                        data.data.map(function (customer) {
                                    var checked='';
                                    if($('#customer_id').val()==customer.id){ checked='checked'; }
                                    HTML=HTML+    ` <div class="row selectCr">
                                                                <div class="col-md-1 col-sm-1 col-xs-1">
                                                                     <input type="radio" name="selectedCustomer" `+checked+` class="selectedCustomer"  value="`+customer.id+`"  customer_name="`+customer.name+`"
                                                                     >
                                                                 </div>
                                                                 <div class="col-md-11 col-sm-11 col-xs-11">
                                                                   <span>`+customer.name+`  (`+customer.email+`) </span>
                                                                 </div>
                                                             
                                                    </div>`;
                        });

                       $('#already-existing-customers-div').html(HTML);
                    }else{
                       $('#already-existing-customers-div').html('<center style="padding: 60px;">No customer found, please add new</center>') 
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                        $('#already-existing-customers-div').html('<center style="padding: 60px;">Either No records found or somthing went wrong</center>')
                }
            });
   }

   
    function addNewCustomerModelPopUp(){
              $('#addNewCustomerModelPopUp').modal({backdrop: 'static', keyboard: false});
              ALL_VEHICLE=[];
              $('#newCustomerForm input').val('');
              $('#newCustomerForm textarea').val('');
              $('.all-vehicles-container').html('');



    }

      function addNewItemModelPopUp(){
              $('#addNewItemModelPopUp').modal({backdrop: 'static', keyboard: false});
              ALL_VEHICLE=[];
              $('#newItemForm input').val('');
              $('#newItemForm textarea').val('');
              $('.selected-categories-div').html('');



    }
</script>


@endsection