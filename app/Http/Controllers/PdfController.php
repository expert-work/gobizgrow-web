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

use App\Invoice_tax;
use App\Estimate_tax;
use App\EmailNotification;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth ;
use Illuminate\Support\Facades\Hash;
use PDF;
use Mail;
use PDO;

// We Used DOM PDF to geerate pdf


class PdfController extends Controller{


   public function __construct()
    {
       // $this->middleware('auth');
        
    }

	public function export_pdf()
	  {

	    // Fetch all customers from database
	    $data = Customer::get();
	    // Send data to the view using loadView function of PDF facade
	    $pdf = PDF::loadView('pdf.customers', compact('data'));
	    // If you want to store the generated pdf to the server then you can use the store function
 	      $pdf->save(public_path().'/_filename.pdf');
	    // Finally, you can download the file using download function
	     // return   $pdf->save(public_path().'/_filename123.pdf')->stream();
 
	    return $pdf->download('customers.pdf');
	  }

public function invoicePdf($auth_token)
	  {
	    $Invoice=Invoice::where('auth_token',$auth_token)->first();
        $InvoiceItem=InvoiceItem::where('invoice_id',$Invoice->id)->get();
        $Invoice_tax=Invoice_tax::where('invoice_id',$Invoice->id)->get();
  	    $Customer=Customer::where('id',$Invoice->customer_id)->first();
  	    $Company=Company::where('id',$Invoice->company_id)->first();   
	    $pdf = PDF::loadView('pdf.invoice', compact('Invoice', 'InvoiceItem', 'Customer', 'Company','Invoice_tax'));
	    $file=public_path().'/pdf/_filename.pdf';
  	    $pdf->save($file);
	    return   $pdf->save(public_path().'/_filename123.pdf')->stream();
 	  }

	  public function invoicesSend(Request $request, $auth_token){
	  		    $Invoice=Invoice::where('auth_token',$auth_token)->first();
		        $InvoiceItem=InvoiceItem::where('invoice_id',$Invoice->id)->get();
		        $Invoice_tax=Invoice_tax::where('invoice_id',$Invoice->id)->get();

		  	    $Customer=Customer::where('id',$Invoice->customer_id)->first();
		  	    $Company=Company::where('id',$Invoice->company_id)->first();   
			    $pdf = PDF::loadView('pdf.invoice', compact('Invoice', 'InvoiceItem', 'Customer', 'Company','Invoice_tax'));
			    $file=public_path().'/pdf/_filename.pdf';
		  	    $pdf->save($file);
               
 
	         $invoice=Invoice::where('auth_token',$auth_token)->first();
	         $user=User::where('id',Auth::user()->id)->first();

	         
	         $invoiceData= [
            'status'=> 'SENT',
             ];

              Invoice::where('auth_token',$auth_token)->update($invoiceData);


	            Mail::send('emails.invoice', ['invoice' => $invoice,'user'=>$user,'customer'=>$Customer,'company'=>$Company], function ($m) use ($Customer, $file) {

	            $m->to($Customer->email, $Customer->name)->subject('Invoice Your Reminder!');

				$m->attach($file, [
				                    'as' => 'invoice.pdf',
				                    'mime' => 'application/pdf',
				                ]);
	            });

            $EmailNotification= EmailNotification::where('user_id',Auth::user()->id)->first();
            if(!$EmailNotification->first_invoice_email	){
                 
                Mail::send('emails.firstInvoice_alert_email', ['user' => $user], function ($m) use ($user) {
	                 $m->to($user->email, $user->name)->subject('Congratulations!');
	            });



                EmailNotification::where('user_id',Auth::user()->id)->update(['first_invoice_email'=>1]);
            }
            return redirect('invoices/dues')->with('success','Invoice successfully sent!');
	  }

	  // public function estimate_pdf()
	  // {

	  //   // Fetch all customers from database
	  //  // $data = Invoice::get();
	  //   $data=Estimate::where('estimates.company_id',Auth::user()->company_id)
	  //   ->leftJoin('companies', 'companies.id', '=', 'estimates.company_id')
	  //    ->leftJoin('estimate_items', 'estimate_items.estimate_id', '=', 'estimates.id')
	  //    ->select('companies.*','companies.name as companyname','estimates.company_id','estimates.*','estimate_items.*','estimate_items.name as itemname')
	  //   ->first();
	  //   //print_r($data);
	  //   // Send data to the view using loadView function of PDF facade
	  //   $pdf = PDF::loadView('pdf.estimate', compact('data'));
	  //   // If you want to store the generated pdf to the server then you can use the store function
 	 //      $pdf->save(public_path().'/_filename.pdf');
	  //   // Finally, you can download the file using download function
	  //     return   $pdf->save(public_path().'/_filename123.pdf')->stream();
 
	   
	  // }
	  public function estimatePdf($auth_token)
	  {
	    $Estimate=Estimate::where('auth_token',$auth_token)->first();
        $EstimateItem=EstimateItem::where('estimate_id',$Estimate->id)->get();
        $Estimate_tax=Estimate_tax::where('estimate_id',$Estimate->id)->get();
  	    $Customer=Customer::where('id',$Estimate->customer_id)->first();
  	    $Company=Company::where('id',$Estimate->company_id)->first();   
	    $pdf = PDF::loadView('pdf.estimate', compact('Estimate', 'EstimateItem', 'Customer', 'Company','Estimate_tax'));
	    $file=public_path().'/pdf/_filename.pdf';
  	    $pdf->save($file);
	    return   $pdf->save(public_path().'/_filename123.pdf')->stream();
 	  }

 	  public function estimatesSend(Request $request, $auth_token){
	  		    $Estimate=Estimate::where('auth_token',$auth_token)->first();
		        $EstimateItem=EstimateItem::where('estimate_id',$Estimate->id)->get();
		        $Estimate_tax=Estimate_tax::where('estimate_id',$Estimate->id)->get();
                Estimate::where('auth_token',$auth_token)->update(['status'=>'SENT']);
		  	    $Customer=Customer::where('id',$Estimate->customer_id)->first();
		  	    $Company=Company::where('id',$Estimate->company_id)->first();   
			    $pdf = PDF::loadView('pdf.estimate', compact('Estimate', 'EstimateItem', 'Customer', 'Company','Estimate_tax'));
			    $file=public_path().'/pdf/_filename.pdf';
		  	    $pdf->save($file);

 
	         $estimate=Estimate::where('auth_token',$auth_token)->first();
	         $user=User::where('id',Auth::user()->id)->first();
	           Mail::send('emails.estimate', ['estimate' => $estimate,'user'=>$user,'customer'=>$Customer,'company'=>$Company], function ($m) use ($Customer, $file) {
	            //$m->from('hello@app.com', 'Your Application');

	            $m->to($Customer->email, $Customer->name)->subject('Your Estimate Reminder!');

				$m->attach($file, [
				                    'as' => 'estimate.pdf',
				                    'mime' => 'application/pdf',
				                ]);
	        });
            return redirect('estimates/sent')->with('success','Estimate successfully sent!');

 	  }






public function paymentPdf($auth_token){
    	$Payment=Payment::where('auth_token',$auth_token)->first();
   	    $Customer=Customer::where('id',$Payment->customer_id)->first();
  	    $Company=Company::where('id',$Payment->company_id)->first();   
	    $pdf = PDF::loadView('pdf.payments', compact('Payment', 'Customer', 'Company'));
	    $file=public_path().'/pdf/_filename.pdf';
  	    $pdf->save($file);
	    return   $pdf->save(public_path().'/_filename123.pdf')->stream();
}





public function reportTaxes(Request $request){
    $data= $request->input();
	$range= explode(' / ', $data['range']);
	$from= $this->mmDDDyyyy_to_yyyymmDD($range[0]);   
    $to = $this->mmDDDyyyy_to_yyyymmDD($range[1]);  

    $Company=Company::where('id',$data['company_id'])->first();   
    $Invoices=Invoice::whereBetween('due_date', [$from, $to])->where('company_id', $data['company_id'])->where('status','COMPLETED')->get();
     
     $invoice_ids=[];
     foreach ($Invoices as $key => $value) {
         $invoice_ids[]= $value->id;

     }
      $Invoice_taxs=    Invoice_tax::whereIn('invoice_id', $invoice_ids)->get();
     $taxes=[];
     $total=0;
     foreach ($Invoice_taxs as $key => $value) {
     	$total=$total+$value->tax_amount;
     	$taxes[$value->tax_id]=[
                               'name'=>$value->name,
                               'tax_amount'=>(isset($taxes[$value->tax_id]['tax_amount'])?$taxes[$value->tax_id]['tax_amount']:0)+$value->tax_amount
     	                      ];
      }

     $range=$data['range'];

    $pdf = PDF::loadView('pdf.taxes', compact('taxes', 'total', 'Company','range'));
    $file=public_path().'/pdf/_filename.pdf';
	    $pdf->save($file);
    return   $pdf->save(public_path().'/_filename123.pdf')->stream();

}

public function reportExpensess(Request $request){
	$data= $request->input();
	$range= explode(' / ', $data['range']);
		$from= $this->mmDDDyyyy_to_yyyymmDD($range[0]);   
    $to = $this->mmDDDyyyy_to_yyyymmDD($range[1]);  
    $Company=Company::where('id',$data['company_id'])->first();   
    $ExpensesArray=Expense::whereBetween('expense_date', [$from, $to])->where('company_id', $data['company_id']) ->get();
    $Expenses=[];
    $total=0;
    foreach ($ExpensesArray as $key => $value) {
    	$total=$total+$value->amount;
    	$Expenses[]=[
                   'expense_date'=>date('d/m/Y', strtotime($value->expense_date)),
                   'amount'=>$value->amount,
                   'notes'=>$value->notes,
                   'name'=>ExpenseCategory::where('id',$value->expense_category_id)->first()->name,
    	         ];
     }

        $range=$data['range'];

	    $pdf = PDF::loadView('pdf.expenses', compact('Expenses', 'total', 'Company','range'));
	    $file=public_path().'/pdf/_filename.pdf';
  	    $pdf->save($file);
	    return   $pdf->save(public_path().'/_filename123.pdf')->stream();

  

}

public function reportProfitLoss(Request $request){
    $data= $request->input();
	$range= explode(' / ', $data['range']);
		$from= $this->mmDDDyyyy_to_yyyymmDD($range[0]);   
    $to = $this->mmDDDyyyy_to_yyyymmDD($range[1]);  
    $Company=Company::where('id',$data['company_id'])->first(); 
    $Expenses=Expense::whereBetween('expense_date', [$from, $to])->where('company_id', $data['company_id']) ->sum('amount');
    $Income=Invoice::whereBetween('due_date', [$from, $to])->where('company_id', $data['company_id'])->where('status','COMPLETED')->sum('total');

    $total=$Income-$Expenses;
    $range=$data['range'];

    $pdf = PDF::loadView('pdf.profit-loss', compact('Expenses', 'Income','total', 'Company','range'));
    $file=public_path().'/pdf/_filename.pdf';
	    $pdf->save($file);
    return   $pdf->save(public_path().'/_filename123.pdf')->stream();






}

public function reportSales(Request $request){
    $data= $request->input();
    $type=$data['type'];
	$range= explode(' / ', $data['range']);
	$from= $this->mmDDDyyyy_to_yyyymmDD($range[0]);   
    $to = $this->mmDDDyyyy_to_yyyymmDD($range[1]);   
    $Company=Company::where('id',$data['company_id'])->first(); 


   if($type=='customer'){
	    $InvoiceCustomer= Invoice::whereBetween('due_date', [$from, $to])->where('company_id', $data['company_id'])->where('status','COMPLETED')->groupBy('customer_id')->select('customer_id')->get();
	    
	    $invoiceSArray=[];
	    foreach ($InvoiceCustomer as $key => $value) {
	    $invoiceSArray[$value->customer_id]=[
	                                          'customer'=>Customer::where('id',$value->customer_id)->first(),
	                                          'invoices'=>Invoice::whereBetween('due_date', [$from, $to])->where('company_id', $data['company_id'])->where('status','COMPLETED')->where('customer_id', $value->customer_id)->get()

	                                        ];


	    }
	    $range=$data['range'];
	    $pdf = PDF::loadView('pdf.sales-by-customer', compact('invoiceSArray', 'Company','range'));
	 }else{
	    $invoices= Invoice::whereBetween('due_date', [$from, $to])->where('company_id', $data['company_id'])->where('status','COMPLETED')->get();
	    
	    $invoiceIds=[];
	    foreach ($invoices as $key => $value) {
	      $invoiceIds[]=$value->id;
	    }

	    $Invoice_items=InvoiceItem::whereIn('invoice_id', $invoiceIds)->get();
	    
        $items=[];
        $total=0;
        foreach ($Invoice_items as $key => $value) {
        	$total=$total+$value->total;
        	 $items[$value->item_id]=[
                                      'name'=>$value->name,
                                      'total'=>(isset($items[$value->item_id]['total'])?$items[$value->item_id]['total']:0)+$value->total
        	                         ];
        }


	     
	    $range=$data['range'];
	    $pdf = PDF::loadView('pdf.sales-by-item', compact('items','total', 'Company','range'));

	 }


    $file=public_path().'/pdf/_filename.pdf';
	    $pdf->save($file);
    return   $pdf->save(public_path().'/_filename123.pdf')->stream();

 



 


}


 function connectDB(){
             	$servername = "localhost";
				$username = "u7h54cyuvg269";
				$password = "r95v8qbqqnph";
                $dbname="dbx3d2kwmenrv6";
				try {
					  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
 					  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					  $stmt = $conn->prepare("SELECT * FROM ssk_users");
 					  $stmt->execute();
						 while ($row = $stmt->fetch(PDO::FETCH_OBJ, PDO::FETCH_ORI_NEXT)) {
						       ////INSERT RECORD IN MAIN DB
                           $i=  Customer::create([
                              'name'=>$row ->user_nicename,
                              'email'=>$row ->user_email,
                              'phone'=>'-',
                             ]);

                          print_r($i);
						 }



 				} catch(PDOException $e) {
				  echo "Connection failed: " . $e->getMessage();
				}
 }
 public function mmDDDyyyy_to_yyyymmDD($date){
          $res = explode("/", $date);
          return $res[2]."-".$res[0]."-".$res[1];
 } 
}