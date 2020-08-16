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


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth ;
use Illuminate\Support\Facades\Hash;
use PDF;





class ShopAdminController extends Controller{
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



      public function customers(){
         
        $page_name="Customers";

        $customercount = Customer::where('company_id',Auth::user()->company_id)->where('is_delete',0)->count();
              $customers = Customer::where('company_id',Auth::user()->company_id)->where('is_delete',0)->orderBy('id','DESC')->paginate(10);
              return view('shop-admin.customers', compact('page_name','customers','customercount'));
      }


       public function customersView(Request $request, $auth_token){
        
       $page_name="Customers View";
         $customer = Customer::where('auth_token',$auth_token)->first();

          $msg='';
         $data=$request->input();
         if(isset($data) && count($data)){
            if(isset($data['id']) && trim($data['id']) !=''){
               Customer_note::where('id',$data['id'])->update([
                 'notes'=>$data['notes'],
                ]);
               $msg='successfully updated';
            }else{
               Customer_note::create([
                 'notes'=>$data['notes'],
                 'customer_id'=>$customer->id,
                 'auth_token'=>$this->createUniqueId()
               ]);
               $msg='successfully added';
            }

          return redirect('customers/view/'.$auth_token)->with('success',$msg); 
         }
         $customer_notes = Customer_note::where('customer_id', $customer->id)->get();
         $invoices=Invoice::where('invoices.company_id',Auth::user()->company_id)
                   ->where('invoices.customer_id',$customer->id)
                   ->where('invoices.is_delete','!=',1)
                   ->orderBy('invoices.id','DESC')
                   ->leftJoin('customers', 'customers.id', '=', 'invoices.customer_id');
         $invoices=$invoices->select('customers.name','invoices.invoice_number','invoices.*')->paginate(30);
          $estimates=Estimate::where('estimates.company_id',Auth::user()->company_id)->where('estimates.is_delete','!=',1)
                    ->where('estimates.customer_id',$customer->id)
                    ->orderBy('estimates.id','DESC')
                   ->leftJoin('customers', 'customers.id', '=', 'estimates.customer_id');
          $estimates=$estimates->select('customers.name','estimates.estimate_number','estimates.*')->paginate(30);
       

          $vehiclesAll=Vehicle::where('customer_id', $customer->id)->get();
              $vehicles=[];
              foreach ($vehiclesAll as $key => $v) {
                 $vehicles[]=[
                      'make'=>$v->make,
                      'model'=>$v->model,
                      'year'=>$v->year,
                      'color'=>$v->color,
                      'mileage'=>$v->mileage,
                      'notes'=>$v->notes,
                      'id'=>$v->id,
                      'uniq_id'=>$v->auth_token
                 ];
              }


        return view('shop-admin.customers-view', compact('page_name','customer','invoices','estimates','msg','customer_notes','vehicles'));
    }

    public function customerNoteDelete(Request $request, $auth_token){
        

              Customer_note::where('auth_token',$auth_token)->delete();
                          return back()->with('success',' successfully Deleted!');
    }

    public function customersNew(Request $request){
 
        $page_name="Customer";
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required|min:10',
             ]);

            $data['vehicles_data']= json_decode($data['vehicles_json_data']);
 
 
           $customer= Customer::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'street_address'=>$data['street_address'], 
                'city'=>$data['city'], 
                'state'=>$data['state'], 
                'zip_code'=>$data['zip_code'], 
                'customer_notes'=>$data['customer_notes'],
                'company_id' => Auth::user()->company_id,
                'auth_token'=> $this->createUniqueId(),
              ]);

       
           if(isset($data['vehicles_data'])){
               foreach ($data['vehicles_data']  as $key => $vehicle) {
                  Vehicle::create([
                        'make'=>$vehicle->make,
                        'model'=>$vehicle->model,
                        'year'=>$vehicle->year,
                        'color'=>$vehicle->color,
                        'mileage'=>$vehicle->mileage,
                        'notes'=>$vehicle->notes,
                        'customer_id'=>$customer->id,
                        'company_id' => Auth::user()->company_id,
                        'auth_token'=> $this->createUniqueId(),
                        ]);
               }
           }

            return redirect('customers')->with('success','Customer successfully Added!');
          }
        return view('shop-admin.customers-new', compact('page_name'));
    }

    public function customersEdit(Request $request,$auth_token){
        
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required|min:10',
            ]);
       $data['vehicles_data']= json_decode($data['vehicles_json_data']);
  
            Customer::where('auth_token',$auth_token)
                  ->update([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'phone' => $data['phone'],
                        'street_address'=>$data['street_address'], 
                        'city'=>$data['city'], 
                        'state'=>$data['state'], 
                        'zip_code'=>$data['zip_code'], 
                        'customer_notes'=>$data['customer_notes']                  
                  ]); 
            $customer = Customer::where('auth_token', $auth_token)->first();
             Vehicle::where('customer_id',$customer->id )->delete();
             if(isset($data['vehicles_data'])){
                           foreach ($data['vehicles_data']  as $key => $vehicle) {
                             if(isset($vehicle->id) && $vehicle->id>0){
                              Vehicle::create([
                                    'make'=>$vehicle->make,
                                    'model'=>$vehicle->model,
                                    'year'=>$vehicle->year,
                                    'color'=>$vehicle->color,
                                    'mileage'=>$vehicle->mileage,
                                    'notes'=>$vehicle->notes,
                                    'customer_id'=>$customer->id,
                                    'id'=>$vehicle->id,
                                    'company_id' => Auth::user()->company_id,
                                    'auth_token'=> $this->createUniqueId(),
                                    ]);
                            }else{
                              Vehicle::create([
                                    'make'=>$vehicle->make,
                                    'model'=>$vehicle->model,
                                    'year'=>$vehicle->year,
                                    'color'=>$vehicle->color,
                                    'mileage'=>$vehicle->mileage,
                                    'notes'=>$vehicle->notes,
                                    'customer_id'=>$customer->id,
                                     'company_id' => Auth::user()->company_id,
                                    'auth_token'=> $this->createUniqueId(),
                                    ]);
                            }
                 }
             }
            return back()->with('success','Customer successfully updated!');
          }

        $page_name="Edit Customer";
        $customer = Customer::where('auth_token', $auth_token)->first();
        $vehiclesAll=Vehicle::where('customer_id', $customer->id)->get();
        $vehicles=[];
        foreach ($vehiclesAll as $key => $v) {
           $vehicles[]=[
                'make'=>$v->make,
                'model'=>$v->model,
                'year'=>$v->year,
                'color'=>$v->color,
                'mileage'=>$v->mileage,
                'notes'=>$v->notes,
                'id'=>$v->id,
                'uniq_id'=>$v->auth_token
           ];
        }
        return view('shop-admin.customers-edit', compact('page_name','customer','vehicles'));
      }



   public function addUpdateVehicle(Request $request){
              $data=$request->input();
              $vehicle=(object)$data;
                   $vdata=[];

                    $vehicle->make= ($vehicle->make !='')? $vehicle->make:' ';
                    $vehicle->model= ($vehicle->model !='')? $vehicle->model:' ';
                    $vehicle->year= ($vehicle->year !='')? $vehicle->year:' ';
                    $vehicle->color= ($vehicle->color !='')? $vehicle->color:' ';
                    $vehicle->mileage= ($vehicle->mileage !='')? $vehicle->mileage:' ';
                    $vehicle->notes= ($vehicle->notes !='')? $vehicle->notes:' ';
                     if(isset($vehicle->id) && $vehicle->id>0){
                           Vehicle::where('id',$vehicle->id)->delete();
                           $vdata=   Vehicle::create([
                                    'make'=>$vehicle->make,
                                    'model'=>$vehicle->model,
                                    'year'=>$vehicle->year,
                                    'color'=>$vehicle->color,
                                    'mileage'=>$vehicle->mileage,
                                    'notes'=>$vehicle->notes,
                                    'customer_id'=>$vehicle->customer_id,
                                    'id'=>$vehicle->id,
                                    'company_id' => Auth::user()->company_id,
                                    'auth_token'=> $this->createUniqueId(),
                                    ]);
                            }else{
                            $vdata=  Vehicle::create([
                                    'make'=>$vehicle->make,
                                    'model'=>$vehicle->model,
                                    'year'=>$vehicle->year,
                                    'color'=>$vehicle->color,
                                    'mileage'=>$vehicle->mileage,
                                    'notes'=>$vehicle->notes,
                                    'customer_id'=>$vehicle->customer_id,
                                     'company_id' => Auth::user()->company_id,
                                    'auth_token'=> $this->createUniqueId(),
                                    ]);
                            }
              
               return response()->json([
                    'message' => 'successfully Added/Updated.',
                    'data' =>$vdata,
                    'isError' => false,
                    'responseCode'=>200
                ], 200);
               
        }

        public function deleteVehicle(Request $request){
              $data=$request->input();
             $delete= Vehicle::where('id', $data['id'])
                    ->where('company_id', Auth::user()->company_id)
                    ->delete();
             if($delete){
               return response()->json([
                    'message' => 'successfully deleted.',
                    'data' =>true,
                    'isError' => false,
                    'responseCode'=>200
                ], 200);
             }   
        }
        public function customersDelete($auth_token) {
         
                 Customer::where('auth_token',$auth_token)->delete();
                 return back()->with('error','Deleted successfully!');
        }
    
        public function customersMultidelete(Request $request){
            
        	 $data=$request->input();
        	 //print_r($data); die;
        	 if($data['model'] == "Customer"){
            if(!empty($data['isdelete'])){
        	 Customer::whereIn('id',$data['isdelete'])
                  ->update([
                        'is_delete' => 1,
                                        
                  ]);
              }
            }
              if($data['model'] == "Item"){
                if(!empty($data['isdelete'])){
        	 Item::whereIn('id',$data['isdelete'])
                  ->update([
                        'is_delete' => 1,
                                        
                  ]);
              }
            }
                    if($data['model'] == "Estimate"){
                      if(!empty($data['isdelete'])){
        	 Estimate::whereIn('id',$data['isdelete'])
                  ->update([
                        'is_delete' => 1,
                                        
                  ]);
                }
              }
                    if($data['model'] == "Invoice"){
                      if(!empty($data['isdelete'])){
        	 Invoice::whereIn('id',$data['isdelete'])
                  ->update([
                        'is_delete' => 1,
                                        
                  ]);
                }
              }
                   return back()->with('error','Deleted successfully!');
        }



/////////////////////INVOICES FUNCTIONS START///////////////////////////////////////





        public function invoices(Request $request){
      
        $data=$request->input();
        $page_name="Invoices";
        $type='all';
         

         $invoices=Invoice::where('invoices.company_id',Auth::user()->company_id)->where('invoices.is_delete','!=',1)
                   ->orderBy('invoices.id','DESC')
                   ->leftJoin('customers', 'customers.id', '=', 'invoices.customer_id');
         // if(isset($data['search']) && $data['search']!=''){
         //       $invoices=$invoices->where(function($q) use($data) {
         //            $q->where('invoices.invoice_number','like', '%'.$data['search'].'%')
         //            ->orWhere('customers.email','like', '%'.$data['search'].'%')
         //            ->orWhere('customers.name', 'like','%'.$data['search'].'%');
         //            });
         // }
         


                 if(isset($data['filter']) && ($data['filter']=='show')){
                      if(isset($data['filter_customer_id'])){
                        $invoices=$invoices->where('invoices.customer_id', $data['filter_customer_id']);
                      }
                      if(isset($data['filter_invoice_number'])){
                        $invoices=$invoices->where('invoices.invoice_number', $data['filter_invoice_number']);
                      }

                      if(isset($data['filter_status'])){
                          if($data['filter_status']=='SENT'){
                              $invoices=$invoices->where('invoices.status', $data['filter_status']);
                          } 
                          if($data['filter_status']=='PAID'){
                              $invoices=$invoices->where('invoices.status', 'COMPLETED');
                          } 
                          if($data['filter_status']=='PARTIALLY PAID'){
                              $invoices=$invoices->where('invoices.paid_status', 'PARTIALLY PAID');
                          } 
                          if($data['filter_status']=='UNPAID'){
                              $invoices=$invoices->where('invoices.paid_status', 'UNPAID');
                          } 



                          
                      }

                      if(isset($data['filter_date_range'])){
                        $filter_date_range=explode(' / ', $data['filter_date_range'])  ;  
                             $from= $this->mmDDDyyyy_to_yyyymmDD($filter_date_range[0]);   
                             $to = $this->mmDDDyyyy_to_yyyymmDD($filter_date_range[1]);   




                             $invoices=$invoices->whereBetween('invoices.due_date', [$from, $to]);
                       }
                  }


         $invoices=$invoices->select('customers.name','invoices.invoice_number','invoices.*')->paginate(10);
         $subscriptionStatus=$this->shopAdminSubcriptionStatusCheck();
        return view('shop-admin.invoices', compact('page_name','invoices','type','subscriptionStatus'));
    }


    public function invoicesView($auth_token){
        
     $page_name="Invoices";
           
      $invoices=Invoice::where('company_id',Auth::user()->company_id)->where('is_delete','!=',1)->orderBy('id','DESC')->paginate(10);

      $selected_invoice=Invoice::where('company_id',Auth::user()->company_id)->where('auth_token',$auth_token)->orderBy('id','DESC')->first();
            return view('shop-admin.invoices-view', compact('page_name','selected_invoice','invoices'));
    }



    public function invoicesDues(Request $request){
     

        $page_name="Invoices";
        $type='dues';
         
        $data=$request->input();

          $invoices=Invoice::where('invoices.company_id',Auth::user()->company_id)->where('invoices.due_amount','>',0)->where('invoices.is_delete','!=',1)
                    ->orderBy('invoices.id','DESC')
                   ->leftJoin('customers', 'customers.id', '=', 'invoices.customer_id');
         // if(isset($data['search']) && $data['search']!=''){
         //       $invoices=$invoices->where(function($q) use($data) {
         //            $q->where('invoices.invoice_number','like', '%'.$data['search'].'%')
         //            ->orWhere('customers.email','like', '%'.$data['search'].'%')
         //            ->orWhere('customers.name', 'like','%'.$data['search'].'%');
         //            });
         // }



                 if(isset($data['filter']) && ($data['filter']=='show')){
                      if(isset($data['filter_customer_id'])){
                        $invoices=$invoices->where('invoices.customer_id', $data['filter_customer_id']);
                      }
                      if(isset($data['filter_invoice_number'])){
                        $invoices=$invoices->where('invoices.invoice_number', $data['filter_invoice_number']);
                      }

                      // if(isset($data['filter_status'])){
                      //   $invoices=$invoices->where('invoices.status', $data['filter_status']);
                      // }

                      if(isset($data['filter_date_range'])){
                        $filter_date_range=explode(' / ', $data['filter_date_range'])  ;  
                         
                             $from=  $this->mmDDDyyyy_to_yyyymmDD($filter_date_range['0'])  ;      
                   $to = $this->mmDDDyyyy_to_yyyymmDD($filter_date_range['1'])  ;  
                             $invoices=$invoices->whereBetween('invoices.due_date', [$from, $to]);
                       }
                  }



         $invoices=$invoices->select('customers.name','invoices.invoice_number','invoices.*')->paginate(10);

         $subscriptionStatus=$this->shopAdminSubcriptionStatusCheck();
        return view('shop-admin.invoices', compact('page_name','invoices','type','subscriptionStatus'));
     }


    public function invoicesDrafts(Request $request){
    
        $page_name="Invoices";
        $type='drafts';
        $data=$request->input();

          $invoices=Invoice::where('invoices.company_id',Auth::user()->company_id)->where('invoices.status','DRAFT')->where('invoices.is_delete','!=',1)
                    ->orderBy('invoices.id','DESC')
                   ->leftJoin('customers', 'customers.id', '=', 'invoices.customer_id');
                               // if(isset($data['search']) && $data['search']!=''){
                               //       $invoices=$invoices->where(function($q) use($data) {
                               //            $q->where('invoices.invoice_number','like', '%'.$data['search'].'%')
                               //            ->orWhere('customers.email','like', '%'.$data['search'].'%')
                               //            ->orWhere('customers.name', 'like','%'.$data['search'].'%');
                               //            });
                               // }

        if(isset($data['filter']) && ($data['filter']=='show')){
            if(isset($data['filter_customer_id'])){
              $invoices=$invoices->where('invoices.customer_id', $data['filter_customer_id']);
            }
            if(isset($data['filter_invoice_number'])){
              $invoices=$invoices->where('invoices.invoice_number', $data['filter_invoice_number']);
            }

            if(isset($data['filter_status'])){
              $invoices=$invoices->where('invoices.status', $data['filter_status']);
            }

            if(isset($data['filter_date_range'])){
              $filter_date_range=explode(' / ', $data['filter_date_range'])  ;  
                   $from=  $this->mmDDDyyyy_to_yyyymmDD($filter_date_range['0'])  ;      
                   $to = $this->mmDDDyyyy_to_yyyymmDD($filter_date_range['1'])  ;    
                   $invoices=$invoices->whereBetween('invoices.due_date', [$from, $to]);
             }
        }

        $invoices=$invoices->select('customers.name','invoices.invoice_number','invoices.*')->paginate(10);
        $subscriptionStatus=$this->shopAdminSubcriptionStatusCheck();
        return view('shop-admin.invoices', compact('page_name','invoices','type','subscriptionStatus'));
    }


    public function invoicesNew(Request $request){
    $subscriptionStatus=$this->shopAdminSubcriptionStatusCheck();
    if(!$subscriptionStatus['status']){ return redirect('/'); }

        $data=  $request->input();
        if(count($data)){
        $this->validate($request, [
        'invoice_date' => 'required',
        'due_date' => 'required',
        'invoice_number' => 'required',
        'customer_id' => 'required',
        'sub_total' => 'required',
        'total' => 'required',
        ]);
   
      

         $after_images_data = isset($data['after_images_data'])? $data['after_images_data']:'[]';
         $before_images_data = isset($data['before_images_data'])? $data['before_images_data']:'[]';
         $other_images_data = isset($data['other_images_data'])? $data['other_images_data']:'[]';

         $after_images_data= json_decode($after_images_data);
         $before_images_data= json_decode($before_images_data);
         $other_images_data =json_decode($other_images_data);
  
$data['invoice_date']= $this->mmDDDyyyy_to_yyyymmDD($data['invoice_date']) ;      
         $data['due_date']=  $this->mmDDDyyyy_to_yyyymmDD($data['due_date']) ;  

        $invoice_date=date('Y-m-d',strtotime($data['invoice_date']) );
        $due_date=date('Y-m-d',strtotime($data['due_date']) );
        $invoice_number=isset($data['invoice_number'])?$data['invoice_number']:'';
        $customer_id=isset($data['customer_id'])?$data['customer_id']:'';
        $sub_total=isset($data['sub_total'])?$data['sub_total']:'';
        $discount=isset($data['discount'])?$data['discount']:'';
        $discount_type=isset($data['discount_type'])?$data['discount_type']:'';
        $discount_val=isset($data['discount_val'])?$data['discount_val']:'';
        $total_tax=isset($data['total_tax'])?$data['total_tax']:'';
        $tax=isset($data['tax'])?$data['tax']:[];
        
        if($discount<=0){  $discount_type=''; $discount_val='0'; }
        if(!$discount){ $discount_type=''; $discount_val='0'; }


        $total=isset($data['total'])?$data['total']:'';
        $notes=isset($data['notes'])?$data['notes']:'';
        

        $invoiceData= [
            'invoice_date'=>$invoice_date,
            'due_date'=>$due_date,
            'invoice_number'=>$invoice_number,
            'notes'=>$notes,
            'discount_type'=>$discount_type,
            'discount'=>$discount,
            'discount_val'=>$discount_val,
            'sub_total'=>$sub_total,
            'total'=>$total,
            'due_amount'=>$total,
            'total_tax'=>$total_tax,
            'auth_token'=>$this->createUniqueId(),
            'company_id'=>Auth::user()->company_id,
            'customer_id'=>$customer_id
        ];
        $invoice=Invoice::create($invoiceData);
            if(isset($invoice)){
                $item_ids =isset($data['item_id'])?$data['item_id']:[];
                $quantities =isset($data['quantity'])? $data['quantity']:[];
                $prices =isset($data['price'])?$data['price']:[];
                $note_id =isset($data['note_id'])?$data['note_id']:[];
                

                foreach ($item_ids as $key => $value) {
                          $item_id =  $item_ids[$key];
                          $quantity =  $quantities[$key];
                          $price =  $prices[$key];
                          $notes= $note_id[$key];
                          $invoiceItem=Item::where('id',$item_id)->first();
                          $invoiceItemData=[
                            'item_id'=>$item_id,
                            'quantity'=>$quantity,
                            'price'=>$price,
                            'notes'=>$notes,
                            'total'=>($quantity*$price),
                            'name'=>$invoiceItem->name,
                            'invoice_id'=>$invoice->id,
                            'company_id'=>Auth::user()->company_id
                          ];
                          InvoiceItem::create($invoiceItemData);
                 }

            }

              foreach ($tax as $tax_id => $tax_amount) {
                      $TaxData=Tax::where('id',$tax_id)->first();
                      Invoice_tax::create([
                          'tax_id'=>$tax_id,
                          'percent'=>$TaxData->percent, 
                          'name'=>$TaxData->name, 
                          'tax_amount'=>$tax_amount, 
                          'invoice_id'=>$invoice->id, 
                          'company_id'=>Auth::user()->company_id
                        ]);
              }
 
                  InvoiceImage::where('invoice_id',$invoice->id)->delete();
                  
                  foreach ($after_images_data as $key => $imgs) {
                      InvoiceImage::create([
                        'company_id'=>Auth::user()->company_id,
                        'url'=>$imgs->url,
                        'notes'=>$imgs->notes,
                        'type'=>$imgs->type,
                        'invoice_id'=>$invoice->id
                      ]); 
                  }

                  foreach ($before_images_data as $key => $imgs) {
                      InvoiceImage::create([
                        'company_id'=>Auth::user()->company_id,
                        'url'=>$imgs->url,
                        'notes'=>$imgs->notes,
                        'type'=>$imgs->type,
                        'invoice_id'=>$invoice->id
                      ]); 
                  }

                  foreach ($other_images_data as $key => $imgs) {
                      InvoiceImage::create([
                        'company_id'=>Auth::user()->company_id,
                        'url'=>$imgs->url,
                        'notes'=>$imgs->notes,
                        'type'=>$imgs->type,
                        'invoice_id'=>$invoice->id
                      ]); 
                  }
                   
                return redirect('invoices')->with('success','Invoice successfully added!');

        }

    
        $customers = Customer::orderBy('id','DESC')->get();
        $page_name="New Invoice";
        $invoice_number=$this->generateUniqueInvoiceId();
        return view('shop-admin.invoices-new', compact('page_name','customers','invoice_number'));
      }


     public function invoicesEdit(Request $request,$auth_token){
    
        $data=  $request->input();


        if(count($data)){
        //       echo "<pre>";

        // print_r($data);
        // die();
        $this->validate($request, [
        'invoice_date' => 'required',
        'due_date' => 'required',
        'invoice_number' => 'required',
        'customer_id' => 'required',
        'sub_total' => 'required',
        'total' => 'required',
        ]);
         $data['invoice_date']= $this->mmDDDyyyy_to_yyyymmDD($data['invoice_date']) ;      
         $data['due_date']=  $this->mmDDDyyyy_to_yyyymmDD($data['due_date']) ;    

        $invoice_date=date('Y-m-d',strtotime($data['invoice_date']) );
        $due_date=date('Y-m-d',strtotime($data['due_date']) );
        $invoice_number=isset($data['invoice_number'])?$data['invoice_number']:'';
        $customer_id=isset($data['customer_id'])?$data['customer_id']:'';
        $sub_total=isset($data['sub_total'])?$data['sub_total']:'';
        $discount=isset($data['discount'])?$data['discount']:'';
        $discount_type=isset($data['discount_type'])?$data['discount_type']:'';
        $discount_val=isset($data['discount_val'])?$data['discount_val']:'';
        $total_tax=isset($data['total_tax'])?$data['total_tax']:'';
        $tax=isset($data['tax'])?$data['tax']:[];
        
        if($discount<=0){  $discount_type=''; $discount_val='0'; }
        if(!$discount){ $discount_type=''; $discount_val='0'; }


        $total=isset($data['total'])?$data['total']:'';
        $notes=isset($data['notes'])?$data['notes']:'';
        

         $after_images_data = isset($data['after_images_data'])? $data['after_images_data']:'[]';
         $before_images_data = isset($data['before_images_data'])? $data['before_images_data']:'[]';
         $other_images_data = isset($data['other_images_data'])? $data['other_images_data']:'[]';

         $after_images_data= json_decode($after_images_data);
         $before_images_data= json_decode($before_images_data);
         $other_images_data =json_decode($other_images_data);

        $invoiceData= [
            'invoice_date'=>$invoice_date,
            'due_date'=>$due_date,
            'invoice_number'=>$invoice_number,
            'notes'=>$notes,
            'discount_type'=>$discount_type,
            'discount'=>$discount,
            'discount_val'=>$discount_val,
            'sub_total'=>$sub_total,
            'total'=>$total,
            'total_tax'=>$total_tax,
            'due_amount'=>$total,
            'customer_id'=>$customer_id
        ];
        Invoice::where('auth_token',$auth_token)->update($invoiceData);
        $invoice=Invoice::where('auth_token',$auth_token)->first();
            if(isset($invoice)){
                InvoiceItem::where('invoice_id',$invoice->id)->delete();
                $item_ids =isset($data['item_id'])?$data['item_id']:[];
                $quantities =isset($data['quantity'])? $data['quantity']:[];
                $prices =isset($data['price'])?$data['price']:[];
                $note_id =isset($data['note_id'])?$data['note_id']:[];
                foreach ($item_ids as $key => $value) {
                          $item_id =  $item_ids[$key];
                          $quantity =  $quantities[$key];
                          $price =  $prices[$key];
                          $notes =  $note_id[$key];

                          $invoiceItem=Item::where('id',$item_id)->first();
                          $invoiceItemData=[
                            'item_id'=>$item_id,
                            'quantity'=>$quantity,
                            'price'=>$price,
                            'total'=>($quantity*$price),
                            'name'=>$invoiceItem->name,
                            'invoice_id'=>$invoice->id,
                            'notes'=>$notes,
                            'company_id'=>Auth::user()->company_id
                          ];
                          InvoiceItem::create($invoiceItemData);
                 }

            }



              Invoice_tax::where('invoice_id', $invoice->id)->delete();

              foreach ($tax as $tax_id => $tax_amount) {
                      $TaxData=Tax::where('id',$tax_id)->first();
                      Invoice_tax::create([
                          'tax_id'=>$tax_id,
                          'percent'=>$TaxData->percent, 
                          'name'=>$TaxData->name, 
                          'tax_amount'=>$tax_amount, 
                          'invoice_id'=>$invoice->id, 
                          'company_id'=>Auth::user()->company_id
                        ]);
              }


                  InvoiceImage::where('invoice_id',$invoice->id)->delete();
                  
                  foreach ($after_images_data as $key => $imgs) {
                      InvoiceImage::create([
                        'company_id'=>Auth::user()->company_id,
                        'url'=>$imgs->url,
                        'notes'=>$imgs->notes,
                        'type'=>$imgs->type,
                        'invoice_id'=>$invoice->id
                      ]); 
                  }

                  foreach ($before_images_data as $key => $imgs) {
                      InvoiceImage::create([
                        'company_id'=>Auth::user()->company_id,
                        'url'=>$imgs->url,
                        'notes'=>$imgs->notes,
                        'type'=>$imgs->type,
                        'invoice_id'=>$invoice->id
                      ]); 
                  }

                  foreach ($other_images_data as $key => $imgs) {
                      InvoiceImage::create([
                        'company_id'=>Auth::user()->company_id,
                        'url'=>$imgs->url,
                        'notes'=>$imgs->notes,
                        'type'=>$imgs->type,
                        'invoice_id'=>$invoice->id
                      ]); 
                  }



                        return redirect('invoices')->with('success','Invoice successfully updated!');
        }


        $invoice=Invoice::where('auth_token',$auth_token)->first();
        $customer = Customer::where('id',$invoice->customer_id)->first();
        $invoiceItems=InvoiceItem::where('invoice_id',$invoice->id)->get();
        $InvoiceImages=InvoiceImage::where('invoice_id',$invoice->id)->get();
        $InvoiceImage=[];
        foreach ($InvoiceImages as $key => $value) {
           $value->uniqId=rand().rand().rand().rand();
           $InvoiceImage[]=$value;
        }
    
        $Invoice_tax=Invoice_tax::select('tax_id as id', 'invoice_id' ,'name', 'percent','tax_amount')->where('invoice_id', $invoice->id)->get();
        $Tax=Tax::get();

 


        $page_name=" Edit Invoice";
        return view('shop-admin.invoices-edit', compact('page_name','customer','invoice','invoiceItems','InvoiceImage','Invoice_tax','Tax'));
      }




     public function invoicesClone(Request $request, $auth_token){

     
     $subscriptionStatus=$this->shopAdminSubcriptionStatusCheck();
     if(!$subscriptionStatus['status']){ return redirect('/'); }
          $invoice=Invoice::where('auth_token',$auth_token)->first();
          $invoiceItems=InvoiceItem::where('invoice_id',$invoice->id)->get();
          $invoiceTaxes=Invoice_tax::where('invoice_id',$invoice->id)->get();
          $invoiceData= [
              'invoice_date'=>$invoice->invoice_date,
              'due_date'=>$invoice->due_date,
              'invoice_number'=>$this->generateUniqueInvoiceId(),
              'notes'=>$invoice->notes,
              'discount_type'=>$invoice->discount_type,
              'discount'=>$invoice->discount,
              'discount_val'=>$invoice->discount_val,
              'sub_total'=>$invoice->sub_total,
              'total'=>$invoice->total,
              'total_tax'=>$invoice->total_tax,
              'due_amount'=>$invoice->due_amount,
              'auth_token'=>$this->createUniqueId(),
              'company_id'=>Auth::user()->company_id,
              'customer_id'=>$invoice->customer_id
          ];
          $invoice=Invoice::create($invoiceData);

          if(isset($invoice)){
                foreach ($invoiceItems as $key => $value) {
                          $invoiceItemData=[
                            'item_id'=>$value->item_id ,
                            'quantity'=>$value->quantity ,
                            'price'=>$value->price ,
                            'notes'=>$value->notes ,
                            'total'=>$value->total ,
                            'name'=>$value->name ,
                            'invoice_id'=>$invoice->id,
                            'company_id'=>Auth::user()->company_id
                          ];
                          InvoiceItem::create($invoiceItemData);
                 }
          }



            foreach ($invoiceTaxes as $taxs) {
                       Invoice_tax::create([
                          'tax_id'=>$taxs->tax_id,
                          'percent'=>$taxs->percent, 
                          'name'=>$taxs->name, 
                          'tax_amount'=>$taxs->tax_amount, 
                          'invoice_id'=>$invoice->id, 
                          'company_id'=>Auth::user()->company_id
                        ]);
              }
 



            return redirect('invoices')->with('success','Invoice successfully cloned!');
     }
  


    public function estimateClone(Request $request, $auth_token){
     $subscriptionStatus=$this->shopAdminSubcriptionStatusCheck();
     if(!$subscriptionStatus['status']){ return redirect('/'); }
          
          $estimate=Estimate::where('auth_token',$auth_token)->first();
          $estimateItems=EstimateItem::where('estimate_id',$estimate->id)->get();
          $estimateTaxes=Estimate_tax::where('estimate_id',$estimate->id)->get();
     



        $estimateData= [
            'estimate_date'=>$estimate->estimate_date,
            'due_date'=>$estimate->due_date,
            'estimate_number'=>$this->generateUniqueEstimateId(),
             'notes'=>$estimate->notes,
            'discount_type'=>$estimate->discount_type,
            'discount'=>$estimate->discount,
            'discount_val'=>$estimate->discount_val,
            'sub_total'=>$estimate->sub_total,
            'total'=>$estimate->total,
            'total_tax'=>$estimate->total_tax,
             'auth_token'=>$this->createUniqueId(),
            'company_id'=>Auth::user()->company_id,
            'customer_id'=>$estimate->customer_id
        ];

          $estimate=Estimate::create($estimateData);

          if(isset($estimate)){
                foreach ($estimateItems as $key => $value) {
                           $estimateItemData=[
                            'item_id'=>$value->item_id ,
                            'quantity'=>$value->quantity ,
                            'price'=>$value->price ,
                            'total'=>$value->total ,
                            'name'=>$value->name ,
                            'estimate_id'=>$estimate->id,
                            'notes'=>$value->notes ,
                            'company_id'=>Auth::user()->company_id
                          ];
                          EstimateItem::create($estimateItemData);
                 }
          }



            foreach ($estimateTaxes as $taxs) {
                           Estimate_tax::create([
                            'tax_id'=>$taxs->tax_id ,
                            'percent'=>$taxs->percent, 
                            'name'=>$taxs->name, 
                            'tax_amount'=>$taxs->tax_amount, 
                            'estimate_id'=>$estimate->id, 
                            'company_id'=>Auth::user()->company_id
                          ]);
              }
 



            return redirect('estimates')->with('success','Estimate successfully cloned!');
     }
  


  
     public function invoicesMarkAsSent(Request $request, $auth_token){
      
             $invoiceData= [
               'status'=> 'SENT',
             ];
            Invoice::where('auth_token',$auth_token)->update($invoiceData);
            return redirect('invoices/dues')->with('success','Invoice successfully sent!');
    }


    public function invoicesRecordPayment(Request $request, $auth_token){
    $page_name="Invoices Record Payment";
    $invoice=Invoice::where('auth_token',$auth_token)->first();
    $customer=Customer::where('auth_token',$auth_token)->first();
    $customers = Customer::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->get();
    $invoices = Invoice::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->get();
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
              'payment_number' => 'required',
            //'payment_date' => 'required',
             'amount'=>'required',
            'customer_id'=>'required',
            'invoice_id'=>'required',
            'payment_method_id'=>'required'
               ]);
           Payment::create([
                'payment_number' => $data['payment_number'],
                 'payment_date' => date('Y-m-d',strtotime($data['payment_date'])),
                 'notes'=>$data['notes'],
                 'amount'=>$data['amount'],
                 'customer_id'=>$data['customer_id'],
                'invoice_id'=>$data['invoice_id'],
                 'payment_method_id'=>$data['payment_method_id'],
                'auth_token'=> $this->createUniqueId(),
                'company_id' => Auth::user()->company_id,
                
             ]);

            $invoiceData= [
            'status'=> 'COMPLETED',
            'due_amount' =>$data['amount'],
             ];

              Invoice::where('auth_token',$auth_token)->update($invoiceData);
            return back()->with('success','Payment successfully Saved!');
          }

        
 
        return view('shop-admin.record-payment', compact('page_name','customer','invoice','customers','invoices'));
      }


     public function invoicesDelete(Request $request, $auth_token){
      
          $invoice=Invoice::where('auth_token',$auth_token)->first();
          InvoiceImage::where('invoice_id',$invoice->id)->delete();
          InvoiceItem::where('invoice_id',$invoice->id)->delete();
          Payment::where('invoice_id',$invoice->id)->delete();
          Invoice::where('auth_token',$auth_token)->delete();
     return redirect('invoices')->with('success','Invoice successfully deleted!');

  }




// ////////////////////INVOICES FUNCTIONS END///////////////////////////////////////






   public function items(){
  
   $page_name="Item";
   $itemcount = Item::where('is_delete', '=', 0)
                ->where('company_id',Auth::user()->company_id)
                ->count();
  //$itemcount = Item::where(['is_delete', '=', 0])->count();
        $items = Item::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->paginate(10);
        return view('shop-admin.items', compact('page_name','items','itemcount'));
   }

   public function itemsNew(Request $request){
   
  $page_name="Item";
   $categories = Category::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->get();

        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
             ]);
                      
           $item= Item::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'company_id' => Auth::user()->company_id,
                'auth_token'=> $this->createUniqueId(),
              ]); 
            
            if(isset($data['category_price'])){
              foreach ($data['category_price'] as $key => $value) {
                 if($value !=''){
                                $d=[
                                'item_id' => $item->id,
                                'category_id' => $key,
                                'price' => $value,
                                'company_id' => Auth::user()->company_id,

                                ];
                                Item_category::create($d);
                 }
              }
             }
            return redirect('items')->with('success','Item successfully Added!');
          }
        
        return view('shop-admin.items-new', compact('page_name','categories'));
    }

    public function itemsEdit(Request $request,$auth_token){
     
        $data=$request->input();
         $categories = Category::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->get();
        $item = Item::where('auth_token', $auth_token)->first();

         if(count($data)){
            $this->validate($request, [
             'name' => 'required',
             'description' => 'required',
             'price' => 'required',
               ]);
            Item::where('auth_token',$auth_token)
                  ->update([
                     'name' => $data['name'],
                     'description' => $data['description'],
                     'price' => $data['price'],
                     'company_id' => Auth::user()->company_id,
                   ]);

            if(isset($data['category_price'])){
                
                Item_category::where('item_id',$item->id)->delete();
              foreach ($data['category_price'] as $key => $value) {
                 if($value !=''){
                                $d=[
                                'item_id' => $item->id,
                                'category_id' => $key,
                                'price' => $value,
                                'company_id' => Auth::user()->company_id,

                                ];
                                Item_category::create($d);
                 }
              }
             } 
            return back()->with('success','Item successfully Updated!');
          }

        $page_name="Edit Item";
        $item = Item::where('auth_token', $auth_token)->first();
        $item_categories=[];
        $item_categoriesData=Item_category::where('item_id',$item->id)->get();
        foreach ($item_categoriesData as $key => $value) {
             $cat=Category::where('company_id',Auth::user()->company_id)->where('id',$value->category_id)->first();

            $item_categories[]=['id'=>$value->category_id, 'price'=>$value->price,'name'=>$cat->name];
        }

        $item_categories=json_encode($item_categories);


       
        return view('shop-admin.items-edit', compact('page_name','item','categories','item_categories'));
    }

     public function itemsDelete($auth_token) {
        

         Item::where('auth_token',$auth_token)->delete();
         return back()->with('error','Deleted successfully!');
    }

    public function categories(){
     
    $page_name="Category";
        $categories = Category::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->paginate(10);
        return view('shop-admin.categories', compact('page_name','categories'));
    }

    public function categoriesNew(Request $request){
     
    $page_name="Category";

        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
              'name' => 'required',
              'description' => 'required'
            ]);
            Category::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'company_id' => Auth::user()->company_id,
                'auth_token'=>  $this->createUniqueId(),
                
             ]); 


            return redirect('categories')->with('success','Category successfully Added!');
          }
        
        return view('shop-admin.categories-new', compact('page_name'));
      }

    public function categoriesEdit(Request $request,$auth_token){
     
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
               ]);
            Category::where('auth_token',$auth_token)
                  ->update([
                     'name' => $data['name'],
                     'description' => $data['description'],
                     'company_id' => Auth::user()->company_id,
                   
                  ]); 
            return back()->with('success','Category successfully Updated!');
          }

        $page_name="Edit Category";
        $category = Category::where('auth_token', $auth_token)->first();
        return view('shop-admin.categories-edit', compact('page_name','category'));
    }

     public function categoriesDelete($auth_token) {
        
         Category::where('auth_token',$auth_token)->delete();
         return back()->with('error','Deleted successfully!');
    }

  public function units(){
    
  $page_name="Unit";
        $units = Unit::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->paginate(10);
        return view('shop-admin.units', compact('page_name','units'));
  }

  public function unitsNew(Request $request){
    
  $page_name="Unit";

        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            'name' => 'required',
             ]);
            Unit::create([
                'name' => $data['name'],
                'auth_token'=> $this->createUniqueId(),
                'company_id' => Auth::user()->company_id,
                
             ]); 


            return redirect('units')->with('success','Unit successfully Added!');
          }
        
        return view('shop-admin.units-new', compact('page_name'));
    }

    public function unitsEdit(Request $request,$auth_token){
    
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
             'name' => 'required',
               ]);
            Unit::where('auth_token',$auth_token)
                  ->update([
                     'name' => $data['name'],
                     'company_id' => Auth::user()->company_id
                  ]); 
            return back()->with('success','Unit successfully Updated!');
          }

        $page_name="Edit Unit";
        $unit = Unit::where('auth_token', $auth_token)->first();
 
        return view('shop-admin.units-edit', compact('page_name','unit'));
    }

     public function unitsDelete($auth_token) {
        
         Unit::where('auth_token',$auth_token)->delete();
         return back()->with('error','Deleted successfully!');
    }



  public  function createUniqueId( $delimiter = '-'){
      
    $str= Hash::make(uniqid(time(), true));
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug.uniqid(time(), true);
   } 


  public function expenses(){
    
  $page_name="Expenses";
        $expenses = Expense::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->paginate(10);
        return view('shop-admin.expenses', compact('page_name','expenses'));
  }

  public function expensesNew(Request $request){
    
  $page_name="Expenses";
  $expense_categories = ExpenseCategory::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->get();
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            'expense_date' => 'required',
            'amount' => 'required',
            'expense_category_id' => 'required',
            'receipt' => 'max:2048',
             ]);
             $attachment_receipt='';
            if($request->has('receipt')) {
                    $fileName = time().'.'.$request->receipt->extension();  
                    $request->receipt->move(public_path('uploads/attachment_receipt'), $fileName);
                    $attachment_receipt=$fileName;
            }

             $data['expense_date']=  $this->mmDDDyyyy_to_yyyymmDD($data['expense_date'])  ; 

            Expense::create([
                'expense_date' => date('Y-m-d',strtotime($data['expense_date'])),
                 'amount' => $data['amount'],
                 'notes' => $data['notes'],
                 'expense_category_id' => $data['expense_category_id'],
                 'attachment_receipt'=>$attachment_receipt,
                 'auth_token'=> $this->createUniqueId(),
                 'company_id' => Auth::user()->company_id,
                
             ]); 


            return redirect('expenses')->with('success','Expenses successfully Added!');
          }
        
        return view('shop-admin.expenses-new', compact('page_name','expense_categories'));
    }

  public function expensesEdit(Request $request,$auth_token){
   
        $data=$request->input();
          if(count($data)){
            $this->validate($request, [
                    'expense_date' => 'required',
                    'amount' => 'required',
                    'expense_category_id' => 'required',
                    'receipt' => 'max:2048',
               ]);
            $data['expense_date']=  $this->mmDDDyyyy_to_yyyymmDD($data['expense_date'])  ; 

             Expense::where('auth_token',$auth_token)
                  ->update([
                    'expense_date' => date('Y-m-d',strtotime($data['expense_date'])),
                    'amount' => $data['amount'],
                    'notes' => $data['notes'],
                    'expense_category_id' => $data['expense_category_id'],
                   ]); 
            if($request->has('receipt')) {
                    $fileName = time().'.'.$request->receipt->extension();  
                    $request->receipt->move(public_path('uploads/attachment_receipt'), $fileName);                    
                    Expense::where('auth_token',$auth_token)
                          ->update([
                             'attachment_receipt' => $fileName,
                            ]);

            }

            return back()->with('success','Expense  successfully Updated!');
          }

        $page_name="Edit Expense ";
        $expense_categories = ExpenseCategory::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->get();
        $expense = Expense::where('auth_token', $auth_token)->first();
 
        return view('shop-admin.expenses-edit', compact('page_name','expense','expense_categories'));
    }

    public function expensesDelete($auth_token) {
        
         Expense::where('auth_token',$auth_token)->delete();
         return back()->with('error','Deleted successfully!');
    }

  public function expensescategories(){
    
  $page_name="Expenses Category";
        $expensescate = ExpenseCategory::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->paginate(10);
        return view('shop-admin.expenses-categories', compact('page_name','expensescate'));
  }

  public function expensescategoriesNew(Request $request){
    
  $page_name="Expenses Category";

        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
           
             ]);
            ExpenseCategory::create([
                'name' => $data['name'],
                 'description' => $data['description'],
                
                'auth_token'=> $this->createUniqueId(),
                'company_id' => Auth::user()->company_id,
                
             ]); 


            return redirect('expenses-categories')->with('success','Expenses Category successfully Added!');
          }
        
        return view('shop-admin.expenses-categories-new', compact('page_name'));
    }

    public function expensescategoriesEdit(Request $request,$auth_token){
     
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
             'name' => 'required',
             'description' => 'required'
               ]);
            ExpenseCategory::where('auth_token',$auth_token)
                  ->update([
                     'name' => $data['name'],
                     'description'=> $data['description'],
                     'company_id' => Auth::user()->company_id
                  ]); 
            return back()->with('success','Expense Category successfully Updated!');
          }

        $page_name="Edit Expense Category";
        $expense = ExpenseCategory::where('auth_token', $auth_token)->first();
 
        return view('shop-admin.expenses-categories-edit', compact('page_name','expense'));
    }

     public function expensescategoriesDelete($auth_token) {
        
          ExpenseCategory::where('auth_token',$auth_token)->delete();
         return back()->with('error','Deleted successfully!');
    }
 
    public function estimates(Request $request){
        
        $page_name="Estimates";
        $type='all';
 


            $data=$request->input();
          $estimates=Estimate::where('estimates.company_id',Auth::user()->company_id)->where('estimates.is_delete','!=',1)
                    ->orderBy('estimates.id','DESC')
                   ->leftJoin('customers', 'customers.id', '=', 'estimates.customer_id');
         // if(isset($data['search']) && $data['search']!=''){
         //       $estimates=$estimates->where(function($q) use($data) {
         //            $q->where('estimates.estimate_number','like', '%'.$data['search'].'%')
         //            ->orWhere('customers.email','like', '%'.$data['search'].'%')
         //            ->orWhere('customers.name', 'like','%'.$data['search'].'%');
         //            });
         // }

        if(isset($data['filter']) && ($data['filter']=='show')){
            if(isset($data['filter_customer_id'])){
              $estimates=$estimates->where('estimates.customer_id', $data['filter_customer_id']);
            }
            if(isset($data['estimate_invoice_number'])){
              $estimates=$estimates->where('estimates.estimate_number', $data['estimate_invoice_number']);
            }

            if(isset($data['filter_status'])){
              $estimates=$estimates->where('estimates.status', $data['filter_status']);
            }

            if(isset($data['filter_date_range'])){
              $filter_date_range=explode(' / ', $data['filter_date_range'])  ;  
                  
                   $from= $this->mmDDDyyyy_to_yyyymmDD($filter_date_range['0'])    ;    
                   $to =$this->mmDDDyyyy_to_yyyymmDD($filter_date_range['1'])    ;  

                   $estimates=$estimates->whereBetween('estimates.due_date', [$from, $to]);
             }
        }


         $estimates=$estimates->select('customers.name','estimates.estimate_number','estimates.*')->paginate(10);
         $subscriptionStatus=$this->shopAdminSubcriptionStatusCheck();
        return view('shop-admin.estimates', compact('page_name','estimates','type','subscriptionStatus'));
    }



 

    public function estimatesDelete($auth_token){
      

        $estimate=Estimate::where('company_id',Auth::user()->company_id)->where('auth_token',$auth_token)->first();
        EstimateItem::where('estimate_id',$estimate->id)->delete();
        Estimate::where('company_id',Auth::user()->company_id)->where('auth_token',$auth_token)->delete();
      return redirect('estimates')->with('success','Estimate deleted successfully');
      }

      public function estimatesSend($auth_token){
        
      Estimate::where('auth_token',$auth_token)->update(['status'=>'SENT']);
      return redirect('estimates')->with('success','Estimate successfully sent!');

      }

      public function estimatesConvertToInvoice($auth_token){
          
      $estimate=Estimate::where('company_id',Auth::user()->company_id)->where('auth_token',$auth_token)->first();
      //print_r($estimate);
      $invoiceData= [
            'invoice_date'=>$estimate->estimate_date,
            'due_date'=>$estimate->due_date,
            'invoice_number'=>$estimate->estimate_number,
            
            'discount_type'=>$estimate->discount_type,
            'discount'=>$estimate->discount,
            'discount_val'=>$estimate->discount_val,
            'sub_total'=>$estimate->sub_total,
            'total'=>$estimate->total,
            'due_amount'=>$estimate->total,
            'auth_token'=>$auth_token,
            'company_id'=>$estimate->company_id,
            'customer_id'=>$estimate->customer_id
        ];
        $invoice=Invoice::create($invoiceData);
        if(isset($invoice)){
                $EstimateItems=EstimateItem::where('estimate_id',$estimate->id)->get();
                 foreach ($EstimateItems as $key => $EstimateItem) {
                          $invoiceItemData=[
                            'item_id'=>$EstimateItem->item_id,
                            'quantity'=>$EstimateItem->quantity,
                            'price'=>$EstimateItem->price,
                            'total'=>$EstimateItem->total,
                            'name'=>$EstimateItem->name,
                            'invoice_id'=>$invoice->id,
                            'company_id'=>$estimate->company_id
                          ];
                          InvoiceItem::create($invoiceItemData);
                 }
           
            }


            EstimateItem::where('estimate_id',$estimate->id)->delete();
            Estimate::where('company_id',Auth::user()->company_id)->where('auth_token',$auth_token)->delete();

          return redirect('invoices')->with('success','Estimate Convert Invoice successfully');
      }

        public function estimatesMarkAsSent($auth_token){
            
          Estimate::where('auth_token',$auth_token)->update(['status'=>'SENT']);
          return redirect('estimates')->with('success','Estimate successfully sent!');

        }
        public function estimatesMarkAsAccepted($auth_token){
            
          Estimate::where('auth_token',$auth_token)->update(['status'=>'ACCEPTED']);
          return redirect('estimates')->with('success','Estimate marked as  ACCEPTED!');

        }
        public function estimatesMarkAsRejected($auth_token){
           
          Estimate::where('auth_token',$auth_token)->update(['status'=>'REJECTED']);
          return redirect('estimates')->with('success','Estimate marked as  REJECTED!');

        }




      public function estimatesView($auth_token){
       
        $page_name="Estimates";
        $type='all';
        $estimates = Estimate::where('company_id',Auth::user()->company_id)->where('is_delete','!=',1)->orderBy('id','DESC')->paginate(10);
        
        $selected_estimate=Estimate::where('company_id',Auth::user()->company_id)->where('auth_token',$auth_token)->orderBy('id','DESC')->first();
        return view('shop-admin.estimates-view', compact('page_name','estimates','type','selected_estimate'));
    }

        public function estimatesSent(Request $request){
         
        $page_name="Estimates";
        $type='sents';
        $data=$request->input();

          $estimates=Estimate::where('estimates.company_id',Auth::user()->company_id)->where('estimates.status','SENT')->where('estimates.is_delete','!=',1)
                    ->orderBy('estimates.id','DESC')
                   ->leftJoin('customers', 'customers.id', '=', 'estimates.customer_id');
         // if(isset($data['search']) && $data['search']!=''){
         //       $estimates=$estimates->where(function($q) use($data) {
         //            $q->where('estimates.estimate_number','like', '%'.$data['search'].'%')
         //            ->orWhere('customers.email','like', '%'.$data['search'].'%')
         //            ->orWhere('customers.name', 'like','%'.$data['search'].'%');
         //            });
         // }

        if(isset($data['filter']) && ($data['filter']=='show')){
            if(isset($data['filter_customer_id'])){
              $estimates=$estimates->where('estimates.customer_id', $data['filter_customer_id']);
            }
            if(isset($data['estimate_invoice_number'])){
              $estimates=$estimates->where('estimates.estimate_number', $data['estimate_invoice_number']);
            }

            if(isset($data['filter_status'])){
              $estimates=$estimates->where('estimates.status', $data['filter_status']);
            }

            if(isset($data['filter_date_range'])){
              $filter_date_range=explode(' / ', $data['filter_date_range'])  ;  
                     
                   $from= $this->mmDDDyyyy_to_yyyymmDD($filter_date_range['0'])    ;    
                   $to =$this->mmDDDyyyy_to_yyyymmDD($filter_date_range['1'])    ;  

                   $estimates=$estimates->whereBetween('estimates.due_date', [$from, $to]);
             }
        }


         $estimates=$estimates->select('customers.name','estimates.estimate_number','estimates.*')->paginate(10);

        $subscriptionStatus=$this->shopAdminSubcriptionStatusCheck();
        return view('shop-admin.estimates', compact('page_name','estimates','type','subscriptionStatus'));
    }


      public function estimatesDrafts(Request $request){
          
        $page_name="Estimates";
        $type='drafts';
                  $estimates=Estimate::where('estimates.company_id',Auth::user()->company_id)->where('estimates.status','DRAFT')->where('estimates.is_delete','!=',1)
                    ->orderBy('estimates.id','DESC')
                   ->leftJoin('customers', 'customers.id', '=', 'estimates.customer_id');
         // if(isset($data['search']) && $data['search']!=''){
         //       $estimates=$estimates->where(function($q) use($data) {
         //            $q->where('estimates.estimate_number','like', '%'.$data['search'].'%')
         //            ->orWhere('customers.email','like', '%'.$data['search'].'%')
         //            ->orWhere('customers.name', 'like','%'.$data['search'].'%');
         //            });
         // }

        if(isset($data['filter']) && ($data['filter']=='show')){
            if(isset($data['filter_customer_id'])){
              $estimates=$estimates->where('estimates.customer_id', $data['filter_customer_id']);
            }
            if(isset($data['estimate_invoice_number'])){
              $estimates=$estimates->where('estimates.estimate_number', $data['estimate_invoice_number']);
            }

            if(isset($data['filter_status'])){
              $estimates=$estimates->where('estimates.status', $data['filter_status']);
            }

            if(isset($data['filter_date_range'])){
              $filter_date_range=explode(' / ', $data['filter_date_range'])  ;  
                   $from= $this->mmDDDyyyy_to_yyyymmDD($filter_date_range['0'])    ;    
                   $to =$this->mmDDDyyyy_to_yyyymmDD($filter_date_range['1'])    ;   
                   $estimates=$estimates->whereBetween('estimates.due_date', [$from, $to]);
             }
        }

         $estimates=$estimates->select('customers.name','estimates.estimate_number','estimates.*')->paginate(10);
         $subscriptionStatus=$this->shopAdminSubcriptionStatusCheck();
        return view('shop-admin.estimates', compact('page_name','estimates','type','subscriptionStatus'));
    }  




   public function estimatesNew(Request $request){
   $subscriptionStatus=$this->shopAdminSubcriptionStatusCheck();
   if(!$subscriptionStatus['status']){ return redirect('/'); }
        $data=  $request->input();
        if(count($data)){
        $this->validate($request, [
        'estimate_date' => 'required',
        'due_date' => 'required',
        'estimate_number' => 'required',
        'customer_id' => 'required',
        'sub_total' => 'required',
        'total' => 'required',
        ]);


 
         $data['estimate_date']=$this->mmDDDyyyy_to_yyyymmDD($data['estimate_date'])    ;    
        $data['due_date']=$this->mmDDDyyyy_to_yyyymmDD($data['due_date'])    ;  
   
        $estimate_date=date('Y-m-d',strtotime($data['estimate_date']) );
        $due_date=date('Y-m-d',strtotime($data['due_date']) );
        $estimate_number=isset($data['estimate_number'])?$data['estimate_number']:'';
        $customer_id=isset($data['customer_id'])?$data['customer_id']:'';
        $sub_total=isset($data['sub_total'])?$data['sub_total']:'';
        $discount=isset($data['discount'])?$data['discount']:'';
        $discount_type=isset($data['discount_type'])?$data['discount_type']:'';
        $discount_val=isset($data['discount_val'])?$data['discount_val']:'';
        $total_tax=isset($data['total_tax'])?$data['total_tax']:'0';
        $tax=isset($data['tax'])?$data['tax']:[];
        
        if($discount<=0){  $discount_type=''; $discount_val='0'; }
        if(!$discount){ $discount_type=''; $discount_val='0'; }


        $total=isset($data['total'])?$data['total']:'';
        $notes=isset($data['notes'])?$data['notes']:'';
        

        $estimateData= [
            'estimate_date'=>$estimate_date,
            'due_date'=>$due_date,
            'estimate_number'=>$estimate_number,
             'notes'=>$notes,
            'discount_type'=>$discount_type,
            'discount'=>$discount,
            'discount_val'=>$discount_val,
            'sub_total'=>$sub_total,
            'total'=>$total,
            'total_tax'=>$total_tax,
             'auth_token'=>$this->createUniqueId(),
            'company_id'=>Auth::user()->company_id,
            'customer_id'=>$customer_id
        ];
        $estimate=Estimate::create($estimateData);
            if(isset($estimate)){
                $item_ids =isset($data['item_id'])?$data['item_id']:[];
                $quantities =isset($data['quantity'])? $data['quantity']:[];
                $prices =isset($data['price'])?$data['price']:[];
                $note_id =isset($data['note_id'])?$data['note_id']:[];

                foreach ($item_ids as $key => $value) {
                          $item_id =  $item_ids[$key];
                          $quantity =  $quantities[$key];
                          $price =  $prices[$key];
                          $notes =  $note_id[$key];

                          $EstimateItem=Item::where('id',$item_id)->first();
                          $invoiceItemData=[
                            'item_id'=>$item_id,
                            'quantity'=>$quantity,
                            'price'=>$price,
                            'total'=>($quantity*$price),
                            'name'=>$EstimateItem->name,
                            'estimate_id'=>$estimate->id,
                            'notes'=>$notes,
                            'company_id'=>Auth::user()->company_id
                          ];
                          EstimateItem::create($invoiceItemData);
                 }


                foreach ($tax as $tax_id => $tax_amount) {
                        $TaxData=Tax::where('id',$tax_id)->first();
                        Estimate_tax::create([
                            'tax_id'=>$tax_id,
                            'percent'=>$TaxData->percent, 
                            'name'=>$TaxData->name, 
                            'tax_amount'=>$tax_amount, 
                            'estimate_id'=>$estimate->id, 
                            'company_id'=>Auth::user()->company_id
                          ]);
                }


            }


          return redirect('estimates')->with('success','Invoice successfully added!');

        }

    
        $page_name="New Estimate";

        $estimate_number=  $this->generateUniqueEstimateId();
        return view('shop-admin.estimates-new', compact('page_name','estimate_number'));

      }


    public function estimateEdit(Request $request,$auth_token){
     
        $data=  $request->input();
        if(count($data)){
        $this->validate($request, [
        'estimate_date' => 'required',
        'estimate_number' => 'required',
        'customer_id' => 'required',
        'sub_total' => 'required',
        'total' => 'required',
        ]);
   
   
        $data['estimate_date']=$this->mmDDDyyyy_to_yyyymmDD($data['estimate_date'])    ;    
        $data['due_date']=$this->mmDDDyyyy_to_yyyymmDD($data['due_date'])    ;   
        $estimate_date=date('Y-m-d',strtotime($data['estimate_date']) );
        $due_date=date('Y-m-d',strtotime($data['due_date']) );
        $estimate_number=isset($data['estimate_number'])?$data['estimate_number']:'';
        $customer_id=isset($data['customer_id'])?$data['customer_id']:'';
        $sub_total=isset($data['sub_total'])?$data['sub_total']:'';
        $discount=isset($data['discount'])?$data['discount']:'';
        $discount_type=isset($data['discount_type'])?$data['discount_type']:'';
        $discount_val=isset($data['discount_val'])?$data['discount_val']:'';
        $total_tax=isset($data['total_tax'])?$data['total_tax']:'0';
        $tax=isset($data['tax'])?$data['tax']:[];

        if($discount<=0){  $discount_type=''; $discount_val='0'; }
        if(!$discount){ $discount_type=''; $discount_val='0'; }


        $total=isset($data['total'])?$data['total']:'';
        $notes=isset($data['notes'])?$data['notes']:'';
        

        $estimateData= [
            'estimate_date'=>$estimate_date,
            'due_date'=>$due_date,
            'estimate_number'=>$estimate_number,
            'notes'=>$notes,
            'discount_type'=>$discount_type,
            'discount'=>$discount,
            'discount_val'=>$discount_val,
            'sub_total'=>$sub_total,
            'total_tax'=>$total_tax,
            'total'=>$total,
            'customer_id'=>$customer_id
        ];
        Estimate::where('auth_token',$auth_token)->update($estimateData);
        $estimate=Estimate::where('auth_token',$auth_token)->first();
            if(isset($estimate)){
                EstimateItem::where('estimate_id',$estimate->id)->delete();
                $item_ids =isset($data['item_id'])?$data['item_id']:[];
                $quantities =isset($data['quantity'])? $data['quantity']:[];
                $prices =isset($data['price'])?$data['price']:[];
                $note_id =isset($data['note_id'])?$data['note_id']:[];

                foreach ($item_ids as $key => $value) {
                          $item_id =  $item_ids[$key];
                          $quantity =  $quantities[$key];
                          $price =  $prices[$key];
                          $notes =  $note_id[$key];

                          $invoiceItem=Item::where('id',$item_id)->first();
                          $invoiceItemData=[
                            'item_id'=>$item_id,
                            'quantity'=>$quantity,
                            'price'=>$price,
                            'total'=>($quantity*$price),
                            'name'=>$invoiceItem->name,
                            'estimate_id'=>$estimate->id,
                            'company_id'=>Auth::user()->company_id,
                            'notes'=> $notes,
                          ];
                          EstimateItem::create($invoiceItemData);
                 }

                  Estimate_tax::where('estimate_id',$estimate->id)->delete();
                 foreach ($tax as $tax_id => $tax_amount) {
                        $TaxData=Tax::where('id',$tax_id)->first();
                        Estimate_tax::create([
                            'tax_id'=>$tax_id,
                            'percent'=>$TaxData->percent, 
                            'name'=>$TaxData->name, 
                            'tax_amount'=>$tax_amount, 
                            'estimate_id'=>$estimate->id, 
                            'company_id'=>Auth::user()->company_id
                          ]);
                }

            }

                        return redirect('estimates')->with('success','Estimate successfully updated!');
        }


        $estimate=Estimate::where('auth_token',$auth_token)->first();
        $customer = Customer::where('id',$estimate->customer_id)->first();
        $estimateItems=EstimateItem::where('estimate_id',$estimate->id)->get();
        $Estimate_tax=Estimate_tax::select('tax_id as id', 'estimate_id' ,'name', 'percent','tax_amount')->where('estimate_id', $estimate->id)->get();
        $Tax=Tax::get();

        $page_name=" Edit Estimate";
        return view('shop-admin.estimates-edit', compact('page_name','customer','estimate','estimateItems','Estimate_tax','Tax'));
    }


   public function payments(){
    
    $page_name="Payment";
        $payments = Payment::where('payments.company_id',Auth::user()->company_id)
        ->leftJoin('customers', 'customers.id', '=', 'payments.customer_id')
        ->leftJoin('invoices', 'invoices.id', '=', 'payments.invoice_id')
        ->select('customers.name','invoices.invoice_number','payments.*')
        ->orderBy('payments.id','DESC')->paginate(10);
        //print_r($payments);
        return view('shop-admin.payments', compact('page_name','payments'));
   }


   public function paymentsNew(Request $request,$auth_token=''){
    
  $page_name="Payment";
  $customer=[];
  $invoice=[];
   if($auth_token !=''){
       $invoice = Invoice::where('auth_token',$auth_token)->first();
       $customer = Customer::where('id',$invoice->customer_id)->first();
   }


        $data=$request->input();
         
         if(count($data)){
            $this->validate($request, [
            'payment_number' => 'required',
            'payment_date' => 'required',
             'amount'=>'required',
            'customer_id'=>'required',
            'invoice_id'=>'required',
            'payment_method_id'=>'required'
            
             ]);


            $invoice=Invoice::where('id',$data['invoice_id'])->where('customer_id',$data['customer_id'])->first();
            if(isset($invoice->due_amount) && ($data['amount']> $invoice->due_amount)){
                          return back()->with('error','amount must be less or equal to due amount !');
            }
 
            $data['payment_date']= $this->mmDDDyyyy_to_yyyymmDD($data['payment_date']);   


            $payment=Payment::create([
                'payment_number' => $data['payment_number'],
                 'payment_date' => date('Y-m-d',strtotime($data['payment_date'])),
                 'notes'=>$data['notes'],
                 'amount'=>$data['amount'],
                 'customer_id'=>$data['customer_id'],
                'invoice_id'=>$data['invoice_id'],
                 'payment_method_id'=>$data['payment_method_id'],
                'auth_token'=> $this->createUniqueId(),
                'company_id' => Auth::user()->company_id,
                
             ]);


             $remainAmount= $invoice->due_amount - $payment->amount;
             $paid_status='';
             $status=$invoice->status;
             if($remainAmount>0){ $paid_status='PARTIALLY PAID'; }else{ $paid_status='PAID'; $status='COMPLETED'; }


    
             Invoice::where('id',$data['invoice_id'])->where('customer_id',$data['customer_id'])->update(['due_amount'=>$remainAmount,'paid_status'=>$paid_status, 'status'=>$status]);

            return redirect('payments')->with('success','Payment successfully Added!');
          }
        $payment_id=$this->generateUniquePaymentId();
        $PaymentMethods=PaymentMethod::where('company_id',Auth::user()->company_id)->get();
        return view('shop-admin.payments-new', compact('page_name','customer','invoice','payment_id','PaymentMethods'));
    }


   public function paymentsEdit(Request $request,$auth_token){
    
         $payment = Payment::where('auth_token', $auth_token)->first();
         $invoice = Invoice::where('id',$payment->invoice_id)->first();
         $customer = Customer::where('id',$invoice->customer_id)->first();

         $data=$request->input();
         if(count($data)){
            $this->validate($request, [
              'payment_number' => 'required',
            'payment_date' => 'required',
             'amount'=>'required',
            'customer_id'=>'required',
            'invoice_id'=>'required',
            'payment_method_id'=>'required'
               ]);

             $total_due_amount= $invoice->due_amount + $payment->amount;
             if($data['amount']> $total_due_amount){
                          return back()->with('error','amount must be less or equal to due amount !');
            }


            $data['payment_date']= $this->mmDDDyyyy_to_yyyymmDD($data['payment_date']); 



            Payment::where('auth_token',$auth_token)
                  ->update([
                     'payment_number' => $data['payment_number'],
                 'payment_date' => date('Y-m-d',strtotime($data['payment_date'])),
                 'notes'=>$data['notes'],
                 'amount'=>$data['amount'],
                 'customer_id'=>$data['customer_id'],
                'invoice_id'=>$data['invoice_id'],
                 'payment_method_id'=>$data['payment_method_id']
                
                     
                  ]); 


             $remainAmount= $total_due_amount -$data['amount'];
             $paid_status='';
             $status=$invoice->status;
             if($remainAmount>0){ $paid_status='PARTIALLY PAID'; }else{ $paid_status='PAID'; $status='COMPLETED'; }

              Invoice::where('id',$invoice->id)->where('customer_id',$payment->customer_id)->update(['due_amount'=>$remainAmount,'paid_status'=>$paid_status, 'status'=>$status]);


            return back()->with('success','Payment successfully Updated!');
          }

        $page_name="Edit Payment";
        $payment = Payment::where('auth_token', $auth_token)->first();
        $PaymentMethods=PaymentMethod::where('company_id',Auth::user()->company_id)->get();
        return view('shop-admin.payments-edit', compact('page_name','payment','invoice','customer','PaymentMethods'));
    }

 public function paymentsDelete($auth_token) {
    
         $payment = Payment::where('auth_token', $auth_token)->first();
         $invoice = Invoice::where('id',$payment->invoice_id)->first();
         $customer = Customer::where('id',$invoice->customer_id)->first();
         $total_due_amount= $invoice->due_amount + $payment->amount;

         if($total_due_amount== $invoice->due_amount){
          $paid_status='UNPAID';
          $status="COMPLETED";
         }else{
          $paid_status='PARTIALLY PAID';
          $status="SENT";
         }
        Invoice::where('id',$invoice->id)->where('customer_id',$payment->customer_id)->update(['due_amount'=>$total_due_amount,'paid_status'=>$paid_status, 'status'=>$status]);


         Payment::where('auth_token',$auth_token)->delete();
         return back()->with('error','Deleted successfully!');
       }


     public function paymentsView(Request $request, $auth_token){
      
        $page_name="Payments";
        $payments = Payment::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->paginate(10);
        $selected_payment=Payment::where('company_id',Auth::user()->company_id)->where('auth_token',$auth_token)->first();
        return view('shop-admin.payments-view', compact('page_name','payments','selected_payment'));


     }


      public function companyinfos(Request $request){
       
         // print_r('hello');
      $data=$request->input();
      $company = Company::where('id',Auth::user()->company_id)->first();

         if(count($data)){
         // print_r($data);
            $this->validate($request, [
              'name' => 'required',
            'phone' => 'required',
           'country' => 'required',
           'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
               ]);
            if ($request->has('logo')) {
                $image = $request->file('logo');

               $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

              $destinationPath = public_path('/companyLogo');

              $image->move($destinationPath, $input['imagename']);
            }
           // $authtoken = Auth::user()->auth_token;
           // print_r($authtoken); die;
          $res =  Company::where('id',Auth::user()->company_id)
                  ->update([
                     'name' => $data['name'],
                 'phone' => $data['phone'],
                 'country'=>$data['country'],
                 'city'=>$data['city'],
                 'state'=>$data['state'],
                'zip'=>$data['zip'],
                 'address'=>$data['address'],
                 'address1'=>$data['address1'],
                 'logo' => $input['imagename'],
                // 'auth_token'=> $authtoken,
                  ]); 
            // print_r($res); die;
            return back()->with('success','Company successfully Updated!');
          }

        $page_name="Edit Company";
       // $payment = Company::where('auth_token', Auth::user()->auth_token)->first();
 
      return view('shop-admin.company-infos', compact('page_name','company'));
    }

     public function taxtypes(){
      
        $page_name="Tax Type";
        $taxtypes = Tax::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->paginate(10);
        return view('shop-admin.tax-types', compact('page_name','taxtypes'));
    }

    public function taxtypesNew(Request $request){
     // echo "hello"; die;
    $page_name="Tax";

        $data=$request->input();
        //print_r($data); die;
         if(count($data)){
            $this->validate($request, [
            'name' => 'required',
            'percent' => 'required',
            'description' => 'required',
           
            
             ]);
            Tax::create([
                'name' => $data['name'],
                 'percent'=>$data['percent'],
                 'description'=>$data['description'],
                'company_id' => Auth::user()->company_id,
                
             ]); 


            return redirect('tax-types')->with('success','Tax successfully Added!');
          }
        
        return view('shop-admin.tax-types-new', compact('page_name'));
    }



   public function taxtypesEdit(Request $request){
   
     // print_r('hello');
  $data=$request->input();
  $tax = Tax::where('company_id',Auth::user()->company_id)->first();

         if(count($data)){
         // print_r($data);
            $this->validate($request, [
            'name' => 'required',
            'percent' => 'required',
            'description' => 'required',
           
               ]);
           
           // $authtoken = Auth::user()->auth_token;
           // print_r($authtoken); die;
          $res =  Tax::where('id',$tax->id)
                  ->update([
                   'name' => $data['name'],
                 'percent'=>$data['percent'],
                 'description'=>$data['description'],
                //'company_id' => Auth::user()->company_id,
                // 'auth_token'=> $authtoken,
                  ]); 
            // print_r($res); die;
            return back()->with('success','Tax Type successfully Updated!');
          }

        $page_name="Edit Tax Type";
       // $payment = Company::where('auth_token', Auth::user()->auth_token)->first();
 
      return view('shop-admin.tax-types-edit', compact('page_name','tax'));
   }




public function taxtypesDelete($id){
    

 Tax::where('id',$id)->delete();
         return back()->with('error','Deleted successfully!');
}



public  function generateUniqueInvoiceId(){

   $invoice_number_count=   Invoice::where('company_id', Auth::user()->company_id)->count() +1;
    $j=99999999999999999;
    $invoiceNumber='';
    for ($i=$invoice_number_count; $i<$j ; $i++) { 
        $invoiceNumber='INV'.str_pad($i, 8, '0', STR_PAD_LEFT);
    	$check=Invoice::where('company_id', Auth::user()->id)->where('invoice_number', $invoiceNumber)->first();
    	if(!isset($check->id)) { $j=0;	}
    }
    return $invoiceNumber;
}

public  function generateUniqueEstimateId(){
   $estimate_number_count=   Estimate::where('company_id', Auth::user()->company_id)->count() +1;
    $j=99999999999999999;
    $estimate_number='';
    for ($i=$estimate_number_count; $i<$j ; $i++) { 
        $estimate_number='EST'.str_pad($i, 8, '0', STR_PAD_LEFT);
    	$check=Estimate::where('company_id', Auth::user()->id)->where('estimate_number', $estimate_number)->first();
    	if(!isset($check->id)) { $j=0;	}
    }
    return $estimate_number;
}

public  function generateUniquePaymentId(){
   $pay_number_count=   Payment::where('company_id', Auth::user()->company_id)->count() +1;
    $j=99999999999999999;
    $payment_number='';
    for ($i=$pay_number_count; $i<$j ; $i++) { 
        $payment_number='PAY'.str_pad($i, 8, '0', STR_PAD_LEFT);
      $check=Payment::where('company_id', Auth::user()->id)->where('payment_number', $payment_number)->first();
      if(!isset($check->id)) { $j=0;  }
    }
    return $payment_number;
}


 
public function paymentMethods(){
    
  $page_name="Payment Methods";
        $PaymentMethods = PaymentMethod::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->paginate(10);
        return view('shop-admin.paymentMethodes', compact('page_name','PaymentMethods'));
}

public function paymentMethodNew(Request $request){
 
  $page_name="New payment Method";

        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            'name' => 'required',
             ]);
            PaymentMethod::create([
                'name' => $data['name'],
                'auth_token'=> $this->createUniqueId(),
                'company_id' => Auth::user()->company_id,
                
             ]); 


            return redirect('payment-methods')->with('success','paymentMethod successfully Added!');
          }
        
        return view('shop-admin.paymentMethodes-new', compact('page_name'));
}

public function paymentMethodEdit(Request $request,$auth_token){
 
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
             'name' => 'required',
               ]);
            paymentMethod::where('auth_token',$auth_token)
                  ->update([
                     'name' => $data['name'],
                     'company_id' => Auth::user()->company_id
                  ]); 
            return back()->with('success','paymentMethod successfully Updated!');
          }

        $page_name="Edit payment Method";
        $paymentMethod = paymentMethod::where('auth_token', $auth_token)->first();
 
        return view('shop-admin.paymentMethodes-edit', compact('page_name','paymentMethod'));
    }

     public function paymentMethodDelete($auth_token) {
         paymentMethod::where('auth_token',$auth_token)->delete();
         return back()->with('error','Deleted successfully!');
    }



public function pdfview(Request $request){
	$page_name="Invoices";
	$invoices=Invoice::where('company_id',Auth::user()->company_id)->orderBy('id','DESC')->get();
       
	//$items = DB::table("items")->get();
        view()->share('invoices',$invoices);


        if($request->has('download')){
            $pdf = PDF::loadView('pdfview');
            return $pdf->download('pdfview.pdf');
        }


       // return view('pdfview');
         return view('shop-admin.pdfview', compact('page_name','invoices'));
    }


public function addTask(Request $request){
   $data= $request->input();
   $task=Task::create(['task'=>$data['task'], 'company_id'=>Auth::user()->company_id]);
   return response()->json([
                'message' => 'successfully created',
                'data' => $task,
                'isError' => false,
                'responseCode'=>200
            ], 200);
}

public function addTaskComplete(Request $request){
   $data= $request->input();
   $task=Task::where('id', $data['id'])->update(['status'=>'Completed']);
   $task=Task::where('id', $data['id'])->first();
   return response()->json([
                'message' => 'successfully updated',
                'data' => $task,
                'isError' => false,
                'responseCode'=>200
            ], 200);
}


public function addTaskDelete(Request $request){
   $data= $request->input();
   $task=Task::where('id', $data['id'])->delete();
    return response()->json([
                'message' => 'successfully deleted',
                'data' => $task,
                'isError' => false,
                'responseCode'=>200
            ], 200);
}


 

public function stripPay(Request $request){
   $data= $request->input();
   $token=$data['reservation']['stripe_token'];
   $msg='';      
try {
         \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
           $customer = \Stripe\Customer::create([
                'name' => Auth::user()->name,
                'email' =>Auth::user()->email, 
                'source'  => $token,
              ]);  
 
            $subscription = \Stripe\Subscription::create(array( 
                "customer" => $customer->id, 
                "enable_incomplete_payments"=>true,
                "items" => array( 
                    array( 
                        "plan" =>  'price_1H554MHLI4kSRYrc9Wzhr3bw', 
                    ), 
                ), 
            ));



    if($subscription->status=='incomplete'){ 
                $msg='You successfully upgraded your account, But payment is still not complete, Please Authenticate your card or use another card';
                return response()->json([
                    'message' =>  $msg,
                    'data' =>false,
                    'isError' => true,
                    'responseCode'=>201
                ], 200);
    }

    


 

} catch(\Stripe\Error\Card $e) {
     $body = $e->getJsonBody();
      $err  = $body['error'];
       return response()->json([
                    'message' => $err['message'],
                    'data' =>false,
                    'isError' => true,
                    'responseCode'=>201
                ], 200);
} catch (\Stripe\Error\InvalidRequest $e) {
     $body = $e->getJsonBody();
      $err  = $body['error'];
       return response()->json([
                    'message' => $err['message'],
                    'data' =>false,
                    'isError' => true,
                    'responseCode'=>201
                ], 200);
} catch (\Stripe\Error\Authentication $e) {
      $body = $e->getJsonBody();
      $err  = $body['error'];
       return response()->json([
                    'message' => $err['message'],
                    'data' =>false,
                    'isError' => true,
                    'responseCode'=>201
                ], 200);
} catch (\Stripe\Error\ApiConnection $e) {
      $body = $e->getJsonBody();
      $err  = $body['error'];
       return response()->json([
                    'message' => $err['message'],
                    'data' =>false,
                    'isError' => true,
                    'responseCode'=>201
                ], 200);
} catch (\Stripe\Error\Base $e) {
      $body = $e->getJsonBody();
      $err  = $body['error'];
       return response()->json([
                    'message' => $err['message'],
                    'data' =>false,
                    'isError' => true,
                    'responseCode'=>201
                ], 200);
}catch (\Stripe\Exception\CardException $e) {
      $body = $e->getJsonBody();
      $err  = $body['error'];
       return response()->json([
                    'message' => $err['message'],
                    'data' =>false,
                    'isError' => true,
                    'responseCode'=>201
                ], 200);

} catch (Exception $e) {
     $body = $e->getJsonBody();
      $err  = $body['error'];
       return response()->json([
                    'message' => $err['message'],
                    'data' =>false,
                    'isError' => true,
                    'responseCode'=>201
                ], 200);
}



 
 





    if(isset($customer->id) && isset($subscription->id)){


       User::where('id',Auth::user()->id)->update(['subscription_status'=>'ACTIVE','stripe_customer_id'=>$customer->id,'stripe_subscription_id'=>$subscription->id]);
    return response()->json([
                    'message' => 'Payment successfull',
                    'data' => true,
                    'isError' => true,
                    'responseCode'=>200
                ], 200);
  }else{
    return response()->json([
                    'message' => 'Sorry, Payment has been failed, please try again.',
                    'data' =>false,
                    'isError' => true,
                    'responseCode'=>201
                ], 200);
    }
  }



 public function mmDDDyyyy_to_yyyymmDD($date){
          $res = explode("/", $date);
          return $res[2]."-".$res[0]."-".$res[1];
 } 

 public function cancelSubcription(){
                  \Stripe\Stripe::setApiKey('sk_test_3XRQ95xkBL4tKqn81hZkkm0e');
                  $customer = \Stripe\Customer::retrieve(Auth::user()->stripe_customer_id);
                  $subscription = $customer->subscriptions->retrieve(Auth::user()->stripe_subscription_id);
                  $subscription=$subscription->delete();

                 $user=User::where('id', Auth::user()->id)->first();

                 Mail::send('emails.cancel-subscription', ['user' => $user], function ($m) use ($user) {
                  $m->to(Auth::user()->email, $user->name)->subject('Account Cancelation Notification');
                 });
                 




//////////////////////////////////////////////////////
                     $MailChimp = new MailChimp(env('MAILCHIMP_KEY'));
                     
                     $subscriber_hash = MailChimp::subscriberHash(Auth::user()->email);
                      if(Auth::user()->industry==6){
                      // Auto Detailer
                        $list_id=env('MAILCHIMP_LIST_AUTO_DETAILER_ID');
                            $result=$MailChimp->post("lists/$list_id/members/$subscriber_hash/tags", [
                                 'tags' => [ ['name'=>'cancelled','status' => 'active'],['name'=>'Upgraded','status' => 'inactive'] ]
                            ]);
                      }
                      if(Auth::user()->industry==8){
                      // Automotive Repair
                          $list_id=env('MAILCHIMP_LIST_AUTO_TECHNICIAN_ID');
                          $result=$MailChimp->post("lists/$list_id/members/$subscriber_hash/tags", [
                              'tags' => [ ['name'=>'cancelled','status' => 'active'],['name'=>'Upgraded','status' => 'inactive'] ]
                          ]);
                      }

///////////////////////////////////////////////////////
                 
                 User::where('id',Auth::user()->id)->update(['subscription_status'=>'NOT_ACTIVE']);
               return redirect('/');
 }

}
