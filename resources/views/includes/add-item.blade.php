 
<!-- Modal -->
<div class="  modal fade bd-example-modal-lg" id="addNewItemModelPopUp" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index: 9999;">
  <div class="modal-dialog modal-dialog-scrollable modal-xl  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">New Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <!--//////////////////////////////////////////////////////////////////  -->
         <!-- /////////////////////////////////////////////////////////////////// -->
 <div class="card-body form">
                                    <form  id="newItemForm" method="post"> 
                                        {{ csrf_field() }}
                                        <div class="row">
                                             <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div class="input-group">
                                                     
                                                    <input type="text" name="name"   id="new_item_name"  class="form-control" placeholder="Name"> 
                                                </div>
                                            </div>
                                             
                                        </div>

                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Generic Price</label>
                                                <div class="input-group">
                                                    
                                                <input type="text" class="form-control currency_input" id="new_item_price" placeholder="Price" name="price">
                                                   
                                                    
                                                </div>
                                            </div>
                                             
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <div>
                                                    <textarea class="form-control" name="description"></textarea>
                                                </div>           
                                            </div>
                                             
                                        </div>
                                                                         
                                        <div class="col-md-12">
                                             <br><h4>Add Category Based Pricing:</h4>
                                        </div>

                                      <div id="selected-categories-div" class="row" style="padding: 15px;width: 100%;"> </div>
                                     
                                      <div class="col-md-12">
                                            <div class=" block item_block_footer" onclick="addItemCategoryRow()" > 
                                                <div class="col-md-12 col-sm-12 col-xs-12"> 
                                                   <span>+ Add Categories</span>
                                                </div>
                                            </div>
                                    </div>
                                
                                     </div>
                                   
                                   </form>
                                </div>

          <!--//////////////////////////////////////////////////////////////////  -->
         <!-- /////////////////////////////////////////////////////////////////// -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveItems(this);" >Save changes</button>
      </div>
    </div>
  </div>
</div>

















  <div class="modal fade" id="addNewCategoryPopupp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  style="z-index: 99999;">
     <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New  Category</h4>
        </div>
        <div class="modal-body">
                                 <form action="javascript:;" method="post">
                                         <div class="row">
                                                     <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <div class="input-group">
                                                                <input type="text" id="new_cat_name" value="" class="form-control" placeholder="Name"> 
                                                            </div>
                                                        </div>
                                                     </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control" id="new_cat_description"></textarea>
                                                        </div>
                                                   </div>
                                                    <div class="col-md-12">
                                                      <button style="min-width: 100%;" onclick="addCategory(this)" class="btn btn-primary">Add new Category</button>
                                                    </div> 
                                         </div>
                                    </form>
                                    <hr>
                            <h4 class="modal-title">Select Existing Categories</h4>
                               <div id="already-existing-categories-div"></div>
        </div>
    </div>
    </div>
  </div>







<script type="text/javascript">
     var ALL_CATEGORIES=[];
     var SELECTED_CATEGORIES=[];


     function addItemCategoryRow(){
      $('#addNewCategoryPopupp').modal({backdrop: 'static', keyboard: false});
        getAllCategories();
     }


    function getAllCategories(){
            showLoader('already-existing-categories-div');
            $.ajax(API_URL+'get-categories-all?company_id={{Auth::user()->company_id}}', {
                type: 'POST',  // http method
                dataType: 'json',
              //  data: { myData: 'This is my data.' },  // data to submit
                success: function (data, status, xhr) {
                    if (typeof data.data !== 'undefined'){
                          ALL_CATEGORIES=data.data;
                          createSlectableCaterogiesHtml();
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                        $('p').append('Error' + errorMessage);
                }
            });
    }
 
     function createSlectableCaterogiesHtml(){
         var HTML='';
         if(ALL_CATEGORIES.length){
          ALL_CATEGORIES.map(function (category) {

                var checked="";
                SELECTED_CATEGORIES.map(function (sel_category) {
                       if(category.id==sel_category.id){ checked='checked';}
                })
               

              HTML=HTML
                      +
                   `<div class="row selectable-categories-div">
                    <div class="checkbox-inline">
                        <label class="checkbox checkbox-square checkbox-success">
                        <input class="categories_checkbox" category_name="`+category.name+`"  type="checkbox" `+checked+` value="`+category.id+`" />`+category.name+`
                        <span></span></label>
                    </div>
                   </div>` 
            });

            HTML=HTML+`<span style="min-width: 100%; margin-top:20px"   class="btn btn-primary" onclick="UpdateSelectedCategories();" >Select Categories</span>`; 
           }else{
            var HTML='<center>Please add some categories...<center>';
           }

          $('#already-existing-categories-div').html(HTML);
     }

 function remove_category(id){
          swal({
          title: "Are you sure?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
             /////////////////////////////////////////
             var AllCategoriesArray=[];
                SELECTED_CATEGORIES.map(function (sel_category) {
                        sel_category.price=$('#category_'+sel_category.id).val();
                        if(id !=sel_category.id){ AllCategoriesArray.push(sel_category);}
                })
              SELECTED_CATEGORIES=AllCategoriesArray;
              generateSelectedCategoryHtml();
             /////////////////////////////////////////////
          }       
        });
 }

function UpdateSelectedCategories(){
      var all_selected_categoriesArray=[];
      $.each($(".categories_checkbox:checked"), function(){
        var CategoryId=$(this). val();
        var CategoryName=$(this).attr('category_name');
             var cat={
              id:CategoryId,
              price:0,
              name:CategoryName
             };
         //checkAlready
              SELECTED_CATEGORIES.map(function (category) {
                   if(category.id==CategoryId){

                      var price=$('#category_'+CategoryId).val();
                          cat={
                            id:CategoryId,
                            price:price,
                            name:category.name
                           };
                   }
              })
        //End check already   
       all_selected_categoriesArray.push(cat)
      });
      SELECTED_CATEGORIES=all_selected_categoriesArray;

      generateSelectedCategoryHtml();
       $('#addNewCategoryPopupp').modal('toggle');
}

function generateSelectedCategoryHtml(){
         var HTML='';
         SELECTED_CATEGORIES.map(function (category) {
                                    HTML=HTML+    `<div class="col-md-6">
                                                <div class="form-group">
                                                    <label>
                                                        `+category.name+`
                                                    </label>
                                                    <div class="input-group">
                                                         
                                                        <input onkeyup="validateCurrency(this)" type="text" id="category_`+category.id+`" name="category_price[`+category.id+`]" class="form-control currency_input" value="`+category.price+`" placeholder="Price" name="price">
                                                        <span class="remove_category" onclick="remove_category(`+category.id+`)">X</span>
                                                       
                                                        
                                                    </div>
                                                </div>
                                        </div>`;

          });
         $('#selected-categories-div').html(HTML);

}



function addCategory(btn){
  var name= $('#new_cat_name').val();
  var description= $('#new_cat_description').val();
  if(name==''){ 
         swal({
              title: "Err!",
              text: "Please enter a Category name",
              icon: "warning",
             });
        return false;

    }

    $(btn).attr('disabled','disabled');
     showLoader('already-existing-categories-div');
            $.ajax(API_URL+'categories/add?company_id={{Auth::user()->company_id}}', {
                type: 'POST',  // http method
                dataType: 'json',
                data: { name:name,description:description  },  // data to submit
                success: function (data, status, xhr) {
                    if (typeof data.data !== 'undefined'){
                        $('#new_cat_name').val('');
                        $('#new_cat_description').val('');
                        $(btn).removeAttr('disabled');
                        getAllCategories();  
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                        $('p').append('Error' + errorMessage);
                         $(btn).removeAttr('disabled');
                }
            });
  
}


 </script>











<script type="text/javascript">
 


function saveItems(btn){
	if($('#new_item_name').val()==''){ 
				swal({
		              title: "Err!",
		              text: "Please enter  name",
		              icon: "warning",
		             });
		        return false;
         }
    if($('#new_item_price').val()==''){ 
                    swal({
		              title: "Err!",
		              text: "Please enter item price",
		              icon: "warning",
		             });
		        return false;
     }
	 



  $(btn).attr('disabled');
      var frm = $('#newItemForm');

 $.ajax(API_URL+'items/add?company_id={{Auth::user()->company_id}}', {
                type: 'POST',  // http method
                dataType: 'json',
                data: frm.serialize(),  // data to submit
                success: function (data, status, xhr) {
                    if (typeof data.data !== 'undefined'){
                       loadAlreadyExistsItemsData($('#uniqId').val());


						  swal({
		                    	html:true,
				              title: "Success!",
				              text: 'Item Successfully Added',
				              icon: "success",
				             });
						         $('#addNewItemModelPopUp').modal('hide');  
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                        // $('p').append('Error' + errorMessage);
                       var errors=jqXhr.responseJSON.data;
                       var msg='';
 						if (typeof errors.price !== 'undefined'){ msg=msg+errors.price[0]+' ';   }
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
 
.row.selectable-categories-div {
    padding: 5px 15px;
}
label.checkbox.checkbox-square {
    margin-left: 10px;
    font-size: 14px;
    font-weight: 600;
}

    .remove_category{cursor: pointer;
    font-weight: 800;
    padding: 10px;
    font-size: 12px;
    background: red;
    color: white;
    }
                    </style>
  

