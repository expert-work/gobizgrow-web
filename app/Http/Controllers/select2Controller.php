<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Industry;
use App\Customer;
use App\Item;
use App\Invoice;
use App\ExpenseCategory;
use App\Category;
use App\Unit;
use App\Tax;


use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Auth;
class select2Controller extends Controller{
	use SendsPasswordResetEmails;

	/**
	 * Create a new controller instance.
	 */
	public function __construct(){
		//$this->middleware('guest');
	}


	public function getCustomers(Request $request){
        $data=$request->input();
        
        $q= isset($data['q'])?$data['q']:'';
        $query=Customer::where('company_id',$data['company_id'])->select('id as id', 'name as text');
        if($q !=''){ 
         $query=$query->where('name', 'like', '%'.$q.'%');
        }
        $d=$query->get();
        return response()->json(['results'=>$d]);
       // print_r($d);
	}
 
 	public function getItems(Request $request){
        $data=$request->input();
        
        $q= isset($data['q'])?$data['q']:'';
        $query=Item::where('company_id',$data['company_id'])->select('items.*','id as id', 'name as text');
        if($q !=''){ 
         $query=$query->where('name', 'like', '%'.$q.'%');
        }
        $d=$query->get();
         return response()->json(['results'=>$d]);
       // print_r($d);
	} 
   
   public function getInvoicesByCustomerId(Request $request){
     $data=$request->input();
     $company_id= isset($data['company_id'])?$data['company_id']:'';
     $customer_id= isset($data['customer_id'])?$data['customer_id']:'';


     $invoices=Invoice::where('customer_id', $customer_id)->where('due_amount','>','0')->where('company_id', $company_id)->select('invoices.*', 'invoices.invoice_number as text','invoices.invoice_number as label','invoices.id as value',)->get();
              return response()->json(['results'=>$invoices]);

             
   }


 public function expensesCategoriesAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

    $expensesCategories=ExpenseCategory::where('company_id',$company_id)->orderBy('id','DESC')->select('name as label','id as value','expense_categories.*')->get();

     return response()->json([
                'message' => 'All expenses category List',
                'data' => $expensesCategories,
                'isError' => false,
                'responseCode'=>200
            ], 200);
}

 public function getCategoriesAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

    $categories=Category::where('company_id',$company_id)->orderBy('id','DESC')->select('name as label','id as value','categories.*')->get();

     return response()->json([
                'message' => 'All  category List',
                'data' => $categories,
                'isError' => false,
                'responseCode'=>200
            ], 200);
}



 public function getTaxesAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

    $taxes=Tax::where('company_id',$company_id)->orderBy('id','DESC')->select('name as label','id as value','taxes.*')->get();

     return response()->json([
                'message' => 'All  category List',
                'data' => $taxes,
                'isError' => false,
                'responseCode'=>200
            ], 200);
}


 public function getUnitsAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

    $units=Unit::where('company_id',$company_id)->orderBy('id','DESC')->select('name as label','id as value','units.*')->get();

     return response()->json([
                'message' => 'All units List',
                'data' => $units,
                'isError' => false,
                'responseCode'=>200
            ], 200);
}

 public function getCustomersAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

    $Customers=Customer::where('company_id',$company_id)->orderBy('id','DESC')->select('name as label','id as value','customers.*')->get();

     return response()->json([
                'message' => 'All Customers List',
                'data' => $Customers,
                'isError' => false,
                'responseCode'=>200
            ], 200);
}


 
}
