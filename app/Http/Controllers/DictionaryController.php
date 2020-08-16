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

use App\Dictionary;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth ;
use Illuminate\Support\Facades\Hash;
use PDF;





class DictionaryController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

 public function automotiveDictionary(){
  $Dictionaries= Dictionary::select('dictionaries.letter')->groupBy('letter');
   if(isset($_REQUEST['q']) && $_REQUEST['q'] !=''){
      $Dictionaries= $Dictionaries->where('letter',$_REQUEST['q'] );
   }
   $Dictionaries= $Dictionaries->paginate(10);
    $page_name='Dictionary';
    return view('dictionary.dictionary', compact('page_name','Dictionaries'));

 }


 public function automotiveDictionaryWords(){
   $page_name='Dictionary';
     $Dictionaries= Dictionary::where('name','!=','');


      if(isset($_REQUEST['q']) && $_REQUEST['q'] !=''){
          $Dictionaries= $Dictionaries->where('name','like','%'.$_REQUEST['q'].'%' );
       }
      if(isset($_REQUEST['letter']) && $_REQUEST['letter'] !=''){
          $Dictionaries= $Dictionaries->where('letter',$_REQUEST['letter'] );
       }

       $Dictionaries= $Dictionaries->paginate(10);
   return view('dictionary.dictionary-words', compact('page_name','Dictionaries'));
 }

}
