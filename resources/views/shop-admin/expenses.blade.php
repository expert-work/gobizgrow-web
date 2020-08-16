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
                                     <a href="{{url('expenses/new')}}" class="btn btn-light-warning font-weight-bolder btn-sm">Add Expense</a>
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

   <div class="card-body" style="display: block;">
                                   

              <div class="my_custom_table">   
                                      <div class="d-flex align-items-center  custom_table_row">
                                        <div class="flexPoint4" style="">  </div>
                                          <div class="flexTwo" style=""><div class="border-right"> <b> Expenses Date </b></div></div>
                                         <div class="flexOne" style=""><div class="border-right"> <b>Amount </b></div></div>
                                          <div class="flexPoint8" style="">Action </div>
                                       </div>
                                       
                                       @foreach ($expenses as $expense)
                                       <div class="d-flex align-items-center  custom_table_row">
                                         
                                          
                                        <div class="flexPoint4" style="">  </div>
                                         <div class="flexTwo" style=""><div class="border-right"> 
                                                  <b> {{ date('m/d/Y', strtotime($expense->expense_date)) }}</b> 
                                         </div></div>
                                        <div class="flexOne" style=""><div class="border-right"> 
                                                  <b> {{usaCurrencyFormat($expense->amount)}}</b> 
                                         </div></div>
                                        
                                         <div class="flexPoint8" style="">
                                                             <ul class="nav">
                                                                  <li class="nav-item dropdown">
                                                                      <a href="javascript:;" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                                                      <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                                                    

                                                                                  <a href="{{url('expenses/edit/'.$expense->auth_token)}}" class="dropdown-item">
                                                                                       <i class="fa fa-edit"></i> Edit 
                                                                                    </a>

                                                                                    

                                                                                     <a href="javascript:void(0)" onclick="deleteExpense('{{ $expense->auth_token }}')"  class="dropdown-item">
                                                                                            <i class="fa fa-trash"></i> Delete 
                                                                                    </a>

                                                                       </div>
                                                                   </li>
                                                              </ul>

                                          </div>
                                       </div>
                                       @endforeach

 
                                         <div class="row">
                                           <div class="col-md-6">
                                              {{ $expenses->withQueryString()->links() }}
                                           </div>
                                           
                                        </div>

                                      </form> 
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
     .inv-status-sent{ 
      background: rgba(246, 208, 154, 0.4);
    font-size: 13px;
    color: #A96E1A;
    padding: 5px 10px;
  }
  .inv-status-draft {
    font-size: 13px;
    color: rgb(108, 67, 46);
    background: rgb(248, 237, 203);
    padding: 5px 10px;
}
.inv-status-unpaid {
    background: #F8EDCB;
    font-size: 13px;
    color: #6C432E;
    padding: 5px 10px;
  }
  .inv-status-paid {
    background: rgba(246, 208, 154, 0.4);
    font-size: 13px;
    color: #A96E1A;
    padding: 5px 10px;
  }

</style>
  
@endsection


@section('script')
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


