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
                                     <a href="{{url('shop-admins/new')}}" class="btn btn-light-warning font-weight-bolder btn-sm">New </a>
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
                                    <div class="table-scrollable">
                                      <form  action="{{url('customers/multidelete')}}" method="post">
                                       {{ csrf_field() }}
                                       <input type="hidden" name="model" value="Customer">
                                        <table class="table table-striped table-bordered table-advance table-hover">

                                            <thead>
                                                <tr>
                                                    <th> Name </th>
                                                    <th class="hidden-xs"> Email </th>
                                               
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach ($users as $user)
                                                <tr>
                                                    <td class="highlight"> {{$user->name }} </td>
                                                    <td class="hidden-xs">  {{$user->email}} </td>
                                                    <td>
                                                            <a href="{{url('shop-admins/edit/'.$user->id)}}" class="btn btn-outline btn-circle btn-sm purple">
                                                               <i class="fa fa-edit"></i> Edit 
                                                            </a>
                                                             <a href="javascript:void(0)" onclick="deleteShopAdmin({{ $user->id }})"  class="btn btn-outline btn-circle dark btn-sm black">
                                                                   <i class="fa fa-trash"></i> Delete 
                                                            </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>                                         
                                        </table>
                                         <div class="row">
                                           <div class="col-md-6">
                                              {{ $users->withQueryString()->links() }}
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
        <link href="{{url('')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
@endsection


@section('script')

<!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{url('')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="{{url('')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
 
       <script type="text/javascript">
                function deleteShopAdmin(id){
                       swal({
                              title: "Are you sure?",
                              text: "Once deleted, you will not be able to recover!",
                              icon: "warning",
                              buttons: true,
                              dangerMode: true,
                            })
                            .then((willDelete) => {
                              if (willDelete) { window.location.href='{{url('shop-admins/delete/')}}/'+id; }  
                       });
                    }
       </script>
@endsection


