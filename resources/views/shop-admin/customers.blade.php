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
                                     <a href="{{url('customers/new')}}" class="btn btn-light-warning font-weight-bolder btn-sm">Add Customer</a>
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

   <div class="card-body" style="display: block;">


              <div class="my_custom_table">   
                                      <div class="d-flex align-items-center  custom_table_row">
                                         <div class="flexPoint4" style=""> <center> <input type="checkbox" id="selectall"/></center> </div>
                                         <div class="flexTwo" style=""><div class="border-right"> <b> Name </b></div></div>
                                         <div class="flexOne" style=""><div class="border-right"> <b>Email </b></div></div>
                                          <div class="flexPoint8" style="">Action </div>
                                       </div>
                                       <form  action="{{url('multidelete')}}" method="post">
                                        
                                       {{ csrf_field() }}
                                       @foreach ($customers as $user)
                                       <div class="d-flex align-items-center  custom_table_row">
                                         
                                         <div class="flexPoint4" style="">
                                                  <center> <input type="checkbox" class="case" name="isdelete[]" value="{{$user->id }}"/></center>
                                         </div>

                                         <div class="flexTwo" style=""><div class="border-right"> 
                                                  <b>{{$user->name }}</b> 
                                         </div></div>
                                        <div class="flexOne" style=""><div class="border-right"> 
                                                  <b>{{$user->email}}</b> 
                                         </div></div>
                                        
                                         <div class="flexPoint8" style="">
                                                             <ul class="nav">
                                                                  <li class="nav-item dropdown">
                                                                      <a href="javascript:;" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                                                      <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                                                    

                                                                                  <a href="{{url('customers/edit/'.$user->auth_token)}}" class="dropdown-item">
                                                                                       <i class="fa fa-edit"></i> Edit 
                                                                                    </a>

                                                                                     <a href="{{url('customers/view/'.$user->auth_token)}}" class=" dropdown-item">
                                                                                       <i class="fa fa-search"></i> View 
                                                                                    </a>

                                                                                     <a href="javascript:void(0)" onclick="deleteCustomer('{{ $user->auth_token }}')"  class="dropdown-item">
                                                                                            <i class="fa fa-trash"></i> Delete 
                                                                                    </a>

                                                                       </div>
                                                                   </li>
                                                              </ul>

                                          </div>
                                       </div>
                                       @endforeach

                                       <input type="hidden" name="model" value="Customer">

                                         <div class="row">
                                           <div class="col-md-6">
                                              {{ $customers->withQueryString()->links() }}
                                           </div>
                                           <div class="col-md-6">
                                              
                                                <button onclick="deleteAll()" style="float: right;" type="submit"  class="btn btn-danger pull-right btn-sm">Multiple Delete</button>
                                              
                                           </div>
                                        </div>

                                      </form> 
                                     </div>





 
                                    
                                </div>
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->
                          
                        </div>
                        
                    </div>
                  </div>


            
                <!-- END CONTENT BODY -->
@endsection
@section('css')

  <!-- BEGIN PAGE LEVEL PLUGINS -->
 @endsection


@section('script')

<!-- BEGIN PAGE LEVEL PLUGINS -->
   
       <script type="text/javascript">
        function deleteAll() {
                if (confirm("Are you sure?")) {
                      return true;
                }
                return false;
            }
                function deleteCustomer(id){
                       swal({
                              title: "Are you sure?",
                              text: "Once deleted, you will not be able to recover!",
                              icon: "warning",
                              buttons: true,
                              dangerMode: true,
                            })
                            .then((willDelete) => {
                         if (willDelete) { window.location.href='{{url('customers/delete/')}}/'+id; 
                          }  
                       });
                    }

                   
 $(function(){
$('#selectall').on('click' ,function(){
if($(this). prop("checked") == true){
$(".case").parent('span').addClass('checked');
$(".case"). prop("checked", true);
}else{
$(".case").parent('span').removeClass('checked');
$(".case"). prop("checked", false);
}
});
});

       </script>


@endsection



