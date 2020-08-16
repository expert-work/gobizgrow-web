<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use App\Industry;
use App\Http\Requests;
use App\Company;
use App\HourOperation;
use App\Http\Controllers\Controller;
 
class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index(Request $request){
         $page_name="Profile";
           $id =  Auth::user()->id;
          $data=$request->input();
          $user = User::where('id', $id)->first();
          $company = Company::where('id', $user->company_id)->first();
          $hour_operations = HourOperation::where('company_id', $user->company_id)->first();
         
          if(!isset($hour_operations->id)){  $hour_operations=HourOperation::create([ 'company_id'=>$user->company_id ]); }



 
           
          if(count($data)){
            $this->validate($request, [
            'name' => 'required',
             'phone' => 'required|min:10',
            'company_name' => 'required',
            'company_phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'address' => 'required',
            ]);


            $data['name']=isset($data['name'])?$data['name']:'';
            $data['last_name']=isset($data['last_name'])?$data['last_name']:'';
            $data['phone']=isset($data['phone'])?$data['phone']:'';

              User::where('id',$id)
              ->update([
                'name' => $data['name'],
                'last_name' => $data['last_name'],
                'phone' => $data['phone'],
                
              ]); 


            $data['company_name']= isset($data['company_name'])?$data['company_name']:'';
            $data['company_phone']= isset($data['company_phone'])?$data['company_phone']:'';
            $data['country']= isset($data['country'])?$data['country']:'';
            $data['state']= isset($data['state'])?$data['state']:'';
            $data['city']= isset($data['city'])?$data['city']:'';
            $data['zip']= isset($data['zip'])?$data['zip']:'';
            $data['address']= isset($data['address'])?$data['address']:'';
            $data['address1']= isset($data['address1'])?$data['address1']:'';



              Company::where('id',$user->company_id)->update([
                'name' => $data['company_name'], 
                'phone' => $data['company_phone'],
                'country' => $data['country'], 
                'state' => $data['state'],
                'city' => $data['city'], 
                'zip' => $data['zip'],
                'address' => $data['address'], 
                'address1' => $data['address1'],
              ]);

 

              HourOperation::where('company_id',$user->company_id)->update([
                  'monday' => $data['monday'], 
                  'tuesday' => $data['tuesday'],
                  'wednesday' => $data['wednesday'], 
                  'thursday' => $data['thursday'],
                  'friday' => $data['friday'], 
                  'saturday' => $data['saturday'],
                  'sunday' => $data['sunday'], 
                  'monday_from'=>$data['monday_from'],
                  'monday_to'=>$data['monday_to'], 
                  'tuesday_from'=>$data['tuesday_from'],
                  'tuesday_to'=>$data['tuesday_to'],
                  'wednesday_from'=>$data['wednesday_from'],
                  'wednesday_to'=>$data['wednesday_to'], 
                  'thursday_from'=>$data['thursday_from'], 
                  'thursday_to'=>$data['thursday_to'], 
                  'friday_from'=>$data['friday_from'], 
                  'friday_to'=>$data['friday_to'],
                  'saturday_from'=>$data['saturday_from'],
                  'saturday_to'=>$data['saturday_to'],
                  'sunday_from'=>$data['sunday_from'],
                  'sunday_to'=>$data['sunday_to']
               ]);
            return back()->with('success','Profile successfully Updated!');
          }

           $subscriptionStatus=$this->shopAdminSubcriptionStatusCheck();
          return view('super-admin.profile', compact('page_name','user','company','hour_operations','subscriptionStatus'));
     }

     public function uploadImage(Request $request){
         $data=$request->input();
          // print_r($data); die;
         $id =  Auth::user()->id;
          $user = User::where('id', $id)->first();
         if(count($data)){
            $this->validate($request, [
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
              ]);
              if ($request->has('profile_pic')) {
                $image = $request->file('profile_pic');

               $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

              $destinationPath = public_path('/images');

              $image->move($destinationPath, $input['imagename']);


    
               //  $image = $request->file('profile_pic');
               //  print_r($image); die;
               // $folder = '/uploads/images/';
               //  $filePath = $folder . '.' . $image->getClientOriginalExtension();

            User::where('id',$id)
                  ->update([
                    'profile_pic' => $input['imagename'],
                    
                    
                  ]); 

            return back()->with('success','Profile Pic successfully Updated!');
        }
          }

        // return view('super-admin.shop-admin-new', compact('page_name','industries'));
         return view('super-admin.profile', compact('page_name','user'));


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


     public function changePassword(Request $request){
      $id =  Auth::user()->id;
        
          $user = User::where('id', $id)->first();
           $data=$request->input();
         
         if(count($data)){
            $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|max:8',
            'retype_password' => 'required|max:8',

              ]);
if (Hash::check($request->current_password, $user->password)) {
            User::where('id',$id)
                  ->update([
                   
                    'password' => Hash::make($data['new_password']),
                     
                  ]); 
            return back()->with('success','Password successfully Updated!');
          }else{
            return back()->with('error', 'Password does not match');
          }
        }
          $hour_operations = HourOperation::where('company_id', $user->company_id)->first();

        // return view('super-admin.shop-admin-new', compact('page_name','industries'));
         return view('super-admin.profile', compact('page_name','user'));
     }

}
