<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Industry;
use App\Item;
use App\Category;
use App\Item_category;
use App\Unit;
use App\Customer;
use App\Expense;
use App\ExpenseCategory;
use App\Invoice;
use App\InvoiceItem;
use App\Estimate;
use App\EstimateItem;
use App\Company;
use App\Payment;
use App\Tax;
use Mail;
use App\InvoiceImage;
use App\Customer_note;
use App\PaymentMethod;
use App\Task;
use App\Invoice_tax;
use App\Estimate_tax;
use App\Vehicle;
use \DrewM\MailChimp\MailChimp;

use Stripe\Stripe;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth ;
use Illuminate\Support\Facades\Hash;
use PDF;





class StripeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
          Stripe::setApiKey(env('STRIPE_KEY'));
         //$this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 
     public function connectAccountResponse(Request $request){
        $data= $request->input();
        $User=User::where('auth_token',isset($data['state'])?$data['state']:'')->first();
        if(!isset($data['state']) || $data['state'] !=$User->auth_token ){
            return redirect('/')->with('error','Not an authorized user!'); 
        }
        try {
            $stripeResponse = \Stripe\OAuth::token([
              'grant_type' => 'authorization_code',
              'code' => $_REQUEST['code'],
            ]);
          } catch (\Stripe\Error\OAuth\InvalidGrant $e) {
               $body = $e->getJsonBody(); $err  = $body['error'];
               return redirect('/')->with('error',$err); 
          }
           catch (\Stripe\Exception\OAuth\InvalidGrantException $e) {
               $body = $e->getJsonBody(); $err  = $body['error'];
               return redirect('/')->with('error',$err);   
           }
           catch (Exception $e) {
              $body = $e->getJsonBody(); $err  = $body['error'];
              return redirect('/')->with('error',$err); 
           }
           User::where('auth_token',$data['state'])->update(['stripe_user_id'=>$stripeResponse->stripe_user_id]);;

          return redirect('/')->with('success','Stripe Account Successfully Added!'); 
     }

    public function recentAccounts(Request $request){
      $accounts = \Stripe\Account::all(['limit' => 10]);
      return response()->json(['accounts'=>($accounts)]);
    }

    public function createPaymentIntent(Request $request){
       $data= $request->input();
       //print_r($data);


   $amount = 1400;//calculateOrderAmount($data['items']);

  $paymentIntent = \Stripe\PaymentIntent::create([
    'amount' => $amount,
    'currency' => $data['currency'],
    'description'=>'services',
    'shipping'=>[    'name' =>"Jenny Rosen",
                     'address'=> [
                                 'line1'=>"510 Townsend St",
                                 'postal_code'=>'98140' ,
                                 'city'=>"San Francisco",
                                 'state'=>'CA',
                                 'country'=>'US',
                               ]
             ],




  //  'application_fee_amount' => $this->calculateApplicationFeeAmount($amount),
  ], ['stripe_account' => $data['account']]);
  
  return response()->json(array(
    'publishableKey' => env('STRIPE_PUBLISHABLE_KEY'),
    'clientSecret' => $paymentIntent->client_secret,
  ));





    }

public function calculateApplicationFeeAmount($amount) {
  return 0.1 * $amount;
}
 public function collectStripe(Request $request){
       $data= $request->input();
        return view('stripe.collect') ;
    }
}
