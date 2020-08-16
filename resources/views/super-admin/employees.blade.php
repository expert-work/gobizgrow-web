@extends('layouts.app')

@section('content')
 
              
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                   
                    <!-- END THEME PANEL -->
                    <h3 class="page-title"> {{$page_name}}
                     </h3>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="{{url('')}}">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>{{$page_name}}</span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <a href="{{url('employees/new')}}" type="button" class="btn btn-fit-height grey-salt "   data-delay="1000" data-close-others="true"> New
                                 </a>
                                 
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN DASHBOARD STATS 1-->
                        <div class="row">
                        <div class="col-md-12 ">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption font-red-sunglo">
                                        <i class="icon-settings font-red-sunglo"></i>{{$page_name}} </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                                        <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body" style="display: block;">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fa fa-briefcase"></i> Name </th>
                                                    <th class="hidden-xs">
                                                        <i class="fa fa-user"></i> Email </th>
                                               
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach ($users as $user)
                                                <tr>
                                                    <td class="highlight"> {{$user->name }} </td>
                                                    <td class="hidden-xs">  {{$user->email}} </td>
                                                    <td>
                                                            <a href="{{url('employees/edit/'.$user->id)}}" class="btn btn-outline btn-circle btn-sm purple">
                                                               <i class="fa fa-edit"></i> Edit 
                                                            </a>
                                                             <a href="javascript:void(0)" onclick="deleteEmployee({{ $user->id }})"  class="btn btn-outline btn-circle dark btn-sm black">
                                                                   <i class="fa fa-trash-o"></i> Delete 
                                                            </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $users->withQueryString()->links() }}
                                </div>
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->
                          
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
                function deleteEmployee(id){
                       swal({
                              title: "Are you sure?",
                              text: "Once deleted, you will not be able to recover!",
                              icon: "warning",
                              buttons: true,
                              dangerMode: true,
                            })
                            .then((willDelete) => {
                              if (willDelete) { window.location.href='{{url('employees/delete/')}}/'+id; }  
                       });
                    }
       </script>
@endsection



