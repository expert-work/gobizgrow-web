@extends('layouts.app')
@section('content')
 <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <!--begin::Subheader-->
                        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center flex-wrap mr-2">
                                    <!--begin::Page Title-->
                                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">User Profile | Account</h5>
                                    <!--end::Page Title-->
                                    <!--begin::Actions-->
                                      <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                                      <ul class="nav nav-tabs">
                                     <li class="active">
                                                        <a href="#tab_1_1" data-toggle="tab" class="btn btn-light-warning font-weight-bolder btn-sm">Personal Info</a>
                                                    </li>&nbsp;
                                                    <li>
                                                        <a href="#tab_1_2" data-toggle="tab" class="btn btn-light-warning font-weight-bolder btn-sm">Change Profile Photo</a>
                                                    </li>&nbsp;
                                                    <li>
                                                        <a href="#tab_1_3" data-toggle="tab" class="btn btn-light-warning font-weight-bolder btn-sm">Change Password</a>
                                                    </li>
                                                </ul>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Toolbar-->
                              
                            </div>
                        </div>

                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                                    <!-- END THEME PANEL -->
                    
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                           <!--  <div class="profile-sidebar">
                               
                                <div class="portlet light profile-sidebar-portlet ">
                                   
                                    <div class="profile-userpic">
                                        @if(isset($user->profile_pic) && !empty($user->profile_pic))
                                        <img src="{{ asset('images/' . $user->profile_pic) }}" class="img-responsive" alt="">
                                        @else
                                        <img src="{{url('')}}/assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
                                        @endif

                                         </div>
                                   
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"> {{$user->name}} </div>
                                        <div class="profile-usertitle-job"> <br><br> </div>
                                    </div>
                                    
                                   
                                </div>
                               
                            </div> -->
                            <!-- END BEGIN PROFILE SIDEBAR -->
                            <!-- BEGIN PROFILE CONTENT -->

                            <div class="profile-content">
       

                            
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light ">


                                  


                                            <div class="portlet-title tabbable-line">
                                               <!--  <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                </div> -->
                                              <!--   <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_2" data-toggle="tab">Change Profile Photo</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                                    </li>
                                                    
                                                </ul> -->
                                            </div>


                                             




                                  @if(isset($subscriptionStatus))
                                    @if(Auth::user()->subscription_status  !='ACTIVE')
                                     <div class="container subscription_notice_bar" > 
                                    
                                         <div class="card card-custom bg-gray-100 card-stretch gutter-b" style="background: #12876f !important">
                                              <div class="subscription_notice_bar_inner row">
                                                <div class="col-md-8" style="line-height: 38px;font-size: 18px;"> You have {{$subscriptionStatus['days']}} days left in your free trail! Upgrade for $20 a month!</div>
                                                <div class="col-md-4"><a href="javascript:;" style="    background: white;font-size: 18px;color: #3a876f;" data-toggle="modal" data-target="#upgradePlanPopup" class="btn btn-light-warning font-weight-bolder btn-sm"> Upgrade Now</a></div>
                                             </div>
                                          </div>
                                       </div>
                                    @endif
                                  @endif

                                  <div class="d-flex flex-column-fluid">
                            <!--begin::Container-->
                            <div class="container">
                                <!--begin::Dashboard-->
                                <!--begin::Row-->
                                <div class="card"> 
<!-- ////////////////////////////////////////////////////////////////////////////////////// -->

    <div class="card-body form">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
                                                    <div class="tab-pane active" id="tab_1_1">
                                                         
                                      <!--  <input type="hidden" name="userid" value="{{ Auth::user()->name }}"> -->


                        <div class="form-group">
                        <h3><span><b>Account Status</b></span></h3>
                        <label class="control-label">You currently are on our     @if(Auth::user()->subscription_status=='ACTIVE')<span style="font-weight: 600;"> Standard </span> @else <span style="font-weight: 600;">  No Active Plan </span>@endif    </label><br>
                        @if(Auth::user()->subscription_status=='ACTIVE')
                         <button style="color: #ff365bfc; background: #ffffff; border-color: #ff365bfc"   class="btn btn-default" data-toggle="modal" data-target="#cancelPlanPopup">Cancel Plan</button>
                         @endif 
                        </div>




<form  action="{{url('profile')}}" method="post">
                                       {{ csrf_field() }}

                        
                <div class="row">
                        <div class="col-md-6">
                            <h3><span><b>Profile</b></span></h3><br>
                                <div class="form-group">
                                <label class="control-label">First Name</label>
                                <input type="text" value="{{ $user->name }}" placeholder="John" class="form-control" name="name" /> </div>
                                    @error('name')
                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                   @enderror
 
                                <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <input type="text" value="{{ $user->last_name }}" placeholder="Carter" class="form-control" name="last_name" /> </div>
                           
                                <div class="form-group">
                                <label class="control-label">Phone Number</label>
                                <input type="text" name="phone" value="{{ $user->phone }}" placeholder="+1 646 580 DEMO (6284)" class="form-control" /> </div>
                                @error('phone')
                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                   @enderror

                                <br><br>


                                    <label class="control-label"><span><b>Hours of Operations</b></span></label><br><br>

                                       <div class="row">
                                         <div class="col-md-4"> 
                                                <div class="form-group">
                                                <label class="control-label" >Monday</label><br>
                                                <input type="hidden" name="monday" id="monday" value="{{$hour_operations->monday}}"     />
                                                <button type="button" onclick="$('#monday').val('open');$('.Monday').removeClass('active'); $(this).addClass('active'); $('#monday_times').show()" class="btn btn-custom-primary Monday @if($hour_operations->monday=='open') active @endif">Open</button>
                                                <button type="button" onclick="$('#monday').val('close');$('.Monday').removeClass('active'); $(this).addClass('active'); $('#monday_times').hide()" class="btn btn-custom-danger Monday @if($hour_operations->monday=='close') active @endif">Close</button>
                                                </div>
                                         </div>
                                         <div class="col-md-8">
                                            <div class="row" id="monday_times" style="display:@if($hour_operations->monday=='open') relative @else none  @endif">
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >From</label><br>
                                                   <input class="form-control" name="monday_from" value="{{$hour_operations->monday_from}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >To</label><br>
                                                   <input class="form-control"  name="monday_to" value="{{$hour_operations->monday_to}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                            </div>
                                         </div>
                                       </div>

                                        <div class="row">
                                         <div class="col-md-4"> 
                                            <div class="form-group">
                                            <label class="control-label">Tuesday</label><br>
                                            <input type="hidden" name="tuesday" id="tuesday" value="{{$hour_operations->tuesday}}" />
                                            <button type="button" onclick="$('#tuesday').val('open');$('.Tuesday').removeClass('active'); $(this).addClass('active'); $('#tuesday_times').show();" class="btn btn-custom-primary Tuesday @if($hour_operations->tuesday=='open') active @endif">Open</button>
                                            <button type="button" onclick="$('#tuesday').val('close');$('.Tuesday').removeClass('active'); $(this).addClass('active'); $('#tuesday_times').hide();" class="btn btn-custom-danger Tuesday @if($hour_operations->tuesday=='close') active @endif">Close</button>
                                            </div>
                                         </div>
                                         <div class="col-md-8">
                                            <div class="row" id="tuesday_times" style="display:@if($hour_operations->tuesday=='open') relative @else none  @endif">
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >From</label><br>
                                                   <input class="form-control" name="tuesday_from" value="{{$hour_operations->tuesday_from}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >To</label><br>
                                                   <input class="form-control"  name="tuesday_to" value="{{$hour_operations->tuesday_to}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                            </div>
                                         </div>
                                       </div>




                                     <div class="row">
                                         <div class="col-md-4">
                                            <div class="form-group">
                                            <label class="control-label">Wednesday</label><br>
                                            <input type="hidden" name="wednesday" id="wednesday"   value="{{$hour_operations->wednesday}}" >
                                            <button type="button" onclick="$('#wednesday').val('open');$('.Wednesday').removeClass('active'); $(this).addClass('active');$('#wednesday_times').show();" class="btn btn-custom-primary Wednesday @if($hour_operations->wednesday=='open') active @endif">Open</button>
                                            <button type="button" onclick="$('#wednesday').val('close');$('.Wednesday').removeClass('active'); $(this).addClass('active');$('#wednesday_times').hide();" class="btn btn-custom-danger Wednesday @if($hour_operations->wednesday=='close') active @endif">Close</button>
                                            </div>
                                       </div>
                                         <div class="col-md-8">
                                            <div class="row" id="wednesday_times" style="display:@if($hour_operations->wednesday=='open') relative @else none  @endif">
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >From</label><br>
                                                   <input class="form-control" name="wednesday_from" value="{{$hour_operations->wednesday_from}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >To</label><br>
                                                   <input class="form-control"  name="wednesday_to" value="{{$hour_operations->wednesday_to}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                            </div>
                                         </div>
                                       </div>



                                       <div class="row">
                                         <div class="col-md-4">
                                                <div class="form-group">
                                                <label class="control-label">Thursday</label><br>
                                                <input type="hidden" name="thursday" id="thursday"    value="{{$hour_operations->thursday}}"  />
                                                <button type="button" onclick="$('#thursday').val('open');$('.Thursday').removeClass('active'); $(this).addClass('active');$('#thursday_times').show();" class="btn btn-custom-primary Thursday @if($hour_operations->thursday=='open') active @endif">Open</button>
                                                <button type="button" onclick="$('#thursday').val('close');$('.Thursday').removeClass('active'); $(this).addClass('active');$('#thursday_times').hide();" class="btn btn-custom-danger Thursday @if($hour_operations->thursday=='close') active @endif">Close</button>
                                                </div>
                                        </div>
                                         <div class="col-md-8">
                                            <div class="row" id="thursday_times" style="display:@if($hour_operations->thursday=='open') relative @else none  @endif">
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >From</label><br>
                                                   <input class="form-control" name="thursday_from" value="{{$hour_operations->thursday_from}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >To</label><br>
                                                   <input class="form-control"  name="thursday_to" value="{{$hour_operations->thursday_to}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                            </div>
                                         </div>
                                       </div>

                                      <div class="row">
                                         <div class="col-md-4">

                                                <div class="form-group">
                                                <label class="control-label">Friday</label><br>
                                                <input type="hidden" name="friday" id="friday"   value="{{$hour_operations->friday}}" >
                                                <button type="button" onclick="$('#friday').val('open');$('.Friday').removeClass('active'); $(this).addClass('active');$('#friday_times').show();" class="btn btn-custom-primary Friday @if($hour_operations->friday=='open') active @endif">Open</button>
                                                <button type="button" onclick="$('#friday').val('close');$('.Friday').removeClass('active'); $(this).addClass('active');$('#friday_times').hide();" class="btn btn-custom-danger Friday @if($hour_operations->friday=='close') active @endif">Close</button>
                                                </div>
                                       </div>
                                         <div class="col-md-8">
                                            <div class="row" id="friday_times" style="display:@if($hour_operations->friday=='open') relative @else none  @endif">
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >From</label><br>
                                                   <input class="form-control" name="friday_from" value="{{$hour_operations->friday_from}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >To</label><br>
                                                   <input class="form-control"  name="friday_to" value="{{$hour_operations->friday_to}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                            </div>
                                         </div>
                                       </div>



                                      <div class="row">
                                         <div class="col-md-4">
                                            <div class="form-group">
                                            <label class="control-label">Saturday</label><br>
                                            <input type="hidden" name="saturday" id="saturday"  value="{{$hour_operations->saturday}}" />
                                            <button type="button" onclick="$('#saturday').val('open');$('.Saturday').removeClass('active'); $(this).addClass('active');$('#saturday_times').show();" class="btn btn-custom-primary Saturday @if($hour_operations->saturday=='open') active @endif">Open</button>
                                            <button type="button" onclick="$('#saturday').val('close');$('.Saturday').removeClass('active'); $(this).addClass('active');$('#saturday_times').hide();" class="btn btn-custom-danger Saturday @if($hour_operations->saturday=='close') active @endif">Close</button>
                                             </div>
                                        </div>
                                         <div class="col-md-8">
                                            <div class="row" id="saturday_times" style="display:@if($hour_operations->saturday=='open') relative @else none  @endif">
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >From</label><br>
                                                   <input class="form-control" name="saturday_from" value="{{$hour_operations->saturday_from}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >To</label><br>
                                                   <input class="form-control"  name="saturday_to" value="{{$hour_operations->saturday_to}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                            </div>
                                         </div>
                                       </div>




                                      <div class="row">
                                         <div class="col-md-4">
                                            <div class="form-group">
                                            <label class="control-label">Sunday</label><br>
                                            <input type="hidden" name="sunday" id="sunday"  value="{{$hour_operations->sunday}}" />
                                            <button type="button" onclick="$('#sunday').val('open'); $('.Sunday').removeClass('active'); $(this).addClass('active');$('#sunday_times').show();" class="btn btn-custom-primary Sunday @if($hour_operations->sunday=='open') active @endif">Open</button>
                                            <button type="button" onclick="$('#sunday').val('close'); $('.Sunday').removeClass('active'); $(this).addClass('active');$('#sunday_times').hide();" class="btn btn-custom-danger Sunday @if($hour_operations->sunday=='close') active @endif">Close</button>
                                            </div>
                                      </div>
                                         <div class="col-md-8">
                                            <div class="row" id="sunday_times" style="display:@if($hour_operations->sunday=='open') relative @else none  @endif">
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >From</label><br>
                                                   <input class="form-control" name="sunday_from" value="{{$hour_operations->sunday_from}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                                <div class="col-md-6"> 
                                                    <label class="control-label" >To</label><br>
                                                   <input class="form-control"  name="sunday_to" value="{{$hour_operations->sunday_to}}" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text" />
                                                </div>
                                            </div>
                                         </div>
                                       </div>

                         </div>
                         <div class="col-md-6">
                                        <h3><span><b>Company Information</b></span></h3><br>
                                        <div class="form-group">
                                    


  
 
 
   

                                        <div class="form-group">
                                        <label class="control-label">Company Name</label>
                                        <input type="text" name="company_name" value="{{ $company->name }}" placeholder="Company Name" class="form-control" /> 
                                    	</div>
                                    	@error('company_name')
                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <input type="text" name="company_phone" value="{{ $company->phone }}" placeholder="Phone" class="form-control" /> </div>
                					    @error('company_phone')
                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                					   
                                        <div class="form-group">
                                        <label>Country</label>
                                        <div class="input-group">
                                             
                                            <input type="text" name="country" value="{{ $company->country }}" placeholder="Country" class="form-control" /> 
                                        @error('country')
                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        </div>


 




                				
                						<div class="form-group">
                                        <label class="control-label">State</label>
                                        <input type="text" name="state" value="{{ $company->state }}" placeholder="State" class="form-control" /> 
                                        @error('state')
                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>

                                        <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input type="text" name="city" value="{{ $company->city }}" placeholder="City" class="form-control" /> 
                                        @error('city')
                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                       </div>
                                        


 

                                        <div class="form-group">
                                        <label class="control-label">Zip</label>
                                        <input type="text" name="zip" value="{{ $company->zip }}" placeholder="Zip" class="form-control" />
                                         @error('zip')
                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                         </div>
                                        

                                        <div class="form-group">
                                        <label class="control-label">Address</label>
                                        <textarea class="form-control" name="address" placeholder="Address" >{{$company->address}}</textarea>
                                        @error('address')
                                            <span class="invalid-feedback" style="color:red" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                        <br/>
                                        <textarea class="form-control" name="address1" placeholder="Address 1" >{{$company->address1}}</textarea> 
                                    	</div>
                                    
                                        </div>



                                        <div class="form-group">
               

                                 		</div>


                                 		<div class="margin-top-10">
                                         <button style="min-width: 250px;" type="submit"  class="btn btn-primary">Save change</button> 
                                     	</div>
                              </div>
                            </div>  
                                                                 
                        </form>
                    </div>
                    <!-- END PERSONAL INFO TAB -->
                    <!-- CHANGE AVATAR TAB -->
                    <div class="tab-pane" id="tab_1_2">
                         
                    <form  action="{{url('profile/photo')}}" method="post" enctype="multipart/form-data">
       				{{ csrf_field() }}
                            <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" >
                                        @if(isset($user->profile_pic) && !empty($user->profile_pic))
                                        <img src="{{ asset('images/' . $user->profile_pic) }}" alt="" id="image" width="150px" height="150px" />
                                        @else
                                        <img src="https://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="image" width="150px" height="150px" />
                                        @endif

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" > </div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> Select image </span>
                                            <span class="fileinput-exists"> Change </span>
                             <input type="file" id="fileupload" name="profile_pic"> </span>
                                       <!--  <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a> -->
                                        
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <span class="label label-danger" style="width: 44px;">NOTE! </span>
                                    <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                </div>
                            </div>
                            <div class="margin-top-10">
                               
                                 <button style="min-width: 250px;    margin-top: 23px; margin-left: 15px;" type="submit"  class="btn btn-primary">Submit</button>
                               
                             </div>
                    </form>
                    </div>
                    <!-- END CHANGE AVATAR TAB -->
                    <!-- CHANGE PASSWORD TAB -->
                    <div class="tab-pane" id="tab_1_3">
                        <form  action="{{url('profile/changepass')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label">Current Password</label>
                                <input type="password" class="form-control" name="current_password" /> </div>
                            <div class="form-group">
                                <label class="control-label">New Password</label>
                                <input type="password" name="new_password" class="form-control" /> </div>
                            <div class="form-group">
                                <label class="control-label">Re-type New Password</label>
                                <input type="password" name="retype_password" class="form-control" /> </div>
                            <div class="margin-top-10">
                               
                                <button style="min-width: 250px;    margin-top: 23px; margin-left: 15px;" type="submit"  class="btn btn-primary">Change Password</button>
                             </div>
                        </form>
                    </div>
                    <!-- END CHANGE PASSWORD TAB -->
                    
                			</div>
            			</div>
        			</div>
                	</div>
            	</div>
        		</div>
        				<!-- END PROFILE CONTENT -->
    					</div>
					</div>
                </div>
            </div>
        </div>
    </div>



    <div id="cancelPlanPopup" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title">Are you sure?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>If you cancel your plan, you will no longer be able to use any of our premium features like unlimited invoices and estimations, emailing your invoices and more.</p>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NEVERMIND</button>
        <form action="{{url('cancel-subcription')}}" method="post">
           {{ csrf_field() }}
           <button type="submit" class="btn btn-primary">CANCEL ACCOUNT</button>
        </form>
      </div>
    </div>
  </div>
</div>

                    @endsection
@section('css')
 <style type="text/css">
     button.btn.btn-custom-primary {
    border: 1px solid blue;
}
button.btn.btn-custom-danger {
    border: 1px solid red;
}

button.btn.btn-custom-primary.active {
    background: #3798f7;
    color: white;
}

button.btn.btn-custom-danger.active {
    background: red;
    color: white;
}
.subscription_notice_bar_inner {
    width: 100%;
    padding: 16px;
    border-radius: 5px;
    color: white;
    font-weight: 800;
}

 </style>
@endsection


@section('script')

<!-- BEGIN PAGE LEVEL PLUGINS -->
  
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
 
<script type="text/javascript">
    // Class definition

var KTBootstrapTimepicker = function () {
    
    // Private functions
    var demos = function () {
        // minimum setup
        $('#kt_timepicker_1, #kt_timepicker_1_modal').timepicker();

        // minimum setup
        $('#kt_timepicker_2, #kt_timepicker_2_modal').timepicker({
            minuteStep: 1,
            defaultTime: '',
            showSeconds: true,
            showMeridian: false,
            snapToStep: true
        });

        // default time
        $('#kt_timepicker_3, #kt_timepicker_3_modal').timepicker({
            defaultTime: '11:45:20 AM',
            minuteStep: 1,
            showSeconds: true,
            showMeridian: true
        });

        // default time
        $('#kt_timepicker_4, #kt_timepicker_4_modal').timepicker({
            defaultTime: '10:30:20 AM',           
            minuteStep: 1,
            showSeconds: true,
            showMeridian: true
        });

        // validation state demos
        // minimum setup
        $('#kt_timepicker_1_validate, #kt_timepicker_2_validate, #kt_timepicker_3_validate').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            snapToStep: true
        });
    }

    return {
        // public functions
        init: function() {
            demos(); 
        }
    };
}();

jQuery(document).ready(function() {
    KTBootstrapTimepicker.init();
});
</script>

@endsection