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


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth ;
use Illuminate\Support\Facades\Hash;
use PDF;





class ReportController extends Controller{
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
 

 public function reportSales(Request $request){
    $page_name="Sales Report";

   return view('report.sales', compact('page_name'));
 }

 public function reportProfitLoss(Request $request){
    $page_name="Profit & Loss Report";

   return view('report.profitLoss', compact('page_name'));
 }

 public function reportExpensess(Request $request){
    $page_name="Expenses Report";
 return view('report.expensess', compact('page_name'));
 }

 public function reportTaxes(Request $request){
    $page_name="Taxes Report";

   return view('report.taxes', compact('page_name'));
 }



}
