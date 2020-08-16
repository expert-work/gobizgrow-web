@extends('layouts.app')

@section('content')






  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Subheader-->
                        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                           

                            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center flex-wrap mr-2">
                                    <!--begin::Page Title-->
                                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                                    <!--end::Page Title-->
                                    <!--begin::Actions-->
                                   
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






<!-- ///////Upgrade Act Status  START ///////////////////////////////////////////////////////-->   
<!-- ///////Upgrade Act Status  START ///////////////////////////////////////////////////////-->   
<!-- ///////Upgrade Act Status  START ///////////////////////////////////////////////////////-->   

                      @if(isset($subscriptionStatus))
                          @if(Auth::user()->subscription_status  !='ACTIVE')
                           <div class="subscription_notice_bar" > 
                             <div class="card card-custom bg-gray-100 card-stretch gutter-b" style="background: #12876f !important">
                                  <div class="subscription_notice_bar_inner row">
                                    <div class="col-md-8" style="line-height: 38px;font-size: 18px;"> You have {{$subscriptionStatus['days']}} days left in your free trail! Upgrade for $20 a month!</div>
                                    <div class="col-md-4"><a href="javascript:;" style="    background: white;font-size: 18px;color: #3a876f;" data-toggle="modal" data-target="#upgradePlanPopup" class="btn btn-light-warning font-weight-bolder btn-sm"> Upgrade Now</a></div>
                                 </div>
                              </div>
                           </div>

                          @endif
                        @endif

<!-- ///////Upgrade Act Status  END ///////////////////////////////////////////////////////-->   
<!-- ///////Upgrade Act Status  END ///////////////////////////////////////////////////////-->   
<!-- ///////Upgrade Act Status  END ///////////////////////////////////////////////////////-->   




<div class="row">
                  <!--begin::Column-->
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b card-stretch">
                      <!--begin::Body-->
                      <div class="card-body text-center pt-4">
                        <!--begin::User-->
                        <div class="mt-7">
                          <div class="symbol symbol-circle symbol-lg-90">
                             <span class="svg-icon menu-icon dashboard">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="60px" height="60px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                          </div>
                        </div>
                        <!--end::User-->
                        <!--begin::Name-->
                        <div class="my-4">
                          <a href="{{url('customers')}}" class="text-dark font-weight-bold text-hover-primary font-size-h4">Customers</a>
                        </div>
                        <!--end::Name-->


                        <!--begin::Label-->
                        <a href="{{url('customers')}}" class="  btn btn-text btn-light-warning btn-sm font-weight-bold rightButton">View All</a>
                        <a href="{{url('customers/new')}}" class="btn btn-text btn-light-warning btn-sm font-weight-bold leftButton">Add New</a>
                        <!--end::Label-->
                        <!--begin::Buttons-->
                        
                        <!--end::Buttons-->
                      </div>
                      <!--end::Body-->
                    </div>
                    <!--end::Card-->
                  </div>
                  <!--end::Column-->
 


                   <!--begin::Column-->
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b card-stretch">
                      <!--begin::Body-->
                      <div class="card-body text-center pt-4">
                        <!--begin::User-->
                        <div class="mt-7">
                          <div class="symbol symbol-circle symbol-lg-90">
                             <span class="svg-icon menu-icon dashboard">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M5,5 L5,15 C5,15.5948613 5.25970314,16.1290656 5.6719139,16.4954176 C5.71978107,16.5379595 5.76682388,16.5788906 5.81365532,16.6178662 C5.82524933,16.6294602 15,7.45470952 15,7.45470952 C15,6.9962515 15,6.17801499 15,5 L5,5 Z M5,3 L15,3 C16.1045695,3 17,3.8954305 17,5 L17,15 C17,17.209139 15.209139,19 13,19 L7,19 C4.790861,19 3,17.209139 3,15 L3,5 C3,3.8954305 3.8954305,3 5,3 Z" fill="#000000" fill-rule="nonzero" transform="translate(10.000000, 11.000000) rotate(-315.000000) translate(-10.000000, -11.000000)" />
                                                    <path d="M20,22 C21.6568542,22 23,20.6568542 23,19 C23,17.8954305 22,16.2287638 20,14 C18,16.2287638 17,17.8954305 17,19 C17,20.6568542 18.3431458,22 20,22 Z" fill="#000000" opacity="0.3" />
                                                </g>

                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                          </div>
                        </div>
                        <!--end::User-->
                        <!--begin::Name-->
                        <div class="my-4">
                          <a href="{{url('items')}}" class="text-dark font-weight-bold text-hover-primary font-size-h4">Items</a>
                        </div>
                        <!--end::Name-->
                        <!--begin::Label-->
                        



                        <a href="{{url('items')}}" class="btn btn-text btn-light-warning btn-sm font-weight-bold rightButton">View All</a>
                        <!--end::Label-->
                        <a href="{{url('items/new')}}" class="btn btn-text btn-light-warning btn-sm font-weight-bold leftButton">Add New</a>

                         
                        <!--end::Buttons-->
                      </div>
                      <!--end::Body-->
                    </div>
                    <!--end::Card-->
                  </div>
                  <!--end::Column-->



                  <!--begin::Column-->
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b card-stretch">
                      <!--begin::Body-->
                      <div class="card-body text-center pt-4">
                        <!--begin::User-->
                        <div class="mt-7">
                          <div class="symbol symbol-circle symbol-lg-90">
                            <span class="svg-icon menu-icon dashboard">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />
                                                    <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />
                                                </g>
                                          </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                          </div>
                        </div>
                        <!--end::User-->
                        <!--begin::Name-->
                        <div class="my-4">
                          <a href="{{url('invoices')}}" class="text-dark font-weight-bold text-hover-primary font-size-h4">Invoices</a>
                        </div>
                        <!--end::Name-->
                        <!--begin::Label-->

                        


                         <a href="{{url('invoices')}}" class="btn btn-text btn-light-warning btn-sm font-weight-bold rightButton">
                               View All
                            </a>

                          @if(Auth::user()->subscription_status  !='ACTIVE' && $subscriptionStatus['days']<1 ) 
                          <a href="javascript:;" onclick="openNewInvEstiPopup('{{url('invoices/new')}}')" class="btn btn-text btn-light-warning btn-sm font-weight-bold leftButton">
                               Add New
                            </a>
                          @else
                           <a href="{{url('invoices/new')}}" class="btn btn-text btn-light-warning btn-sm font-weight-bold leftButton">
                               Add New
                            </a>
                          @endif                        <!--end::Label-->
                        <!--begin::Buttons-->
                        
                        <!--end::Buttons-->
                      </div>
                      <!--end::Body-->
                    </div>
                    <!--end::Card-->
                  </div>
                  <!--end::Column-->
 

                   <!--begin::Column-->
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b card-stretch">
                      <!--begin::Body-->
                      <div class="card-body text-center pt-4">
                        <!--begin::User-->
                        <div class="mt-7">
                          <div class="symbol symbol-circle symbol-lg-90">
                            <span class="svg-icon menu-icon dashboard">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
                                                    <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
                                                </g>                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span> 
                          </div>
                        </div>
                        <!--end::User-->
                        <!--begin::Name-->
                        <div class="my-4">
                          <a href="{{url('estimates')}}" class="text-dark font-weight-bold text-hover-primary font-size-h4">Estimates</a>
                        </div>
                        <!--end::Name-->
                        <!--begin::Label-->
                        

                        <a href="{{url('estimates')}}" class="btn btn-text btn-light-warning btn-sm font-weight-bold rightButton">
                               View All
                            </a>

                        @if(Auth::user()->subscription_status  !='ACTIVE' && $subscriptionStatus['days']<1) 
                          <a href="javascript:;" onclick="openNewInvEstiPopup('{{url('estimates/new')}}')" class="btn btn-text btn-light-warning btn-sm font-weight-bold leftButton">
                               Add New
                            </a>
                          @else
                           <a href="{{url('estimates/new')}}" class="btn btn-text btn-light-warning btn-sm font-weight-bold leftButton">
                               Add New
                            </a>
                          @endif




                         <!--end::Label-->
                        <!--begin::Buttons-->
                        
                        <!--end::Buttons-->
                      </div>
                      <!--end::Body-->
                    </div>
                    <!--end::Card-->
                  </div>
                  <!--end::Column-->


                  <!--end::Column-->
                </div>



                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-lg-6 col-xxl-4">
                                        <!--begin::Mixed Widget 1-->
                                        <div class="card card-custom  card-stretch gutter-b" style="padding: 61px 20px">
                                            <!--begin::Header-->
                                            <h4 style="font-weight: 800;color: #4dad76;">Take Payments from Customers</h4> <p> Ready to start accepting easily accepting payments from customers through this website and app?  We’ve partnered with Stripe to make it super simple.</p>


                                            <center><a href="javascript:;" onclick="window.location='https://connect.stripe.com/oauth/authorize?client_id={{env('STRIPE_CLIENT_ID')}}&state={{Auth::user()->auth_token}}&scope=read_write&response_type=code&stripe_user[email]={{Auth::user()->email}}'"> <img src="{{url('images/stripe/stripe_connect.png')}}"> </a></center>
                                        </div>
                                        <!--end::Mixed Widget 1-->
                                    </div>
                                    <div class="col-lg-6 col-xxl-4">
                                        <!--begin::List Widget 9-->
                                        <div class="card card-custom card-stretch gutter-b">
                                            <!--begin::Header-->
                                            <div class="card-header align-items-center border-0 mt-4">
                                                <ul class="nav nav-pills nav-pills-sm nav-dark-75" style="width: 100%">
                                                        <li class="nav-item" style="width: 50%;margin: 0">
                                                            <a  onclick="$('.Completed').hide(); $('.Pending').show();" class="nav-link py-2 px-4 tabnav_a active" data-toggle="tab" href="#kt_tab_pane_1_1">Tasks</a>
                                                        </li>
                                                        <li class="nav-item" style="width: 50%;margin: 0">
                                                            <a  onclick="$('.Pending').hide(); $('.Completed').show();" class="nav-link py-2 px-4 tabnav_a" data-toggle="tab" href="#kt_tab_pane_1_2">Completed</a>
                                                        </li>
                                                    </ul>

                                                    <a href="javascript:;" class="add_new_task_btn" onclick="$('#task-text').val('');" data-toggle="modal" data-target="#addTask" > Add New Task</a>


                                            </div>
                                            <style type="text/css">
                                                .tabnav_a{
                                                    font-size: 16px;
                                                    font-weight: 500;
                                                    display: block !important;
                                                    text-align: center !important;
                                                    border: 1px solid #ebecf5;
                                                    margin: 1px;
                                                }
                                                a.add_new_task_btn {
                                                    text-align: center;
                                                    width: 100%;
                                                    display: block;
                                                    border: 2px solid #ebecf5;
                                                    border-radius: 5px;
                                                    padding: 7px;
                                                    margin-top: 10px;
                                                    font-size: 16px;
                                                    font-weight: 500;
                                                }
                                                                                            
                                            </style>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body pt-4">
                                                <div class=" timeline-5 mt-3"   id="tasks-container"> 
                                                    <!-- ///////////////////////////////////// -->
                                                    @if(isset($tasks))
                                                      @foreach($tasks as $task)
                                                        


                                                        <div class="align-items-center mb-10 {{$task->status}}" id="task-{{$task->id}}">
                                                            <!--end::Symbol-->
                                                            <!--begin::Text-->
                                                            <div style="text-align: justify;" id="task-content-{{$task->id}}">
                                                                {{$task->task}}
                                                            </div>
                                                            
                                                              @if($task->status=='Pending')
                                                                    <div style="
                                                                    font-size: 16px;
                                                                    text-align: right;
                                                                    color: #3798f7;
                                                                    "> <a href="javascript:;" onclick="completeTask('{{$task->id}}')">Complete </a></div>
                                                              @else

                                                                    <div style="
                                                                    font-size: 16px;
                                                                    text-align: right;
                                                                    color: red;
                                                                    "> <a href="javascript:;" onclick="deleteTask('{{$task->id}}')" style="color: red">Delete </a></div>
                                                              @endif
                                                              <hr>



                                                            <!--end::Text-->
                                                        </div>


                                                      @endforeach
                                                    @endif
                                                    <!-- ////////////////////////////////////////// -->
                                                </div>
                                                <!--end: Items-->
                                            </div>
                                            <!--end: Card Body-->
                                        </div>
                                        <!--end: Card-->
                                        <!--end: List Widget 9-->
                                    </div>
                                    <div class="col-lg-6 col-xxl-4">
                                        <!--begin::Stats Widget 11-->
                                        <div class="card card-custom card-stretch card-stretch-half gutter-b">
                                            <!--begin::Body-->
                                            <div class="card-body p-0">
                                                <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                                                    <span class="symbol symbol-50 symbol-light-success mr-2">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-xl svg-icon-success">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                                                        <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <div class="d-flex flex-column text-right">
                                                        <span class="text-dark-75 font-weight-bolder font-size-h3">750$</span>
                                                        <span class="text-muted font-weight-bold mt-2">Weekly Income</span>
                                                    </div>
                                                </div>
                                                <div id="kt_stats_widget_11_chart" class="card-rounded-bottom" data-color="success" style="height: 150px"></div>
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Stats Widget 11-->
                                        <!--begin::Stats Widget 12-->
                                        <div class="card card-custom card-stretch card-stretch-half gutter-b">
                                            <!--begin::Body-->
                                            <div class="card-body p-0">
                                                <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                                                    <span class="symbol symbol-50 symbol-light-primary mr-2">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-xl svg-icon-primary">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </span>
                                                    <div class="d-flex flex-column text-right">
                                                        <span class="text-dark-75 font-weight-bolder font-size-h3">+6,5K</span>
                                                        <span class="text-muted font-weight-bold mt-2">New Users</span>
                                                    </div>
                                                </div>
                                                <div id="kt_stats_widget_12_chart" class="card-rounded-bottom" data-color="primary" style="height: 150px"></div>
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Stats Widget 12-->
                                    </div>
                                    <div class="col-lg-6 col-xxl-4 order-1 order-xxl-1">
                                        <!--begin::List Widget 1-->
                                        <div class="card card-custom card-stretch gutter-b">
                                            <!--begin::Header-->
                                            <div class="card-header border-0 pt-5">
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label font-weight-bolder text-dark">Tasks Overview</span>
                                                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Pending 10 tasks</span>
                                                </h3>
                                                <div class="card-toolbar">
                                                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                                                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ki ki-bold-more-ver"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                            <!--begin::Navigation-->
                                                            <ul class="navi navi-hover py-5">
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="flaticon2-drop"></i>
                                                                        </span>
                                                                        <span class="navi-text">New Group</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="flaticon2-list-3"></i>
                                                                        </span>
                                                                        <span class="navi-text">Contacts</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="flaticon2-rocket-1"></i>
                                                                        </span>
                                                                        <span class="navi-text">Groups</span>
                                                                        <span class="navi-link-badge">
                                                                            <span class="label label-light-primary label-inline font-weight-bold">new</span>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="flaticon2-bell-2"></i>
                                                                        </span>
                                                                        <span class="navi-text">Calls</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="flaticon2-gear"></i>
                                                                        </span>
                                                                        <span class="navi-text">Settings</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-separator my-3"></li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="flaticon2-magnifier-tool"></i>
                                                                        </span>
                                                                        <span class="navi-text">Help</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="flaticon2-bell-2"></i>
                                                                        </span>
                                                                        <span class="navi-text">Privacy</span>
                                                                        <span class="navi-link-badge">
                                                                            <span class="label label-light-danger label-rounded font-weight-bold">5</span>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <!--end::Navigation-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body pt-8">
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-10">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-40 symbol-light-primary mr-5">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
                                                                        <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column font-weight-bold">
                                                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Project Briefing</a>
                                                        <span class="text-muted">Project Manager</span>
                                                    </div>
                                                    <!--end::Text-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-10">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-40 symbol-light-warning mr-5">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-lg svg-icon-warning">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column font-weight-bold">
                                                        <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg">Concept Design</a>
                                                        <span class="text-muted">Art Director</span>
                                                    </div>
                                                    <!--end::Text-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-10">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-40 symbol-light-success mr-5">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-lg svg-icon-success">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
                                                                        <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column font-weight-bold">
                                                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Functional Logics</a>
                                                        <span class="text-muted">Lead Developer</span>
                                                    </div>
                                                    <!--end::Text-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-10">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-40 symbol-light-danger mr-5">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-lg svg-icon-danger">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Attachment2.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <path d="M11.7573593,15.2426407 L8.75735931,15.2426407 C8.20507456,15.2426407 7.75735931,15.6903559 7.75735931,16.2426407 C7.75735931,16.7949254 8.20507456,17.2426407 8.75735931,17.2426407 L11.7573593,17.2426407 L11.7573593,18.2426407 C11.7573593,19.3472102 10.8619288,20.2426407 9.75735931,20.2426407 L5.75735931,20.2426407 C4.65278981,20.2426407 3.75735931,19.3472102 3.75735931,18.2426407 L3.75735931,14.2426407 C3.75735931,13.1380712 4.65278981,12.2426407 5.75735931,12.2426407 L9.75735931,12.2426407 C10.8619288,12.2426407 11.7573593,13.1380712 11.7573593,14.2426407 L11.7573593,15.2426407 Z" fill="#000000" opacity="0.3" transform="translate(7.757359, 16.242641) rotate(-45.000000) translate(-7.757359, -16.242641)" />
                                                                        <path d="M12.2426407,8.75735931 L15.2426407,8.75735931 C15.7949254,8.75735931 16.2426407,8.30964406 16.2426407,7.75735931 C16.2426407,7.20507456 15.7949254,6.75735931 15.2426407,6.75735931 L12.2426407,6.75735931 L12.2426407,5.75735931 C12.2426407,4.65278981 13.1380712,3.75735931 14.2426407,3.75735931 L18.2426407,3.75735931 C19.3472102,3.75735931 20.2426407,4.65278981 20.2426407,5.75735931 L20.2426407,9.75735931 C20.2426407,10.8619288 19.3472102,11.7573593 18.2426407,11.7573593 L14.2426407,11.7573593 C13.1380712,11.7573593 12.2426407,10.8619288 12.2426407,9.75735931 L12.2426407,8.75735931 Z" fill="#000000" transform="translate(16.242641, 7.757359) rotate(-45.000000) translate(-16.242641, -7.757359)" />
                                                                        <path d="M5.89339828,3.42893219 C6.44568303,3.42893219 6.89339828,3.87664744 6.89339828,4.42893219 L6.89339828,6.42893219 C6.89339828,6.98121694 6.44568303,7.42893219 5.89339828,7.42893219 C5.34111353,7.42893219 4.89339828,6.98121694 4.89339828,6.42893219 L4.89339828,4.42893219 C4.89339828,3.87664744 5.34111353,3.42893219 5.89339828,3.42893219 Z M11.4289322,5.13603897 C11.8194565,5.52656326 11.8194565,6.15972824 11.4289322,6.55025253 L10.0147186,7.96446609 C9.62419433,8.35499039 8.99102936,8.35499039 8.60050506,7.96446609 C8.20998077,7.5739418 8.20998077,6.94077682 8.60050506,6.55025253 L10.0147186,5.13603897 C10.4052429,4.74551468 11.0384079,4.74551468 11.4289322,5.13603897 Z M0.600505063,5.13603897 C0.991029355,4.74551468 1.62419433,4.74551468 2.01471863,5.13603897 L3.42893219,6.55025253 C3.81945648,6.94077682 3.81945648,7.5739418 3.42893219,7.96446609 C3.0384079,8.35499039 2.40524292,8.35499039 2.01471863,7.96446609 L0.600505063,6.55025253 C0.209980772,6.15972824 0.209980772,5.52656326 0.600505063,5.13603897 Z" fill="#000000" opacity="0.3" transform="translate(6.014719, 5.843146) rotate(-45.000000) translate(-6.014719, -5.843146)" />
                                                                        <path d="M17.9142136,15.4497475 C18.4664983,15.4497475 18.9142136,15.8974627 18.9142136,16.4497475 L18.9142136,18.4497475 C18.9142136,19.0020322 18.4664983,19.4497475 17.9142136,19.4497475 C17.3619288,19.4497475 16.9142136,19.0020322 16.9142136,18.4497475 L16.9142136,16.4497475 C16.9142136,15.8974627 17.3619288,15.4497475 17.9142136,15.4497475 Z M23.4497475,17.1568542 C23.8402718,17.5473785 23.8402718,18.1805435 23.4497475,18.5710678 L22.0355339,19.9852814 C21.6450096,20.3758057 21.0118446,20.3758057 20.6213203,19.9852814 C20.2307961,19.5947571 20.2307961,18.9615921 20.6213203,18.5710678 L22.0355339,17.1568542 C22.4260582,16.76633 23.0592232,16.76633 23.4497475,17.1568542 Z M12.6213203,17.1568542 C13.0118446,16.76633 13.6450096,16.76633 14.0355339,17.1568542 L15.4497475,18.5710678 C15.8402718,18.9615921 15.8402718,19.5947571 15.4497475,19.9852814 C15.0592232,20.3758057 14.4260582,20.3758057 14.0355339,19.9852814 L12.6213203,18.5710678 C12.2307961,18.1805435 12.2307961,17.5473785 12.6213203,17.1568542 Z" fill="#000000" opacity="0.3" transform="translate(18.035534, 17.863961) scale(1, -1) rotate(45.000000) translate(-18.035534, -17.863961)" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column font-weight-bold">
                                                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Development</a>
                                                        <span class="text-muted">DevOps</span>
                                                    </div>
                                                    <!--end::Text-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-2">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-40 symbol-light-info mr-5">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-lg svg-icon-info">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Shield-user.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
                                                                        <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3" />
                                                                        <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column font-weight-bold">
                                                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Testing</a>
                                                        <span class="text-muted">QA Managers</span>
                                                    </div>
                                                    <!--end::Text-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::List Widget 1-->
                                    </div>
                            
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                                           <!--end::Row-->
                                <!--end::Dashboard-->
                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->
                    </div>




<!-- Modal -->
<div id="addTask" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- M  odal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">A new task</h4>
      </div>
      <div class="modal-body">
            <form action="javascript:;">
              <div class="form-group">
                <textarea style="width: 100%"; rows="6" class="form-control" placeholder="Enter your task here" id="task-text"></textarea>
              </div>
             <button type="submit" class="btn btn-primary" style="width: 100%" onclick="addNewTask()">Add New Task</button>
            </form>

      </div>
 
    </div>

  </div>
</div>



@endsection
 @section('css')
<style type="text/css">
  span.svg-icon.menu-icon.dashboard svg {
      width: 60px !important;
      height: 60px !important;
  }
  .card.card-custom.card-stretch.gutter-b {
    height: auto !important;
}
.Completed {
    display: none;
}


.leftButton{
    font-weight: 800 !important;
    color: white !important;
    background: #3798f7 !important;
    border: 1px solid #3798f7 !important;
    margin-top: 3px;
}

.rightButton{
    font-weight: 800 !important;
    color: #3798f7 !important;
    background: white !important;
    border: 1px solid #3798f7 !important;
    margin-top: 3px;
}


@media only screen and (max-width: 600px) {
.col-xl-3.col-lg-3.col-md-3.col-sm-3.col-xs-3 {
    padding: 5px;
    width: 33.3%;
}
.col-xl-3.col-lg-3.col-md-3.col-sm-3.col-xs-3 .card-body.text-center.pt-4 {
    padding: 0;
    padding-bottom: 20px;
}


}
</style>
@endsection

@section('script')

<script type="text/javascript">
    $(function() {
      $('.Completed').hide();
    })

 function completeTask(id){
 
    $.ajax({
           type: "GET",
           url: '{{url('web-api/add-task-complete')}}/?id='+id,
           success: function(data)
           {
                if(data.data){
                  data=data.data;
                     swal({
                              title: "Successfully updated",
                              text: "",
                              icon: "success",
                               dangerMode: true,
                            })
                            .then((willDelete) => {
                              if (willDelete) {

                                   $('#task-'+id).remove();

                                  var html=   `<div class="align-items-center mb-10 Completed" style="display:none" id="task-`+data.id+`">
                                              <div style="text-align: justify;"  id="task-content-`+data.id+`" >`+data.task+`</div>
                                                  <div style="
                                                      font-size: 16px;
                                                      text-align: right;
                                                      color: red;
                                                      "> <a href="javascript:;" onclick="deleteTask('`+data.id+`')" style="color:red">Delete </a></div>
                                                  <hr>
                                          </div>`;

                                          var content= $('#tasks-container').html();
                                          $('#tasks-container').html(html+content);
                                          $("#addTask").modal("hide");
                               } 
                            });
                  
                }else{
                     alert(data.message);
                }
            }
         });




 }
 function deleteTask(id){
  if(confirm('Are you sure?')){
         $.ajax({
           type: "GET",
           url: '{{url('web-api/add-task-delete')}}/?id='+id,
           success: function(data)
           {
                if(data.data){
                      swal({
                              title: "Successfully Deleted",
                              text: "",
                              icon: "warning",
                               dangerMode: true,
                            })
                            .then((willDelete) => {
                              if (willDelete) {
                                   $('#task-'+id).remove();
                               } 
                            });
                  
                }else{
                     alert(data.message);
                }
            }
         });
  }


 }


   function addNewTask(){
     var task= $('#task-text').val().trim();
     if(task!=''){
 
    $.ajax({
           type: "GET",
           url: '{{url('web-api/add-task')}}/?task='+task,
           success: function(data)
           {
                if(data.data){
                  data=data.data;
                     swal({
                              title: "Successfully Created",
                              text: "",
                              icon: "success",
                               dangerMode: true,
                            })
                            .then((willDelete) => {
                              if (willDelete) {
                                  var html=   `<div class="align-items-center mb-10 Pending" style="" id="task-`+data.id+`">
                                              <div style="text-align: justify;"  id="task-content-`+data.id+`" >`+data.task+`</div>
                                                  <div style="
                                                      font-size: 16px;
                                                      text-align: right;
                                                      color: #3798f7;
                                                      "> <a href="javascript:;" onclick="completeTask('`+data.id+`')">Complete </a></div>
                                                  <hr>
                                          </div>`;

                                          var content= $('#tasks-container').html();
                                          $('#tasks-container').html(html+content);
                                          $("#addTask").modal("hide");
                               } 
                            });
                  
                }else{
                     alert(data.message);
                }
            }
         });






      }
   }

</script>




@endsection
