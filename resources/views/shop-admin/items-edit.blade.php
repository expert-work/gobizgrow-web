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
                                     <a href="{{url('items')}}" class="btn btn-light-warning font-weight-bolder btn-sm"> Items</a>
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
                                    <form  action="{{url('items/edit/'.$item->auth_token)}}" method="post">
                                       {{ csrf_field() }}
                                        <div class="row">
                                             <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                    <input type="text" name="name"  value="{{$item->name}}" class="form-control" placeholder="Name"> 
                                                </div>
                                            </div>
                                             @error('name')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control" name="description" >{{$item->description}}</textarea>
                                                                                                    
                                            </div>
                                            @error('description')
                                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                     @enderror
                                        </div>
                                       

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Price</label>
                                                <div class="input-group">
                                                 <input type="text" value="{{$item->price}}" class="form-control currency_input" placeholder="Price" name="price">
                                                   
                                                    
                                                </div>
                                            </div>
                                            @error('price')
                                                        <span class="invalid-feedback" style="color:red" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                               
                                      @if(isset($pqr))
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Unit</label>
                                                 <div class="input-group">
                                                    <select name="unit"  class="form-control" >
                                                        <option>Select</option>
                                                        @foreach($units as $unit)
                                                        <option value="{{ $unit->id }}" {{$item->unit == $unit->id  ? 'selected' : ''}}>
                                                            {{ $unit->name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <!-- <input type="text" name="company" value="{{old('company')}}" class="form-control" placeholder="Company"> --> 
                                                </div>
                                              </div>
                                               @error('unit')
                                                        <span class="invalid-feedback" style="color:red" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                               @enderror
                                        </div>
                                      @endif

                                    <div class="col-md-12">
                                             <br><h4>Add Category Based Pricing:</h4>
                                        </div>

                                      <div id="selected-categories-div" class="row" style="padding: 15px;width: 100%;"> </div>
                                     
                                      <div class="col-md-12">
                                            <div class=" block item_block_footer" onclick="addItemRow()" data-toggle="modal" data-target="#myModal"> 
                                                <div class="col-md-12 col-sm-12 col-xs-12"> 
                                                   <span>+ Add Categories</span>
                                                </div>
                                            </div>
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


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Select Categories</h4>
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

<style type="text/css">
span.input-group-addon {
    padding: 9px;
    border: 1px solid #e5eaee;
    margin-right: .5px;
}
.item_block_footer {
    margin-top: 10px;
    text-align: center;
    padding: 5px;
    line-height: 31px;
    height: 42px;
    border: 2px solid #3798f7;
    font-size: 16px;
    color: #3798dc;
    font-weight: 600;
    margin-bottom: 5px;
    background-color: #ffffff;
    cursor: pointer;
}
.block {
    clear: both;
    width: 300px;
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
@endsection
 
 

@section('script')
 <script type="text/javascript">
    
 




     var ALL_CATEGORIES=[];
     var SELECTED_CATEGORIES=[];
      
             SELECTED_CATEGORIES=<?php echo $item_categories ;?>;
      

     function addItemRow(){
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
       $('#myModal').modal('toggle');
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



$(function() {
    generateSelectedCategoryHtml();
});


 </script>
@endsection
