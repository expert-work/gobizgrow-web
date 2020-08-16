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
                                     <a href="{{url('customers')}}" class="btn btn-light-warning font-weight-bolder btn-sm"> Customers</a>
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
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b">
                                    <div class="card-body">
                                        <!--begin::Details-->
                                        <div class="d-flex mb-9">
                                            <!--begin: Pic-->
                                            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                                <!-- <div class="symbol symbol-50 symbol-lg-120">
                                                    <img src="{{url('theme/html/demo1/dist')}}/assets/media/users/300_1.jpg" alt="image">
                                                </div>
 -->                                                <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                                                    <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                                                </div>
                                            </div>
                                            <!--end::Pic-->
                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <!--begin::Title-->
                                                <div class="d-flex justify-content-between flex-wrap mt-1">
                                                    <div class="d-flex mr-3">
                                                        <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{$customer->name}} </a>
                                                        <a href="#">
                                                            <i class="flaticon2-correct text-success font-size-h5"></i>
                                                        </a>
                                                    </div>
                                                    <div class="my-lg-0 my-3">

                                                        <!-- <a href="#" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">ask</a>
                                                        <a href="#" class="btn btn-sm btn-info font-weight-bolder text-uppercase">hire</a>
 -->                                                    </div>
                                                </div>
                                                <!--end::Title-->
                                                <!--begin::Content-->
                                                <div class="d-flex flex-wrap justify-content-between mt-1">
                                                    <div class="d-flex flex-column flex-grow-1 pr-8">
                                                        <div class="d-flex flex-wrap mb-4">
                                                            <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                            <i class="flaticon2-new-email mr-2 font-size-lg"></i>{{$customer->email}}</a>
                                                            <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                            <i class="fa fa-phone mr-2 font-size-lg"></i>{{$customer->phone}}</a>
                                                            <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                                            <i class="flaticon2-placeholder mr-2 font-size-lg"></i>{{$customer->street_address}} {{$customer->city}}  {{$customer->state}}  {{$customer->zip_code}}</a>
                                                        </div>

                                              
                                                         
                                                    </div>
                                                    
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Details-->
                                         <!--begin::Items-->
                                     
                                        <!--begin::Items-->
                                    </div>
                                </div>
                                <!--end::Card-->
                                <!--begin::Row-->
                                <div class="row">


                                    <div class="col-lg-12">
                                        <!--begin::Advance Table Widget 2-->
                                        <div class="card card-custom card-stretch gutter-b">
                                            <!--begin::Header-->
                                            <div class="card-header border-0 pt-5">
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label font-weight-bolder text-dark">Customer Notes</span>
                                                 </h3>
                                                <div class="card-toolbar">
                                                    <button onclick="resetModel();" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs">Add Notes/Info</button>
                                                </div>
                                            </div>
                                          
                                            <div class="card-body pt-3 pb-0">
                                                 <div class="card card-custom card-stretch gutter-b">
 
                                                    <div class="card-body d-flex flex-column">
                                                           @foreach($customer_notes as $customer_note)
                                                             <div class="customer_note_block">
                                                                 <span class="font-weight-bold text-dark-50" id="note_{{$customer_note->id}}" >{{$customer_note->notes}}</span>
                                                                 <div class="img-div-update-box" style="padding: 3px 5px;max-width: 36px;margin-top: 5px;">
                                                                       <div class="row"> 
                                                                           <div class="col-xs-6 col-sm-6 col-md-6"><i onclick="openEditPopup('{{$customer_note->id}}')" data-toggle="modal" data-target="#myModal" class="fa fa-edit" style="color: #3798f7; cursor: pointer;"> </i> </div>
                                                                           <div class="col-xs-6 col-sm-6 col-md-6"><a href="{{url('customer_notes/delete/'.$customer_note->auth_token)}}"><i  class="fa fa-trash" style="color: red"> </i></a> </div>
                                                                       </div>
                                                                 </div>
                                                             </div>
                                                           @endforeach
                                                     </div>
                                                </div>

                                            </div>
                                         </div>
                                     </div>










                                    <div class="col-lg-6">
                                        <!--begin::Advance Table Widget 2-->
                                        <div class="card card-custom card-stretch gutter-b">
                                            <!--begin::Header-->
                                            <div class="card-header border-0 pt-5">
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label font-weight-bolder text-dark">Estimates</span>
                                                 </h3>
                                                <div class="card-toolbar">
                                                    
                                                </div>
                                            </div>
                                          
                                            <div class="card-body pt-3 pb-0">
                                                 <div class="card card-custom card-stretch gutter-b">
                                                            <div class="card-body d-flex flex-column">
                                                                     

                                                                      @foreach ($estimates as $estimate)
                                                                        <div class="form-group row my-2"  
                                                                           onclick="window.location='{{url('estimates/view/'.$estimate->auth_token )}}'"

                                                                           style="border-bottom: 1px solid #e8eaf2;margin-bottom: 20px !important; cursor: pointer;">
                                                                            <div class="col-6">
                                                                              <b> {{$estimate->name}}</b>
                                                                               <p>{{$estimate->estimate_number}}</p>
                                                                               <p>{{$estimate->status}}</p>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                 <b> $ {{$estimate->total}} </b>
                                                                                 <p>{{ date('m/d/Y', strtotime($estimate->due_date)) }}</p>
                                                                            </div>
                                                                        </div>
                                                                     @endforeach
                                                                     {{ $estimates->withQueryString()->links() }}
                                                                    </div>
                                                        </div>
                                            </div>
                                         </div>
                                     </div>




                                    <div class="col-lg-6">
                                        <!--begin::Advance Table Widget 2-->
                                        <div class="card card-custom card-stretch gutter-b">
                                            <!--begin::Header-->
                                            <div class="card-header border-0 pt-5">
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label font-weight-bolder text-dark">Invoices</span>
                                                 </h3>
                                                <div class="card-toolbar">
                                                    
                                                </div>
                                            </div>
                                          
                                            <div class="card-body pt-3 pb-0">
                                                 <div class="card card-custom card-stretch gutter-b">
 
                                                    <div class="card-body d-flex flex-column">
                                                              @foreach ($invoices as $invoice)
                                                                <div class="form-group row my-2"  
                                                                   onclick="window.location='{{url('invoices/view/'.$invoice->auth_token )}}'"

                                                                   style="border-bottom: 1px solid #e8eaf2;margin-bottom: 20px !important; cursor: pointer;">
                                                                    <div class="col-6">
                                                                      <b> <p>{{$invoice->name}}</p></b>
                                                                       <p>{{$invoice->invoice_number}}</p>
                                                                       <p>{{$invoice->status}}</p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                         <b> $ {{$invoice->due_amount}} </b>
                                                                         <p>{{ date('m/d/Y', strtotime($invoice->due_date)) }}</p>
                                                                    </div>
                                                                </div>
                                                             @endforeach

                                                              {{ $invoices->withQueryString()->links() }}
                                                            </div>
                                                </div>

                                            </div>
                                         </div>
                                     </div>

                                    <div class="col-lg-6">
                                        <!--begin::Advance Table Widget 2-->
                                        <div class="card card-custom card-stretch gutter-b">
                                            <!--begin::Header-->
                                            <div class="card-header border-0 pt-5">
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label font-weight-bolder text-dark">Vehicles</span>
                                                 </h3>
                                                <div class="card-toolbar">
                                                    <div class=" block item_block_footer" onclick="addNewVehiclePopupp()" > 
                                                        <div class="col-md-12 col-sm-12 col-xs-12"> 
                                                           <span>+ Add</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          
                                            <div class="card-body pt-3 pb-0">
                                                 <div class="card card-custom card-stretch gutter-b">
 
                                                    <div class="card-body d-flex flex-column">
                                                             <div class="all-vehicles-container"> </div> 
                                                   </div>
                                                </div>

                                            </div>
                                         </div>
                                     </div>



                                  
                                </div>
                                
                            </div>
                        
                    </div>
                  </div>

            <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Notes/Info</h4>
        <button type="button" class="close" data-dismiss="modal" onclick="resetModel()">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="post" onsubmit="return addEditNotes();">
               {{ csrf_field() }}

         <textarea class="form-control" rows="5" id="notes_data" name="notes"> </textarea>
         <input type="hidden" name="id" id="notes_id">
         <button style="width: 100%; height: 40px; font-weight: 800;    margin-top: 40px; " class="btn btn-info" type="submit"> Add/Edit</button>
         </form>
      </div>
 
    </div>
  </div>
</div>



<div class="modal fade" id="addNewVehiclePopupp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add/Edit Vehicle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                   <div class="form-group">
                        <label>Vehicle Make</label>
                        <div class="input-group">
                            <input type="text" id="vehicle_make"   class="form-control" placeholder="Volvo"> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Vehicle Model</label>
                        <div class="input-group">
                            <input type="text" id="vehicle_model"   class="form-control" placeholder="XC 90"> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Vehicle Year (Optional)</label>
                        <div class="input-group">
                            <input type="text" id="vehicle_year"   class="form-control" placeholder="2020"> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Vehicle Color (Optional)</label>
                        <div class="input-group">
                            <input type="text" id="vehicle_color"   class="form-control" placeholder="Pink"> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Vehicle Mileage (Optional)</label>
                        <div class="input-group">
                            <input type="text" id="vehicle_milieage"   class="form-control" placeholder="20"> 
                        </div>
                    </div>
                  <div class="form-group">
                        <label>Vehicle Notes (Optional)</label>
                        <div class="input-group">
                            <textarea  id="vehicle_notes"  value="" class="form-control"> </textarea>
                        </div>
                    </div>

          <input type="hidden" id="vehicle_id"   class="form-control" placeholder="20"> 
          <input type="hidden" id="vehicle_uniq_id"   class="form-control" placeholder="20"> 

                    



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="resetAndClose();" >Close</button>
        <button type="button" class="btn btn-primary" onclick="addNewVehicle();"  >Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('css')
 <style type="text/css">

.customer_note_block {
    margin-bottom: 20px;
}

 </style>

   <style type="text/css">
                        span.input-group-addon {
    padding: 9px;
    border: 1px solid #e5eaee;
    margin-right: .5px;
}

.block {
    clear: both;
    width: 300px;
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
.vehicle-container.row {
    background: #f3f6f9;
    margin: 0;
    padding: 15px;
    margin-top: 5px !important;
}
.vehicle-title {
    font-size: 18px;
    font-weight: 600;
    color: black;
}
.all-vehicles-container {
    margin-top: 15px;
    margin-bottom: 15px;
}

i.fa.fa-edit {
    cursor: pointer;
    color: #3798dc;
}

i.fa.fa-trash {
    color: red;
    cursor: pointer;
    margin-left: 5px;
}
</style>


@endsection


@section('script')
<script type="text/javascript">
    
function addEditNotes(){
   var notes_data= $('#notes_data').val().trim();
   if(notes_data==''){
         swal({
              title: "Err!",
              text: "Please enter some notes/info",
              icon: "warning",
             });
        return false;
   }
}

function resetModel(){
     $('#notes_data').val('');
     $('#notes_id').val('');
}

function openEditPopup(id){
   var text= $('#note_'+id).text();
     $('#notes_data').val(text);
     $('#notes_id').val(id);
}
</script>
 
 <script type="text/javascript">
  var ALL_VEHICLE=<?php echo json_encode($vehicles); ?>;

  function addNewVehiclePopupp() {
      $('#vehicle_make').val('');
      $('#vehicle_model').val('');
      $('#vehicle_year').val('');
      $('#vehicle_color').val('');
      $('#vehicle_milieage').val('');
      $('#vehicle_notes').val('');   
      $('#vehicle_id').val(''); 

      $('#vehicle_uniq_id').val(makeid(10));
      $('#addNewVehiclePopupp').modal();
  }

  function editVehicle(uniq_id){
        var selectedItem=[];
        ALL_VEHICLE.map(function (item) { 
         if(item.uniq_id ==uniq_id){ selectedItem= item; }
      })
      console.log(selectedItem);
      $('#vehicle_make').val(selectedItem.make);
      $('#vehicle_model').val(selectedItem.model);
      $('#vehicle_year').val(selectedItem.year);
      $('#vehicle_color').val(selectedItem.color);
      $('#vehicle_milieage').val(selectedItem.mileage);
      $('#vehicle_notes').val(selectedItem.notes);   
      $('#vehicle_id').val(selectedItem.id); 
      $('#vehicle_uniq_id').val(selectedItem.uniq_id); 
      $('#addNewVehiclePopupp').modal();    
  }

    function resetAndClose() {
      $('#vehicle_make').val('');
      $('#vehicle_model').val('');
      $('#vehicle_year').val('');
      $('#vehicle_color').val('');
      $('#vehicle_milieage').val('');
      $('#vehicle_notes').val('');   
    $('#vehicle_id').val(''); 
    $('#vehicle_uniq_id').val(''); 
    $('#addNewVehiclePopupp').modal('hide');
  }

  function addNewVehicle(){
    var vehicle_make= $('#vehicle_make').val();
    var vehicle_model= $('#vehicle_model').val();
    var vehicle_year= $('#vehicle_year').val();
    var vehicle_color= $('#vehicle_color').val();
    var vehicle_milieage= $('#vehicle_milieage').val();
    var vehicle_notes= $('#vehicle_notes').val();  
        var vehicle_id  = $('#vehicle_id').val(); 
      var vehicle_uniq_id  = $('#vehicle_uniq_id').val();
        if(vehicle_make.trim() ==''  ||  vehicle_model.trim()==''){ return false; }
        
        
                var vehicle={
                   make:vehicle_make,
                   model:vehicle_model,
                   year:vehicle_year,
                   color:vehicle_color,
                   mileage:vehicle_milieage,
                   notes:vehicle_notes,
                   id:vehicle_id,
                   uniq_id:vehicle_uniq_id,
                   customer_id:'{{$customer->id}}',
                   _token: "{{ csrf_token() }}",
                }
//////////////////////////////////////////////
            $.ajax({
                   type: "POST",
                   url: '{{url('web-api/add-update-vehicle')}}',
                   data:vehicle,
                   success: function(data)
                   {
                     if(data.responseCode==200){
                         var vdata=data.data;
                         var vehicle={
                               make:vdata.make,
                               model:vdata.model,
                               year:vdata.year,
                               color:vdata.color,
                               mileage:vdata.mileage,
                               notes:vdata.notes,
                               id:vdata.id,
                               uniq_id:vehicle_uniq_id
                            }

                           removeVehicleByUniqeId(vehicle_uniq_id);
                           ALL_VEHICLE.push(vehicle)
                           generateAllvehicleHtml();
                           resetAndClose();
                     }
                     
                    }
                 });
//////////////////////////////////////////////
   

       
  }

function removeVehicle(uniq_id){
            swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

                    var selectedItem=[];
                    ALL_VEHICLE.map(function (item) { 
                     if(item.uniq_id ==uniq_id){ selectedItem= item; }
                    })
                  //////////////////////////////////////////////
                            $.ajax({
                                   type: "GET",
                                   url: '{{url('web-api/delete-vehicle?id')}}='+selectedItem.id,
                                   success: function(data)
                                   {
                                     if(data.responseCode==200){
                                        removeVehicleByUniqeId(uniq_id);
                                        generateAllvehicleHtml();
                                     }
                                     
                                    }
                                 });
                //////////////////////////////////////////////
                   
                   
              } 
            });
}
function removeVehicleByUniqeId(uniq_id){
  var vehicles=[];
  ALL_VEHICLE.map(function (item) { 
     if(item.uniq_id !=uniq_id){ vehicles.push(item); }
  })
  ALL_VEHICLE=vehicles;
}

function generateAllvehicleHtml(){
      $('.all-vehicles-container').html('');
    ALL_VEHICLE.map(function (item) {
         var html= `<div class="vehicle-container row" > 
                           <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                <div class="vehicle-title">`+item.year+` `+item.make+` `+item.model+`</div>
                                <div class="vehicle-note">`+item.notes+`</div>
                            </div>
                           <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"> <div class="vehicle-edit-icon"><i onclick="editVehicle('`+item.uniq_id+`')" class="fa fa-edit"></i><i onclick="removeVehicle('`+item.uniq_id+`')" class="fa fa-trash"></i></div> </div>
                       </div> `;
         $('.all-vehicles-container').append(html);
     });
    $('#vehicles_json_data').val(JSON.stringify(ALL_VEHICLE));
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
 $(function() {
               generateAllvehicleHtml();
      })


</script>
@endsection



