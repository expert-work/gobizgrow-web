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

use App\Obd2;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth ;
use Illuminate\Support\Facades\Hash;
use PDF;





class Obd2Controller extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

 public function obd2Brand(){
  $Obd2s= Obd2::select('obd2s.brand')->groupBy('brand');
   if(isset($_REQUEST['q']) && $_REQUEST['q'] !=''){
      $Obd2s= $Obd2s->where('brand','like','%'.$_REQUEST['q'].'%' );
   }
   $Obd2s= $Obd2s->paginate(10);
    $page_name='Obd2';
    return view('obd2.obd2-brand', compact('page_name','Obd2s'));

 }


 public function obd2Codes(){
   $page_name='Obd2';
     $Obd2s= Obd2::where('code','!=','');


      if(isset($_REQUEST['q']) && $_REQUEST['q'] !=''){
          $Obd2s= $Obd2s->where('code','like','%'.$_REQUEST['q'].'%' );
       }
      if(isset($_REQUEST['brand']) && $_REQUEST['brand'] !=''){
          $Obd2s= $Obd2s->where('brand',$_REQUEST['brand'] );
       }

       $Obd2s= $Obd2s->paginate(10);
   return view('obd2.obd2-code', compact('page_name','Obd2s'));
 }


 public function obd2ById(){
   $Obd2=Obd2::where('id',$_REQUEST['id'])->first();
    return response()->json([
                    'message' => 'Obd2 Code Detail',
                    'data' =>$Obd2,
                    'isError' => true,
                    'responseCode'=>200
                ], 200);
    }
 

}
