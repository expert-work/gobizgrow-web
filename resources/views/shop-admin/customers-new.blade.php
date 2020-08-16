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
                                     <a href="{{url('customers')}}" class="btn btn-light-warning font-weight-bolder btn-sm"> Customer</a>
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
                                <div class="card"> 
<!-- ////////////////////////////////////////////////////////////////////////////////////// -->

    <div class="card-body form">
                                    <form  action="{{url('customers/new')}}" method="post">
                                       {{ csrf_field() }}
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Customer Name</label>
                                                <div class="input-group">
                                                     
                                                    <input type="text" name="name"  value="{{old('name')}}" class="form-control" placeholder="Name"> 
                                                </div>
                                                    @error('name')
		                                                <span class="invalid-feedback" style="color:red" role="alert">
		                                                    <strong>{{ $message }}</strong>
		                                                </span>
		                                            @enderror
                                            </div>
                                       
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <div class="input-group">
                                                    <input type="email" name="email" value="{{old('email')}}"  class="form-control" placeholder="Email Address"> 
                                                </div>
                                                 @error('email')
												    <span class="invalid-feedback" style="color:red" role="alert">
												        <strong>{{ $message }}</strong>
												    </span>
												@enderror 
                                            </div>
  
                                             <div class="form-group">
                                                <label>Phone Number</label>
                                                 <div class="input-group">
                                                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Phone"> 
                                                </div>
													@error('phone')
													    <span class="invalid-feedback" style="color:red" role="alert">
													        <strong>{{ $message }}</strong>
													    </span>
													@enderror
                                              </div>
                                              
                                            <div class="form-group">
                                                <label>Street Address</label>
                                                 <div class="input-group">
                                                     
                                                    <input type="text" name="street_address" value="{{old('street_address')}}" class="form-control" placeholder="Street Address"> 
                                                </div>
												@error('street_address')
												    <span class="invalid-feedback" style="color:red" role="alert">
												        <strong>{{ $message }}</strong>
												    </span>
												@enderror
                                            </div>
                                               
                                             <div class="form-group">
                                                <label>City</label>
                                                 <div class="input-group">
                                                     
                                                    <input type="text" name="city" value="{{old('city')}}" class="form-control" placeholder="City"> 
                                                </div>
												@error('city')
												    <span class="invalid-feedback" style="color:red" role="alert">
												        <strong>{{ $message }}</strong>
												    </span>
												@enderror
                                             </div>
                                               
	                                         <div class="row"> 
                                                <div class="col-md-6">
				                                             <div class="form-group">
				                                                <label>State</label>
				                                                 <div class="input-group">
				                                                     
				                                                    <input type="text" name="state" value="{{old('state')}}" class="form-control" placeholder="State"> 
				                                                </div>
				                                                  @error('state')
								                                            <span class="invalid-feedback" style="color:red" role="alert">
								                                                <strong>{{ $message }}</strong>
								                                            </span>
								                                   @enderror
				                                             </div>
				                                </div>
				                                 <div class="col-md-6">
				                                             <div class="form-group">
				                                                <label>Zip Code</label>
				                                                 <div class="input-group">
				                                                     
				                                                    <input type="text" name="zip_code" value="{{old('zip_code')}}" class="form-control" placeholder="Zip Code"> 
				                                                </div>
				                                                @error('zip_code')
				                                                        <span class="invalid-feedback" style="color:red" role="alert">
				                                                            <strong>{{ $message }}</strong>
				                                                        </span>
				                                                @enderror
				                                             </div>
                                                </div>
	                                         </div>


                                               
	                                         <div class="form-group">
                                                <label>Customer Notes</label>
                                                 <textarea class="form-control" name="customer_notes">{{old('customer_notes')}}</textarea>
                                                 @error('customer_notes')
                                                        <span class="invalid-feedback" style="color:red" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                 @enderror
                                              </div>
 
                                         </div>
                                     








                                      <div class="col-md-6">
                                      	    <label>Vehicles</label>
                                      	    <div class=" block item_block_footer" onclick="addNewVehiclePopupp()" data-toggle="modal" data-target="#myModal"> 
                                                <div class="col-md-12 col-sm-12 col-xs-12"> 
                                                   <span>+ Add</span>
                                                </div>
                                            </div>


                                          <div class="all-vehicles-container"> </div>





                                      </div>



                                     </div>
                                          <input type="hidden" name="vehicles_json_data" id="vehicles_json_data" value="[]">
                                          <div class="form-group">
                                               <div class="input-group">
                                                <button style="min-width: 250px;" type="submit"  class="btn btn-primary">Submit</button>
                                             </div>
                                         </div>



                                     
                                   </form>
                                </div>
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->
                          
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

@section('script')
<script type="text/javascript">
	var ALL_VEHICLE=[];

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
        
        removeVehicleByUniqeId(vehicle_uniq_id);
        var vehicle={
           make:vehicle_make,
           model:vehicle_model,
           year:vehicle_year,
           color:vehicle_color,
           mileage:vehicle_milieage,
           notes:vehicle_notes,
           id:vehicle_id,
           uniq_id:vehicle_uniq_id
        }
       ALL_VEHICLE.push(vehicle)
       generateAllvehicleHtml();
       resetAndClose();
	}

function removeVehicle(uniq_id){
	removeVehicleByUniqeId(uniq_id);
	generateAllvehicleHtml();
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


</script>
 
@endsection


@section('css')
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






