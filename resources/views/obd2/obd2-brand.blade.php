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
                                      
                                    <!--end::Actions-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Toolbar-->
                                <div>
                                  



















                                </div>
                              
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

                            <div class="card-body" style="display: block;">
                              <div class="row"> 
                                    <div class="col-md-6 pagination-nav"> 
                                    {{ $Obd2s->withQueryString()->links() }}
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="topnav" style="    margin-bottom: 5px;float: right;margin-top: -30px;">
                                          <input type="text" placeholder="Search a brand.." value="{{isset($_REQUEST['q'])?$_REQUEST['q']:''}}" id="q" > <i class="fa fa-search" onclick="window.location='{{url('obd2-brands?q=')}}'+$('#q').val();" > </i>
                                        </div>
                                    </div>
                              </div>



                                                 <ul class="nav nav-pills nav-pills-sm nav-dark-75" style="width: 100%">
                                                        <li class="nav-item m-tab" style="width: 50%;margin: 0">
                                                            <a onclick="$('.Completed').hide(); $('.Pending').show();" class="nav-link py-2 px-4 tabnav_a active"  href="{{url('obd2-brands')}}"> By Brand</a>
                                                        </li>
                                                        <li class="nav-item m-tab" style="width: 50%;margin: 0">
                                                            <a onclick="$('.Pending').hide(); $('.Completed').show();" class="nav-link py-2 px-4 tabnav_a" href="{{url('obd2-codes')}}">By Code</a>
                                                        </li>
                                                    </ul>

                                                  
  
 


 <div class="table-scrollable" style="margin-top: 20px">
                                      
                                        <table class="table table-striped table-bordered table-advance table-hover">

                                            <thead>
                                                <tr>
                                                     <th> Brand </th>                                               
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                
                                                 @foreach ($Obd2s as $obd2)
                                                 <tr>
                                                     <td class="highlight">  <a href="{{url('obd2-codes?brand='.$obd2->brand)}}"  > <b style="    font-size: 20px;">{{$obd2->brand }}</b> </a></td>
                                                     <td>
                                                             <a style="float: right; background: #3798f7;" href="{{url('obd2-codes?brand='.$obd2->brand)}}"    class="btn btn-outline btn-circle dark btn-sm black">
                                                                    <i class="fa fa-search" style="color: white"></i> 
                                                            </a>
                                                    </td>
                                                </tr>
                                                 @endforeach
                                               
                                            </tbody>
                                           
                                        </table>
                                         <div class="row">
                                           <div class="col-md-6">
                                              {{ $Obd2s->withQueryString()->links() }}
                                           </div>
                                            
                                        </div>
                                       
                                     </div>





                                    

                                   
                                </div>
<!-- ////////////////////////////////////////////////////////////////////////////////////// -->


 
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->
                    </div>
@endsection
 
@section('css')
<style type="text/css">
 
/* Style the search box inside the navigation bar */
.topnav input[type=text] {
  float: left;
  padding: 10px;
   border: 2px solid #3798f7 !important;
  font-size: 14px;
}

li.nav-item.m-tab a {
    font-size: 16px;
    border-radius: 0px;
    border: 2px solid #3798f7;
    font-weight: 600 !important;
}
/* When the screen is less than 600px wide, stack the links and the search field vertically instead of horizontally */
@media screen and (max-width: 600px) {
  .topnav a, .topnav input[type=text] {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;
  }
}

.topnav i.fa.fa-search {
    margin-top: 8px;
    padding: 12px;
    height: 41px;
    color: white;
    background: #3798f7;
}
.pagination-nav nav{
    margin-top: -20px;
}
    </style>
@endsection
