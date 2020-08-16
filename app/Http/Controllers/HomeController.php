<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth ;
use App\User;
use App\Industry;
use App\Item;
use App\Company;
use App\Task;
use App\EmailNotification;
use Mail;

use Illuminate\Support\Facades\Hash;
use App\PaymentMethod;
use \DrewM\MailChimp\MailChimp;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        // super_admin, shop_admin, customer, employee 
        if(Auth::user()->role=='super_admin'){
           return $this->superAdminDashboard();
        }
        
        if(Auth::user()->role=='shop_admin'){

            $EmailNotification= EmailNotification::where('user_id',Auth::user()->id)->first();
            if(!isset($EmailNotification->id)){ $EmailNotification=EmailNotification::create(['user_id'=>Auth::user()->id ]); }
              if(!$EmailNotification->welcome_email){
                             //Send Email Start
                                   $user=User::where('id',Auth::user()->id)->first();
                                   Mail::send('emails.welcome', ['user' => $user], function ($m) use ($user) {
                                            $m->to($user->email, $user->name)->subject('Welcome at GoBizGrow');
                                   });

                                   Mail::send('emails.free-trial', ['user' => $user], function ($m) use ($user) {
                                            $m->to($user->email, $user->name)->subject('Congratulations! Your Free Trial Starts');
                                   });

                                   EmailNotification::where('user_id',Auth::user()->id)->update(['welcome_email'=>'1']);
                              //Send Email End
              }
           $this->checkCompany();
           return $this->shopAdminDashboard();
        }
        
        if(Auth::user()->role=='customer'){
           return $this->employeesDashboard();
        }

        if(Auth::user()->role=='employee'){
           return $this->customerDashboard();
        }
    }


    public function superAdminDashboard(){
        $page_name="Dashboard";
        return view('home',compact('page_name'));

    }

    public function shopAdminDashboard(){
        $subscriptionStatus=$this->shopAdminSubcriptionStatusCheck();
 

        $tasks= Task::where('company_id', Auth::user()->company_id)->get();
        $page_name="Dashboard";
        return view('home',compact('page_name','subscriptionStatus','tasks'));
        
    }

    public function employeesDashboard(){
        $page_name="Dashboard";
        return view('home',compact('page_name'));
        
    }

    public function customerDashboard(){
       $subscriptionStatus= $this->shopAdminSubcriptionStatusCheck();
        $page_name="Dashboard";
        return view('home',compact('page_name','subscriptionStatus'));
    }










    public function checkCompany(){
        if(!isset(Auth::user()->company_id) || (Auth::user()->company_id=='')){

//mailChimp Start
   
             

            if(Auth::user()->industry==6){
             // Auto Detailer
             $this->addInMailChimp(env('MAILCHIMP_LIST_AUTO_DETAILER_ID'), Auth::user()->email, Auth::user()->name,Auth::user()->last_name, Auth::user()->phone,['Auto Detailer','free trial']);

              $this->addInMailChimp(env('MAILCHIMP_LIST_SIGNUPS_ID'), Auth::user()->email, Auth::user()->name,Auth::user()->last_name, Auth::user()->phone,['Auto Detailer','free trial']);
             $this->addInMailChimp(env('MAILCHIMP_LIST_GOBIZGROW_ID'), Auth::user()->email, Auth::user()->name,Auth::user()->last_name, Auth::user()->phone,['Auto Detailer','free trial']);

            }


            if(Auth::user()->industry==8){
             // Automotive Repair
             $this->addInMailChimp(env('MAILCHIMP_LIST_AUTO_TECHNICIAN_ID'), Auth::user()->email, Auth::user()->name,Auth::user()->last_name, Auth::user()->phone,['Auto Tech','free trial']);
             $this->addInMailChimp(env('MAILCHIMP_LIST_SIGNUPS_ID'), Auth::user()->email, Auth::user()->name,Auth::user()->last_name, Auth::user()->phone,['Auto Tech','free trial']);
             $this->addInMailChimp(env('MAILCHIMP_LIST_GOBIZGROW_ID'), Auth::user()->email, Auth::user()->name,Auth::user()->last_name, Auth::user()->phone,['Auto Tech','free trial']);

            }

//mailChimp End

 


            $Company=  Company::create(['name'=>Auth::user()->name, 'auth_token'=>Hash::make(Auth::user()->name) ]);
             User::where('id',Auth::user()->id)->update(['company_id'=>$Company->id]);
             PaymentMethod::create([
                'name' => 'Online',
                'auth_token'=> $this->createUniqueId(),
                'company_id' => $Company->id,
             ]);
             PaymentMethod::create([
                'name' => 'Offline',
                'auth_token'=> $this->createUniqueId(),
                'company_id' => $Company->id,
             ]);
        }
 
        if(Auth::user()->auth_token=='' || Auth::user()->auth_token==NUll){
          User::where('id',Auth::user()->id)-> update([ 'auth_token' => $this->createUniqueId() ]);
        }
        if(Auth::user()->stripe_customer_id !='' &&  Auth::user()->stripe_subscription_id !='' && Auth::user()->subscription_status=='ACTIVE'){
             $this->checkSubscriptionStatus();
        }
    }


function checkSubscriptionStatus(){
                   \Stripe\Stripe::setApiKey('sk_test_3XRQ95xkBL4tKqn81hZkkm0e');
                  $customer = \Stripe\Customer::retrieve(Auth::user()->stripe_customer_id);
                  $subscription = $customer->subscriptions->retrieve(Auth::user()->stripe_subscription_id);

 
                   if($subscription->status !='active'){
                                 User::where('id',Auth::user()->id)->update(['subscription_status'=>'NOT_ACTIVE']);

                   }else{                    
                                User::where('id',Auth::user()->id)->update(['subscription_status'=>'ACTIVE']);
                                //////////////////////////////////////////////////////
                                                 $MailChimp = new MailChimp(env('MAILCHIMP_KEY'));
                                                 $subscriber_hash = MailChimp::subscriberHash(Auth::user()->email);
                                                  if(Auth::user()->industry==6){
                                                  // Auto Detailer
                                                    $list_id=env('MAILCHIMP_LIST_AUTO_DETAILER_ID');
                                                        $result=$MailChimp->post("lists/$list_id/members/$subscriber_hash/tags", [
                                                             'tags' => [ ['name'=>'cancelled','status' => 'inactive'],['name'=>'Upgraded','status' => 'active'],['name'=>'free trial','status' => 'inactive'] ]
                                                        ]);
                                                  }
                                                  if(Auth::user()->industry==8){
                                                  // Automotive Repair
                                                      $list_id=env('MAILCHIMP_LIST_AUTO_TECHNICIAN_ID');
                                                      $result=$MailChimp->post("lists/$list_id/members/$subscriber_hash/tags", [
                                                          'tags' => [ ['name'=>'cancelled','status' => 'inactive'],['name'=>'Upgraded','status' => 'active'],['name'=>'free trial','status' => 'inactive'] ]
                                                      ]);
                                                  }

                            ///////////////////////////////////////////////////////

                   }
              
}









public function shopAdminSubcriptionStatusCheck(){
     $createdAt=Auth::user()->created_at;
      $subscription_status=Auth::user()->subscription_status;
      $todayDate=date('Y-m-d');
      $createdAt=date('Y-m-d', strtotime($createdAt));

      $days = abs(strtotime($todayDate) - strtotime($createdAt))/60/60/24;  
      $status=true;
      $remainingDays= 7-$days ;
      if($subscription_status !='ACTIVE' && $days>7){
      $status=false;
      $remainingDays=0;
      }


  return ['status'=>$status, 'days'=>$remainingDays];
}
  


public function addInMailChimp($list_id,$email,$fname,$lname,$phone,$tag=['GoBizGrow']){


  

  $MailChimp = new MailChimp(env('MAILCHIMP_KEY'));
  $result = $MailChimp->post("lists/$list_id/members", [
          'email_address' => $email,
          'status'        => 'subscribed',
          'tags'  => $tag,
          'merge_fields'=>[
             'FNAME'   =>$fname,
              'PHONE'   =>$phone,
          ]
        ]);
}



 public  function createUniqueId( $delimiter = '-'){
    $str= Hash::make(uniqid(time(), true));
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug.uniqid(time(), true);
   } 



}
