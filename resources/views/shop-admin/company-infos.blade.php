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
                                     <a href="{{url('company-infos')}}" class="btn btn-light-warning font-weight-bolder btn-sm">  Company Information</a>
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
                                    <form  action="{{url('company-infos')}}" method="post" enctype="multipart/form-data">
                                       {{ csrf_field() }}
                                        <div class="form-body">
                                             <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                        @if(isset($company->logo) && !empty($company->logo))
                                                                        <img src="{{ asset('companyLogo/' . $company->logo) }}" alt="" id="image" />
                                                                        @else
                                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="image" />
                                                                        @endif

                                                                    </div>
                                           <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> Company Logo </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                             <input type="file" id="fileupload" name="logo"> </span>
                                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                    </div>
                                                                </div>
                                             <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Name</label>
                                                <div class="input-group">
                                                   
                                                    <input type="text" name="name"  value="{{$company->name}}" class="form-control" placeholder="Name"> 
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
                                                <label>Phone</label>
                                                <div class="input-group">
                                                   
                                                    <input type="text" name="phone"  value="{{$company->phone}}" class="form-control" placeholder="Phone"> 
                                                </div>
                                            </div>
                                             @error('phone')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <div class="input-group">
                                                   
                                                    <select type="text" name="country" class="form-control">
                                                        <option>Select</option>
                                                        <option value="1" {{$company->country == 1  ? 'selected' : ''}}>India</option>
                                                    </select>
                                                   <!--  <input type="text" name="country"  value="{{$company->country}}" class="form-control" placeholder="Country">  -->
                                                </div>
                                            </div>
                                             @error('country')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>State</label>
                                                <div class="input-group">
                                                   
                                                    <input type="text" name="state"  value="{{$company->state}}" class="form-control" placeholder="State"> 
                                                </div>
                                            </div>
                                             @error('state')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <div class="input-group">
                                                    
                                                    <input type="text" name="city"  value="{{$company->city}}" class="form-control" placeholder="City"> 
                                                </div>
                                            </div>
                                             @error('city')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Zip</label>
                                                <div class="input-group">
                                                   
                                                    <input type="text" name="zip"  value="{{$company->zip}}" class="form-control" placeholder="Zip"> 
                                                </div>
                                            </div>
                                             @error('zip')
                                                <span class="invalid-feedback" style="color:red" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                           
                                      
<div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                              <textarea class="form-control" name="address" placeholder="Street1" >{{$company->address}}</textarea>
                                              <br/>
                                               <textarea class="form-control" name="address1" placeholder="Street2" >{{$company->address1}}</textarea>                              
                                            </div>
                                            @error('address')
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
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->
                          
                        </div>
                        
                    </div>
                </div>
                  <style type="text/css">
                        span.input-group-addon {
    padding: 9px;
    border: 1px solid #e5eaee;
    margin-right: .5px;
}
                    </style>
                 <!-- END CONTENT BODY -->
@endsection
@section('css')

  <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{url('')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
                <!-- END PAGE LEVEL PLUGINS -->

@endsection


@section('script')

<!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{url('')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="{{url('')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
 <script type="text/javascript">
     $(function () {
         $("#fileupload").change(function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("image").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});
});
</script>
@endsection



