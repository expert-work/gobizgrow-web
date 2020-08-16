<?php use App\Customer; ?>
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
                                <a href="{{url('invoices/new')}}" type="button" class="btn btn-fit-height grey-salt "   data-delay="1000" data-close-others="true"> New
                                 </a>
                                 
                            </div>
                            <a href="{{url('pdfview')}}">Download PDF</a>
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
                                                    
                                                    <th>  Date </th>
                                                    <th> Due Date </th>
                                                    <th>Customer</th>
                                                    <th>Status  </th>
                                                    <th>Paid Status  </th>
                                                    <th>Amount Due  </th> 
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach ($invoices as $invoice)


                                                <tr>
                                                    @if ($invoice->is_delete ==  0 )
                                                    
                                                    <td> {{ date('m/d/Y', strtotime($invoice->invoice_date)) }} </td>
                                                    <td> {{ date('m/d/Y', strtotime($invoice->due_date)) }} </td>
                                                    <td>
                                                      <?php echo Customer::where('id',$invoice->customer_id)->first()->name; ?>
                                                     </td>
                                                    <td> @if(!$invoice->paid_status) Draft @else Sent @endif  </td>
                                                    <td> @if(!$invoice->paid_status) Paid @else Unpaid @endif  </td>
                                                    <td>{{'$ '.$invoice->due_amount}}</td> 

                                                     <td>
                                                            <a href="{{url('invoices/edit/'.$invoice->auth_token)}}" class="btn btn-outline btn-circle btn-sm purple">
                                                               <i class="fa fa-edit"></i> Edit 
                                                            </a>
                                                          <!--    <a href="javascript:void(0)" onclick="deleteExpense('{{ $invoice->auth_token }}')"  class="btn btn-outline btn-circle dark btn-sm black">
                                                                   <i class="fa fa-trash-o"></i> Delete 
                                                            </a>
 -->                                                    </td>
                                                </tr>
                                                  @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                    <!-- {{ $invoices->withQueryString()->links() }} -->
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
                function deleteExpense(id){
                       swal({
                              title: "Are you sure?",
                              text: "Once deleted, you will not be able to recover!",
                              icon: "warning",
                              buttons: true,
                              dangerMode: true,
                            })
                            .then((willDelete) => {
                              if (willDelete) { window.location.href='{{url('expenses/delete/')}}/'+id; }  
                       });
                    }
       </script>
@endsection



