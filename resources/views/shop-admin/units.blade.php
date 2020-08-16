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
                                     <a href="{{url('units/new')}}" class="btn btn-light-warning font-weight-bolder btn-sm">Add Unit</a>
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
                                    <div class="table-scrollable">
                                          
                                     <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th>  Name </th>
                                                    
                                                    
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach ($units as $user)


                                                <tr>
                                                    <td class="highlight"> {{$user->name }} </td>
                                                   
                                                     
                                                    <td>
                                                            <a href="{{url('units/edit/'.$user->auth_token)}}" class="btn btn-outline btn-circle btn-sm purple">
                                                               <i class="fa fa-edit"></i> Edit 
                                                            </a>
                                                             <a href="javascript:void(0)" onclick="deleteUnit('{{ $user->auth_token }}')"  class="btn btn-outline btn-circle dark btn-sm black">
                                                                   <i class="fa fa-trash"></i> Delete 
                                                            </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row">
                                           <div class="col-md-6">
                                              {{ $units->withQueryString()->links() }}
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
                function deleteUnit(id){
                       swal({
                              title: "Are you sure?",
                              text: "Once deleted, you will not be able to recover!",
                              icon: "warning",
                              buttons: true,
                              dangerMode: true,
                            })
                            .then((willDelete) => {
                              if (willDelete) { window.location.href='{{url('units/delete/')}}/'+id; }  
                     });
                    }
       </script>
@endsection


