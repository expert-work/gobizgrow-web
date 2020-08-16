 
<!-- Modal -->
<div class="  modal fade bd-example-modal-lg" id="addNewCustomerModelPopUp" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index: 9999;">
  <div class="modal-dialog modal-dialog-scrollable modal-xl  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">New Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <!--//////////////////////////////////////////////////////////////////  -->
         <!-- /////////////////////////////////////////////////////////////////// -->
 <div class="card-body form">
                                    <form  id="newCustomerForm" method="post">
                                       {{ csrf_field() }}
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Customer Name</label>
                                                <div class="input-group">
                                                    <input type="text" name="name" id="new_customer_name"  class="form-control" placeholder="Name"> 
                                                </div>
                                            </div>
                                       
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <div class="input-group">
                                                    <input type="email" name="email" id="new_customer_email"  class="form-control" placeholder="Email Address"> 
                                                </div>
                                            </div>
  
                                             <div class="form-group">
                                                <label>Phone Number</label>
                                                 <div class="input-group">
                                                    <input type="text" name="phone"  id="new_customer_phone" class="form-control" placeholder="Phone"> 
                                                </div>
                                              </div>
                                              
                                            <div class="form-group">
                                                <label>Street Address</label>
                                                 <div class="input-group">
                                                    <input type="text" name="street_address" class="form-control" placeholder="Street Address"> 
                                                </div>
                                            </div>
                                               
                                             <div class="form-group">
                                                <label>City</label>
                                                 <div class="input-group">
                                                     
                                                    <input type="text" name="city"  class="form-control" placeholder="City"> 
                                                </div>
                                             </div>
                                               
	                                         <div class="row"> 
                                                <div class="col-md-6">
				                                             <div class="form-group">
				                                                <label>State</label>
				                                                 <div class="input-group">
				                                                    <input type="text" name="state"  class="form-control" placeholder="State"> 
				                                                </div>
				                                             </div>
				                                </div>
				                                 <div class="col-md-6">
				                                             <div class="form-group">
				                                                <label>Zip Code</label>
				                                                 <div class="input-group">
				                                                    <input type="text" name="zip_code"  class="form-control" placeholder="Zip Code">
				                                                </div>
				                                              
				                                             </div>
                                                </div>
	                                         </div>

	                                         <div class="form-group">
                                                <label>Customer Notes</label>
                                                 <textarea class="form-control" name="customer_notes"></textarea>
                                                  
                                              </div>
 
                                         </div>

                                      <div class="col-md-6">
                                      	    <label>Vehicles</label>
                                      	    <div class=" block item_block_footer" onclick="addNewVehiclePopupp()" > 
                                                <div class="col-md-12 col-sm-12 col-xs-12"> 
                                                   <span>+ Add</span>
                                                </div>
                                            </div>


                                          <div class="all-vehicles-container"> </div>

                                      </div>
                                     </div>
                                          <input type="hidden" name="vehicles_json_data" id="vehicles_json_data" value="[]">
                                          
                                   </form>
                                </div>

          <!--//////////////////////////////////////////////////////////////////  -->
         <!-- /////////////////////////////////////////////////////////////////// -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveCustomer(this);" >Save changes</button>
      </div>
    </div>
  </div>
</div>

















  <div class="modal fade" id="addNewVehiclePopupp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  style="z-index: 99999;">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
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
      $('#addNewVehiclePopupp').modal({backdrop: 'static', keyboard: false});
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
			$('#addNewVehiclePopupp').modal({backdrop: 'static', keyboard: false});    
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

// function makeid(length) {
//    var result           = '';
//    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
//    var charactersLength = characters.length;
//    for ( var i = 0; i < length; i++ ) {
//       result += characters.charAt(Math.floor(Math.random() * charactersLength));
//    }
//    return result;
// }



function saveCustomer(btn){
	if($('#new_customer_name').val()==''){ 
				swal({
		              title: "Err!",
		              text: "Please enter customer name",
		              icon: "warning",
		             });
		        return false;
         }
    if($('#new_customer_email').val()==''){ 
                    swal({
		              title: "Err!",
		              text: "Please enter customer email",
		              icon: "warning",
		             });
		        return false;
     }
	if($('#new_customer_phone').val()==''){ 
                    swal({
		              title: "Err!",
		              text: "Please enter customer phone",
		              icon: "warning",
		             });

		        return false;
	 }


  $(btn).attr('disabled');
      var frm = $('#newCustomerForm');

 $.ajax(API_URL+'customers/add?company_id={{Auth::user()->company_id}}', {
                type: 'POST',  // http method
                dataType: 'json',
                data: frm.serialize(),  // data to submit
                success: function (data, status, xhr) {
                    if (typeof data.data !== 'undefined'){
						  loadAlreadyExistsData();
						  swal({
		                    	html:true,
				              title: "Success!",
				              text: 'Customer Successfully Added',
				              icon: "success",
				             });
						  $('#addNewCustomerModelPopUp').modal('hide');  
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                        // $('p').append('Error' + errorMessage);
                       var errors=jqXhr.responseJSON.data;
                       var msg='';
						if (typeof errors.email !== 'undefined'){ msg=msg+errors.email[0]+ ' ';  }
						if (typeof errors.phone !== 'undefined'){ msg=msg+errors.phone[0]+' ';   }
						if (typeof errors.name !== 'undefined'){  msg=msg+errors.name[0];  }

	                    swal({
	                    	html:true,
			              title: "Err!",
			              text: msg,
			              icon: "warning",
			             });
                        $(btn).removeAttr('disabled');
                }
            });





}


</script>


  <style type="text/css">
                        span.input-group-addon {
    padding: 9px;
    border: 1px solid #e5eaee;
    margin-right: .5px;
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
</style>