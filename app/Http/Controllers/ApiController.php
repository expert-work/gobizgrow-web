<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Industry;
use App\Customer;
use App\Item;
use App\Unit;
use App\Expense;
use App\Category;
use App\ExpenseCategory;
use App\Invoice;
use App\Item_category;
use App\Payment;
use App\InvoiceItem;
use App\Estimate;
use App\EstimateItem;
use App\InvoiceImage;
use App\PaymentMethod;
use App\Company;
use App\Task;
use App\Tax;
use App\Vehicle;

use PDF;
use Mail;
use PDO;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Auth;
class ApiController extends Controller{
	use SendsPasswordResetEmails;

	/**
	 * Create a new controller instance.
	 */
	public function __construct(){
		//$this->middleware('guest');
	}





	public function RegistersUsers(Request $request){
                $data=$request->input();
                $validator =  Validator::make($request->all(),[
				    'name' => ['required', 'string', 'max:255'],
					'industry' => ['required', 'string', 'max:255'],
					'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
					'password' => ['required', 'string', 'min:8'],
				    ]);
				    if($validator->fails()){
				        return response()->json([
				            'message' => 'validation_error',
				            'data' => $validator->errors(),
				            'isError' => true,
				            'responseCode'=>201
				        ], 401);
				    }

			       $data= User::create([
			            'name' => $data['name'],
			            'email' => $data['email'],
			            'industry' => $data['industry'],
			            'password' => Hash::make($data['password']),
			            'auth_token'=>Hash::make($data['email'])
			        ]);


			       $user=User::where('id',$data->id)->first();
			        return response()->json([
			            'message' => 'Your Account Successfully Created',
			            'data' => $user,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);	 
	}



	public function LoginUsers(Request $request){
                $data=$request->input();
                $validator =  Validator::make($request->all(),[
					'email' => ['required', 'string', 'email', 'max:255'],
					'password' => ['required', 'string', 'min:8'],
				    ]);
				    if($validator->fails()){
				        return response()->json([
				            'message' => 'validation_error',
				            'data' => $validator->errors(),
				            'isError' => true,
				            'responseCode'=>201
				        ], 401);
				    }
 			        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
 			        	$user=User::where('email',$data['email'])->first();
 			        	if(!isset($user->auth_token)|| $user->auth_token ==''){
                          $auth_token=Hash::make($data['email']);
 			               User::where('email',$data['email'])->update(['auth_token'=>$auth_token]);
 			              $user=User::where('email',$data['email'])->first();
 			        	}
	                    return response()->json([
				            'message' => ' Successfully login',
				            'data' => $user,
				            'isError' => false,
				            'responseCode'=>200
				        ], 200);
			        }else{
 				        return response()->json([
				            'message' => 'validation_error',
				            'data' => ['email'=>['email or password is wrong']],
				            'isError' => true,
				            'responseCode'=>201
				        ], 401);
				     
			        } 			        
	}

	public function resetPassword(Request $request){
		$this->validateEmail($request);
		$response = $this->broker()->sendResetLink(
			$request->only('email')
		);
		return $response == Password::RESET_LINK_SENT
			? response()->json(['message' => 'Please check Reset link sent to your email.', 'isError' => false,'responseCode'=>200], 200)
			: response()->json(['message' => 'Unable to send reset link', 'isError' => true,'responseCode'=>201], 401);
	}


      public function industries(){
                 $data=Industry::where('status','1')->select('id as value','industry_name as label')->get();
                      return response()->json([
				            'message' => ' Successfully login',
				            'data' => $data,
				            'isError' => false,
				            'responseCode'=>200
				        ], 200);   
      }

      public  function createUniqueId( $delimiter = '-'){
    $str= Hash::make(uniqid(time(), true));
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug.uniqid(time(), true);
   }


 public function customersAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

            if($q==''){
              $customer=Customer::where('company_id',$company_id)->where('is_delete','!=','1')->orderBy('id','DESC')->paginate(10);
            }else{
               $customer=Customer::where('company_id',$company_id)->where('is_delete','!=','1')->where('name', 'like', '%'.$q.'%')->orderBy('id','DESC')->paginate(10);

            }
	        
	        return response()->json([
	            'message' => 'All Customer List',
	            'data' => $customer,
	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}

      public function customersAdd(Request $request){
      	 $data=$request->input();
                $validator =  Validator::make($request->all(),[
				    'email' => 'required|email',
                    'name' => 'required',
                    'phone' => 'required|min:10',
                    'company_id' => 'required',
				    ]);
				    if($validator->fails()){
				        return response()->json([
				            'message' => 'validation_error',
				            'data' => $validator->errors(),
				            'isError' => true,
				            'responseCode'=>201
				        ], 401);
				    }

					$data['street_address']= ($data['street_address']=='null')?'':$data['street_address'];
					$data['city']= ($data['city']=='null')?'':$data['city'];
					$data['state']= ($data['state']=='null')?'':$data['state'];
					$data['zip_code']= ($data['zip_code']=='null')?'':$data['zip_code'];
					$data['customer_notes']= ($data['customer_notes']=='null')?'':$data['customer_notes'];

                    $data['vehicles_data']= json_decode($data['vehicles_json_data']);

			       $customer = Customer::create([
		                'name' => $data['name'],
		                'email' => $data['email'],
		                'phone' => $data['phone'],
		                'street_address'=>$data['street_address'], 
		                'city'=>$data['city'], 
		                'state'=>$data['state'], 
		                'zip_code'=>$data['zip_code'], 
		                'customer_notes'=>$data['customer_notes'],
		                'company_id' => $data['company_id'],
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
					            'company_id' => $data['company_id'],
					            'auth_token'=> $this->createUniqueId(),
					            ]);
					   }
					}


           
			        
			        return response()->json([
			            'message' => 'Customer Successfully Created',
			            'data' => $customer,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
      }


   public function customersEdit(Request $request,$auth_token){
    $data=$request->input();
         
           $validator =  Validator::make($request->all(),[
				    'email' => 'required|email',
                    'name' => 'required',
                    'phone' => 'required|min:10',
				    ]);
				    if($validator->fails()){
				        return response()->json([
				            'message' => 'validation_error',
				            'data' => $validator->errors(),
				            'isError' => true,
				            'responseCode'=>201
				        ], 401);
				    }

					$data['street_address']= ($data['street_address']=='null')?'':$data['street_address'];
					$data['city']= ($data['city']=='null')?'':$data['city'];
					$data['state']= ($data['state']=='null')?'':$data['state'];
					$data['zip_code']= ($data['zip_code']=='null')?'':$data['zip_code'];
					$data['customer_notes']= ($data['customer_notes']=='null')?'':$data['customer_notes'];
	    
           $data = Customer::where('auth_token',$auth_token)
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
                 // print_r($data);
          // $customer=Customer::where('id',$data->id)->first();
			        return response()->json([
			            'message' => 'Customer Successfully Updated',
			            'data' => $data,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
   }

    public function customersDelete($auth_token) {
               $data =   Customer::where('auth_token',$auth_token)->delete();
                 return response()->json([
			            'message' => 'Customer Successfully Deleted',
			            'data' => $data,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
        }

  
 public function getItemsAll(Request $request){
$data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $items=Item::where('company_id',$company_id)->orderBy('id','DESC')->get();
            return response()->json([
	            'message' => 'All  List',
	            'data' => $items,
	            'isError' => false,
	            'responseCode'=>200
	        ], 200);


 }
 public function itemAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

            if($q==''){
              $items=Item::where('company_id',$company_id)->orderBy('id','DESC')->paginate(10);
            }else{
               $items=Item::where('company_id',$company_id)->where('name', 'like', '%'.$q.'%')->orderBy('id','DESC')->paginate(10);

            }
	 
	       $itemArry=($items->getCollection());


           $itemsArray=[];
           foreach ($itemArry as $key => $item) {
							$item_categories=[];
							$item_categoriesData=Item_category::where('item_id',$item->id)->get();
							foreach ($item_categoriesData as $key => $value) {
							     $cat=Category::where('id',$value->category_id)->first();
							      $item_categories[]=['id'=>$value->category_id, 'price'=>$value->price,'name'=>$cat->name];
							}
							$item->item_categories= $item_categories;
                   $itemsArray[]=$item;
           }

	        return response()->json([
	            'message' => 'All Items List',
	            'data' => $itemsArray,
	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}  
  
 public function getItemsCategoryPrice(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $item_id= isset($data['item_id'])?$data['item_id']:'';

               $Item_category=Item_category::where('company_id',$company_id)->where('item_id',$item_id)->orderBy('id','DESC')->get()	; 
 
                               
	        return response()->json([
	            'message' => 'All  List',
	            'data' => $Item_category,
	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
} 
 
  
         


    public function itemsNew(Request $request){
      	 $data=$request->input();
                $validator =  Validator::make($request->all(),[
				     'name' => 'required',
                     'description' => 'required',
                     'price' => 'required',
 				    ]);
				    if($validator->fails()){
				        return response()->json([
				            'message' => 'validation_error',
				            'data' => $validator->errors(),
				            'isError' => true,
				            'responseCode'=>201
				        ], 401);
				    }

			        $item= Item::create([
				                'name' => $data['name'],
				                'description' => $data['description'],
				                'price' => $data['price'],
				                'company_id' => $data['company_id'],
				                'auth_token'=> $this->createUniqueId(),
				                'unit' => $data['unit']
				             ]); 

					if(isset($data['category_price'])){
						foreach ($data['category_price'] as $key => $value) {
						 if($value !=''){
						                $d=[
						                'item_id' => $item->id,
						                'category_id' => $key,
						                'price' => $value,
						                'company_id' => $data['company_id'],

						                ];
						                Item_category::create($d);
						 }
						}
					}

 			        return response()->json([
			            'message' => 'Item Successfully Created',
			            'data' => $item,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
      }

		public function itemsAdd(Request $request){
		    	$data=$request->input();

		                   $validator =  Validator::make($request->all(),[
							'name' => 'required',
							'price' => 'required',
 							'company_id'=> 'required'
							]);

							if($validator->fails()){
							return response()->json([
							'message' => 'validation_error',
							'data' => $validator->errors(),
							'isError' => true,
							'responseCode'=>201
							], 401);
							}

 
                            $data['items_categories']= isset($data['items_categories'])?$data['items_categories']:json_encode([]);
                            $data['items_categories']= json_decode($data['items_categories']);

 				          $item=  Item::create([
				                'name' => $data['name'],
				                'price' => $data['price'],
				                'description' => $data['description'],
 		 		                'company_id' => $data['company_id'],
				                'auth_token'=>  $this->createUniqueId(),
				                
				             ]); 

                            
                            // for App
				            if(isset($data['items_categories'])){
						              Item_category::where('item_id',$item->id)->delete();
						              foreach ($data['items_categories'] as $key => $value) {
						              	               $value=(array)$value;
 						                                $d=[
						                                'item_id' => $item->id,
						                                'category_id' => $value['id'],
						                                'price' => $value['price'],
						                                'company_id' => $data['company_id'],

						                                ];


						                                Item_category::create($d);
						                 
						              }
				             } 
							
							//for web
							if(isset($data['category_price'])){
								foreach ($data['category_price'] as $key => $value) {
								 if($value !=''){
								                $d=[
								                'item_id' => $item->id,
								                'category_id' => $key,
								                'price' => $value,
								                'company_id' => $data['company_id'],

								                ];
								                Item_category::create($d);
								 }
								}
							}

				            return response()->json([
					            'message' => 'Item Successfully Created',
					            'data' => $data,
					            'isError' => false,
					            'responseCode'=>200, 
					        ], 200);

		 }
      public function itemsEdit(Request $request){
      			    	$data=$request->input();

		                   $validator =  Validator::make($request->all(),[
							'name' => 'required',
							'price' => 'required',
 							'company_id'=> 'required',
							'auth_token'=> 'required'

							]);

							if($validator->fails()){
							return response()->json([
							'message' => 'validation_error',
							'data' => $validator->errors(),
							'isError' => true,
							'responseCode'=>201
							], 401);
							}
 
                           $data['items_categories']= isset($data['items_categories'])?$data['items_categories']:[];
                            $data['items_categories']= json_decode($data['items_categories']);


				            Item::where('auth_token',$data['auth_token'])->update([
				                'name' => $data['name'],
				                'price' => $data['price'],
				                'description' => $data['description'],
 				             ]); 
     
                           $item=  Item::where('auth_token',$data['auth_token'])->first();
                           
                           Item_category::where('item_id',$item->id)->delete();
                           	if(isset($data['items_categories'])){
						              Item_category::where('item_id',$item->id)->delete();
						              foreach ($data['items_categories'] as $key => $value) {
						              	               $value=(array)$value;
 						                                $d=[
						                                'item_id' => $item->id,
						                                'category_id' => $value['id'],
						                                'price' => $value['price'],
						                                'company_id' => $data['company_id'],

						                                ];


						                                Item_category::create($d);
						                 
						              }
				             } 



				            return response()->json([
					            'message' => 'Unit Successfully Created',
					            'data' => $item,
					            'isError' => false,
					            'responseCode'=>200
					        ], 200);

       }


public function itemsDelete($auth_token) {
               $data =   Item::where('auth_token',$auth_token)->delete();
                 return response()->json([
			            'message' => 'Item Successfully Deleted',
			            'data' => $data,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
        }


 


 public function unitsAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

            if($q==''){
              $units=Unit::where('company_id',$company_id)->orderBy('id','DESC')->paginate(10);
            }else{
               $units=Unit::where('company_id',$company_id)->where('name', 'like', '%'.$q.'%')->orderBy('id','DESC')->paginate(10);

            }
	        
	        return response()->json([
	            'message' => 'All Items List',
	            'data' => $units,
	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}

public function unitsAdd(Request $request){
    	$data=$request->input();

                   $validator =  Validator::make($request->all(),[
					'name' => 'required',
					'company_id'=> 'required'
					]);

					if($validator->fails()){
					return response()->json([
					'message' => 'validation_error',
					'data' => $validator->errors(),
					'isError' => true,
					'responseCode'=>201
					], 401);
					}

              
		          $unit=  Unit::create([
		                'name' => $data['name'],
 		                'company_id' => $data['company_id'],
		                'auth_token'=>  $this->createUniqueId(),
		                
		             ]); 
		            return response()->json([
			            'message' => 'Unit Successfully Created',
			            'data' => $unit,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

 }






    public function unitsEdit(Request $request,$auth_token){
    	$data=$request->input();
         
					$validator =  Validator::make($request->all(),[
					'name' => 'required',
                     'company_id'=> 'required'
					]);
					if($validator->fails()){
					return response()->json([
					'message' => 'validation_error',
					'data' => $validator->errors(),
					'isError' => true,
					'responseCode'=>201
					], 401);
					}
                   $data = Unit::where('auth_token',$auth_token)
                  ->update([
                     'name' => $data['name'],
                    ]);
                
			        return response()->json([
			            'message' => 'Unit Successfully Updated',
			            'data' => $data,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
    }

public function unitsDelete($auth_token) {
               $data =   Unit::where('auth_token',$auth_token)->delete();
                 return response()->json([
			            'message' => 'Unit Successfully Deleted',
			            'data' => $data,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
        }

 public function categoriesAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

            if($q==''){
              $category=Category::where('company_id',$company_id)->orderBy('id','DESC')->paginate(10);
            }else{
               $category=Category::where('company_id',$company_id)->where('name', 'like', '%'.$q.'%')->orderBy('id','DESC')->paginate(10);

            }
	        
	        return response()->json([
	            'message' => 'All Items List',
	            'data' => $category,
	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}


public function categoriesAdd(Request $request){
    	$data=$request->input();

                   $validator =  Validator::make($request->all(),[
					'name' => 'required',
					'company_id'=> 'required'
					]);

					if($validator->fails()){
					return response()->json([
					'message' => 'validation_error',
					'data' => $validator->errors(),
					'isError' => true,
					'responseCode'=>201
					], 401);
					}

              
		          $category=  Category::create([
		                'name' => $data['name'],
		                'description' => isset($data['description'])?$data['description']:'',
		                'company_id' => $data['company_id'],
		                'auth_token'=>  $this->createUniqueId(),
		                
		             ]); 
		            return response()->json([
			            'message' => 'Category Successfully Created',
			            'data' => $category,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

 }



public function categoriesEdit(Request $request){
    	$data=$request->input();

                   $validator =  Validator::make($request->all(),[
					'name' => 'required',
					'company_id'=> 'required',
					'auth_token'=> 'required'
					]);

					if($validator->fails()){
					return response()->json([
					'message' => 'validation_error',
					'data' => $validator->errors(),
					'isError' => true,
					'responseCode'=>201
					], 401);
					}

              
		             $category=  Category::where('auth_token', $data['auth_token'])->update([
		                'name' => $data['name'],
		                'description' => isset($data['description'])?$data['description']:''
		             ]); 
		            return response()->json([
			            'message' => 'Category update Created',
			            'data' => $category,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

 }

public function estimatesAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';
 
            if($q==''){
              $estimates=Estimate::where('estimates.company_id',$company_id)->where('estimates.is_delete','!=',1)
						->leftJoin('customers', 'customers.id', '=', 'estimates.customer_id')
 						->select('customers.name as customer_name','estimates.*')
						->orderBy('estimates.id','DESC')->paginate(10);
             }else{
               $estimates=Estimate::where('estimates.company_id',$company_id)->where('estimates.is_delete','!=',1)
							->where('estimates.estimate_number', 'like', '%'.$q.'%')
							->leftJoin('customers', 'customers.id', '=', 'estimates.customer_id')
							->select('customers.name as customer_name','estimates.*')
							->orderBy('estimates.id','DESC')->paginate(10);
             }
	        

	        $estimatesData=($estimates->getCollection());
	        $results=[];
	        foreach ($estimatesData as $key => $value) {
	        	      $value->estimate_date= date('d/m/Y', strtotime($value->estimate_date));
	        	      $value->due_date= date('d/m/Y', strtotime($value->due_date));
	        	      $value->items=EstimateItem::where('estimate_id',$value->id)->get();
	        	      $results[]=$value;
	        }
	        return response()->json([
	            'message' => 'All Estimate List',
	            'data' => $estimates,
 	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}

public function estimatesDraft(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';
 
            if($q==''){
              $estimates=Estimate::where('estimates.company_id',$company_id)

                        ->where('estimates.status','DRAFT')->where('estimates.is_delete','!=',1)
						->leftJoin('customers', 'customers.id', '=', 'estimates.customer_id')
 						->select('customers.name as customer_name','estimates.*')
						->orderBy('estimates.id','DESC')->paginate(10);
             }else{
               $estimates=Estimate::where('estimates.company_id',$company_id)
                            ->where('estimates.status','DRAFT')->where('estimates.is_delete','!=',1)
							->where('estimates.estimate_number', 'like', '%'.$q.'%')
							->leftJoin('customers', 'customers.id', '=', 'estimates.customer_id')
							->select('customers.name as customer_name','estimates.*')
							->orderBy('estimates.id','DESC')->paginate(10);
             }
	        

	        $estimatesData=($estimates->getCollection());
	        $results=[];
	        foreach ($estimatesData as $key => $value) {
	        	      $value->estimate_date= date('d/m/Y', strtotime($value->estimate_date));
	        	      $value->due_date= date('d/m/Y', strtotime($value->due_date));
	        	      $value->items=EstimateItem::where('estimate_id',$value->id)->get();
	        	      $results[]=$value;
	        }
	        return response()->json([
	            'message' => 'All Estimate List',
	            'data' => $estimates,
 	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}
public function estimatesSent(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';
 
            if($q==''){
              $estimates=Estimate::where('estimates.company_id',$company_id)
                        ->where('estimates.status','SENT')->where('estimates.is_delete','!=',1)
						->leftJoin('customers', 'customers.id', '=', 'estimates.customer_id')
 						->select('customers.name as customer_name','estimates.*')
						->orderBy('estimates.id','DESC')->paginate(10);
             }else{
               $estimates=Estimate::where('estimates.company_id',$company_id)
                            ->where('estimates.status','SENT')->where('estimates.is_delete','!=',1)
							->where('estimates.estimate_number', 'like', '%'.$q.'%')
							->leftJoin('customers', 'customers.id', '=', 'estimates.customer_id')
							->select('customers.name as customer_name','estimates.*')
							->orderBy('estimates.id','DESC')->paginate(10);
             }
	        

	        $estimatesData=($estimates->getCollection());
	        $results=[];
	        foreach ($estimatesData as $key => $value) {
	        	      $value->estimate_date= date('d/m/Y', strtotime($value->estimate_date));
	        	      $value->due_date= date('d/m/Y', strtotime($value->due_date));
	        	      $value->items=EstimateItem::where('estimate_id',$value->id)->get();
	        	      $results[]=$value;
	        }
	        return response()->json([
	            'message' => 'All Estimate List',
	            'data' => $estimates,
 	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}

 public function estimatesAdd(Request $request){
               $data=$request->input();
                   $validator =  Validator::make($request->all(),[
						        'estimate_date' => 'required',
						        'due_date' => 'required',
						        'estimate_number' => 'required',
						        'customer_id' => 'required',
						        'sub_total' => 'required',
						        'total' => 'required',
						        'company_id' => 'required',
        					]);

					if($validator->fails()){
					return response()->json([
					'message' => 'validation_error',
					'data' => $validator->errors(),
					'isError' => true,
					'responseCode'=>201
					], 401);
					}

                   $notes= isset($data['notes'])?$data['notes']:'';
		           $items= json_decode($data['items']);

        $data['estimate_date']= implode("-", array_reverse(explode("/", $data['estimate_date'])));
        $data['due_date']= implode("-", array_reverse(explode("/", $data['due_date'])));     

        $estimate_date=date('Y-m-d',strtotime($data['estimate_date']) );
        $due_date=date('Y-m-d',strtotime($data['due_date']) );



        $estimate_number=isset($data['estimate_number'])?$data['estimate_number']:'';
        $customer_id=isset($data['customer_id'])?$data['customer_id']:'';
        $sub_total=isset($data['sub_total'])?$data['sub_total']:'';
        $discount=isset($data['discount'])?$data['discount']:'';
        $discount_type=isset($data['discount_type'])?$data['discount_type']:'';
        $discount_val=isset($data['discount_val'])?$data['discount_val']:0;
        
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
             'auth_token'=>$this->createUniqueId(),
            'company_id'=>$data['company_id'],
            'customer_id'=>$customer_id
        ];
        $estimate=Estimate::create($estimateData);

            if(isset($estimate->id)){
                foreach ($items as $key => $value) {
                          $value=(object)$value;
                          $estimateItemData=[
                            'item_id'=>$value->id,
                            'quantity'=>$value->quantity,
                            'price'=>$value->price,
                            'total'=>($value->quantity*$value->price),
                            'name'=>$value->name,
                            'estimate_id'=>$estimate->id,
                            'company_id'=>$data['company_id']
                          ];
                          EstimateItem::create($estimateItemData);
                 }
            }

		            return response()->json([
			            'message' => 'estimate Successfully Created',
			            'data' => $estimate,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
     
}


 public function estimatesEdit(Request $request){
               $data=$request->input();
                   $validator =  Validator::make($request->all(),[
						        'estimate_date' => 'required',
						        'due_date' => 'required',
						        'estimate_number' => 'required',
						        'customer_id' => 'required',
						        'sub_total' => 'required',
						        'total' => 'required',
						        'company_id' => 'required',
						        'auth_token'=>'required',
        					]);

					if($validator->fails()){
					return response()->json([
					'message' => 'validation_error',
					'data' => $validator->errors(),
					'isError' => true,
					'responseCode'=>201
					], 401);
					}

                   $notes= isset($data['notes'])?$data['notes']:'';
		           $items= json_decode($data['items']);

        $data['estimate_date']= implode("-", array_reverse(explode("/", $data['estimate_date'])));
        $data['due_date']= implode("-", array_reverse(explode("/", $data['due_date'])));     

        $estimate_date=date('Y-m-d',strtotime($data['estimate_date']) );
        $due_date=date('Y-m-d',strtotime($data['due_date']) );



        $estimate_number=isset($data['estimate_number'])?$data['estimate_number']:'';
        $customer_id=isset($data['customer_id'])?$data['customer_id']:'';
        $sub_total=isset($data['sub_total'])?$data['sub_total']:'';
        $discount=isset($data['discount'])?$data['discount']:'';
        $discount_type=isset($data['discount_type'])?$data['discount_type']:'';
        $discount_val=isset($data['discount_val'])?$data['discount_val']:0;
        
        if($discount<=0){  $discount_type=''; $discount_val='0'; }
        if(!$discount){ $discount_type=''; $discount_val='0'; }


        $total=isset($data['total'])?$data['total']:'';
        $notes=isset($data['notes'])?$data['notes']:'';
        $auth_token=$data['auth_token'];

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
             'customer_id'=>$customer_id
        ];


        Estimate::where('auth_token', $auth_token)->update($estimateData);
        $estimate=Estimate::where('auth_token', $auth_token)->first();

            if(isset($estimate->id)){
            	EstimateItem::where('estimate_id', $estimate->id)->delete();

                foreach ($items as $key => $value) {
                          $value=(object)$value;
                          $estimateItemData=[
                            'item_id'=>$value->id,
                            'quantity'=>$value->quantity,
                            'price'=>$value->price,
                            'total'=>($value->quantity*$value->price),
                            'name'=>$value->name,
                            'estimate_id'=>$estimate->id,
                            'company_id'=>$data['company_id']
                          ];
                          EstimateItem::create($estimateItemData);
                 }
            }

		            return response()->json([
			            'message' => 'estimate Successfully updated',
			            'data' => $estimate,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
     
}

	public function estimatesDelete(Request $request){
	            $data=$request->input();
 	            $id= isset($data['id'])?$data['id']:'';

		        $estimate=Estimate::where('id',$id)->first();

		        EstimateItem::where('estimate_id',$estimate->id)->delete();

		        Estimate::where('id',$id)->delete();

		            return response()->json([
			            'message' => 'Successfully Deleted',
			            'data' => [],
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
	}

public function convertToInvoice(Request $request){
	$data=$request->input();

	  $id= $data['id'];
	  $company_id= $data['company_id'];

      $estimate=Estimate::where('company_id',$company_id)->where('id',$id)->first();
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
            'auth_token'=>$estimate->auth_token,
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
            Estimate::where('id',$estimate->id)->delete();
	            return response()->json([
			            'message' => 'Successfully Converted to Invoice',
			            'data' => [],
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
}
public function estimateMarkAsSent(Request $request){
	$data=$request->input();
    $id= $data['id'];
	$company_id= $data['company_id'];
	 Estimate::where('id',$id)->update(['status'=>'SENT']);
    
    return response()->json([
            'message' => 'Successfully Marked as Sent',
            'data' => [],
            'isError' => false,
            'responseCode'=>200
        ], 200);

}
public function estimatesSend(Request $request){
	$data=$request->input();
    $id= $data['id'];
	$company_id= $data['company_id'];
	  		    

	  		    $Estimate=Estimate::where('id',$id)->first();
		        $EstimateItem=EstimateItem::where('estimate_id',$Estimate->id)->get();
		  	    $Customer=Customer::where('id',$Estimate->customer_id)->first();
		  	    $Company=Company::where('id',$Estimate->company_id)->first();   
			    
			    $pdf = PDF::loadView('pdf.estimate', compact('Estimate', 'EstimateItem', 'Customer', 'Company'));
			    $file=public_path().'/pdf/_filename.pdf';
		  	    $pdf->save($file);
	           $estimate=Estimate::where('id',$id)->first();
 	           
	           Mail::send('emails.reminder', ['estimate' => $estimate], function ($m) use ($Customer, $file) {
	            $m->to('aashishkumarmishra@live.com', $Customer->name)->subject('Your Reminder!');
				$m->attach($file, [
				                    'as' => 'name.pdf',
				                    'mime' => 'application/pdf',
				                ]);
	           });
	           Estimate::where('id',$id)->update(['status'=>'SENT']);
    return response()->json([
            'message' => 'Estimate Successfully as send',
            'data' => [],
            'isError' => false,
            'responseCode'=>200
        ], 200);
}
 
public function estimateMarkAsAccepted(Request $request){
	$data=$request->input();
    $id= $data['id'];
	$company_id= $data['company_id'];
		 Estimate::where('id',$id)->update(['status'=>'ACCEPTED']);
    
    return response()->json([
            'message' => 'Successfully Marked as ACCEPTED',
            'data' => [],
            'isError' => false,
            'responseCode'=>200
        ], 200);

}
public function estimateMarkAsRejected(Request $request){
	$data=$request->input();
	$id= $data['id'];
	$company_id= $data['company_id'];
		 Estimate::where('id',$id)->update(['status'=>'REJECTED']);
    
    return response()->json([
            'message' => 'Successfully Marked as REJECTED',
            'data' => [],
            'isError' => false,
            'responseCode'=>200
        ], 200);

}






 public function invoicesAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

            if($q==''){
              $invoices=Invoice::where('invoices.company_id',$company_id)
						->leftJoin('customers', 'customers.id', '=', 'invoices.customer_id')
 						->select('customers.name as customer_name','invoices.*')
						->orderBy('invoices.id','DESC')->paginate(10);
             }else{
               $invoices=Invoice::where('invoices.company_id',$company_id)
							->where('invoices.invoice_number', 'like', '%'.$q.'%')
							->leftJoin('customers', 'customers.id', '=', 'invoices.customer_id')
							->select('customers.name as customer_name','invoices.*')
							->orderBy('invoices.id','DESC')->paginate(10);
             }
	        

	        $invoicesData=($invoices->getCollection());
	        $results=[];
	        foreach ($invoicesData as $key => $value) {
	        	      $value->invoice_date= date('d/m/Y', strtotime($value->invoice_date));
	        	      $value->due_date= date('d/m/Y', strtotime($value->due_date));
	        	      $value->items=InvoiceItem::where('invoice_id',$value->id)->get();

	        	      $value->before_photos=InvoiceImage::where('invoice_id',$value->id)->where('type','before')->get();
	        	      $value->after_photos=InvoiceImage::where('invoice_id',$value->id)->where('type','after')->get();
				      $value->other_photos=InvoiceImage::where('invoice_id',$value->id)->where('type','other')->get();


	        	      $results[]=$value;
	        }
	        return response()->json([
	            'message' => 'All Invoices List',
	            'data' => $invoices,
 	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}

 public function invoicesDraft(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

            if($q==''){
              $invoices=Invoice::where('invoices.company_id',$company_id)
                        ->where('invoices.status', 'DRAFT')
						->leftJoin('customers', 'customers.id', '=', 'invoices.customer_id')
 						->select('customers.name as customer_name','invoices.*')
						->orderBy('invoices.id','DESC')->paginate(10);
             }else{
               $invoices=Invoice::where('invoices.company_id',$company_id)
                            ->where('invoices.status', 'DRAFT')
							->where('invoices.invoice_number', 'like', '%'.$q.'%')
							->leftJoin('customers', 'customers.id', '=', 'invoices.customer_id')
							->select('customers.name as customer_name','invoices.*')
							->orderBy('invoices.id','DESC')->paginate(10);
             }
	        

	        $invoicesData=($invoices->getCollection());
	        $results=[];
	        foreach ($invoicesData as $key => $value) {
	        	      $value->invoice_date= date('d/m/Y', strtotime($value->invoice_date));
	        	      $value->due_date= date('d/m/Y', strtotime($value->due_date));
	        	      $value->items=InvoiceItem::where('invoice_id',$value->id)->get();

	        	      $value->before_photos=InvoiceImage::where('invoice_id',$value->id)->where('type','before')->get();
	        	      $value->after_photos=InvoiceImage::where('invoice_id',$value->id)->where('type','after')->get();
				      $value->other_photos=InvoiceImage::where('invoice_id',$value->id)->where('type','other')->get();

	        	      $results[]=$value;
	        }
	        return response()->json([
	            'message' => 'All Invoices List',
	            'data' => $invoices,
 	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}


 public function invoicesDue(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

            if($q==''){
              $invoices=Invoice::where('invoices.company_id',$company_id)
                        ->where('invoices.due_amount', '>',0)
						->leftJoin('customers', 'customers.id', '=', 'invoices.customer_id')
 						->select('customers.name as customer_name','invoices.*')
						->orderBy('invoices.id','DESC')->paginate(10);
             }else{
               $invoices=Invoice::where('invoices.company_id',$company_id)
                            ->where('invoices.due_amount', '>', 0)
							->where('invoices.invoice_number', 'like', '%'.$q.'%')
							->leftJoin('customers', 'customers.id', '=', 'invoices.customer_id')
							->select('customers.name as customer_name','invoices.*')
							->orderBy('invoices.id','DESC')->paginate(10);
             }
	        

	        $invoicesData=($invoices->getCollection());
	        $results=[];
	        foreach ($invoicesData as $key => $value) {
	        	      $value->invoice_date= date('d/m/Y', strtotime($value->invoice_date));
	        	      $value->due_date= date('d/m/Y', strtotime($value->due_date));
	        	      $value->items=InvoiceItem::where('invoice_id',$value->id)->get();

	        	      $value->before_photos=InvoiceImage::where('invoice_id',$value->id)->where('type','before')->get();
	        	      $value->after_photos=InvoiceImage::where('invoice_id',$value->id)->where('type','after')->get();
				      $value->other_photos=InvoiceImage::where('invoice_id',$value->id)->where('type','other')->get();

	        	      $results[]=$value;
	        }
	        return response()->json([
	            'message' => 'All Invoices List',
	            'data' => $invoices,
 	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}

 public function invoicesAdd(Request $request){
               $data=$request->input();
                   $validator =  Validator::make($request->all(),[
						        'invoice_date' => 'required',
						        'due_date' => 'required',
						        'invoice_number' => 'required',
						        'customer_id' => 'required',
						        'sub_total' => 'required',
						        'total' => 'required',
						        'company_id' => 'required',
        					]);

					if($validator->fails()){
					return response()->json([
					'message' => 'validation_error',
					'data' => $validator->errors(),
					'isError' => true,
					'responseCode'=>201
					], 401);
					}

                   $notes= isset($data['notes'])?$data['notes']:'';
		           $items= json_decode($data['items']);

        $data['invoice_date']= implode("-", array_reverse(explode("/", $data['invoice_date'])));
        $data['due_date']= implode("-", array_reverse(explode("/", $data['due_date'])));     

        $invoice_date=date('Y-m-d',strtotime($data['invoice_date']) );
        $due_date=date('Y-m-d',strtotime($data['due_date']) );



        $invoice_number=isset($data['invoice_number'])?$data['invoice_number']:'';
        $customer_id=isset($data['customer_id'])?$data['customer_id']:'';
        $sub_total=isset($data['sub_total'])?$data['sub_total']:'';
        $discount=isset($data['discount'])?$data['discount']:'';
        $discount_type=isset($data['discount_type'])?$data['discount_type']:'';
        $discount_val=isset($data['discount_val'])?$data['discount_val']:0;
        
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
            'auth_token'=>$this->createUniqueId(),
            'company_id'=>$data['company_id'],
            'customer_id'=>$customer_id
        ];
        $invoice=Invoice::create($invoiceData);

            if(isset($invoice->id)){
                foreach ($items as $key => $value) {
                          $value=(object)$value;
                          $invoiceItemData=[
                            'item_id'=>$value->id,
                            'quantity'=>$value->quantity,
                            'price'=>$value->price,
                            'notes'=>$value->description,
                            'total'=>($value->quantity*$value->price),
                            'name'=>$value->name,
                            'invoice_id'=>$invoice->id,
                            'company_id'=>$data['company_id']
                          ];
                          InvoiceItem::create($invoiceItemData);
                 }
            }

 

	         $after_images_data = isset($data['after_photos'])? $data['after_photos']:'[]';
	         $before_images_data = isset($data['before_photos'])? $data['before_photos']:'[]';
	         $other_images_data = isset($data['other_photos'])? $data['other_photos']:'[]';

	         $after_images_data= json_decode($after_images_data);
	         $before_images_data= json_decode($before_images_data);
	         $other_images_data =json_decode($other_images_data);






             InvoiceImage::where('invoice_id',$invoice->id)->delete();
                  
                  foreach ($after_images_data as $key => $imgs) {
                  	  $type='after';
                      InvoiceImage::create([
                        'company_id'=>$data['company_id'],
                        'url'=>$imgs->url,
                        'notes'=>$imgs->notes,
                        'type'=>$type,
                        'invoice_id'=>$invoice->id
                      ]); 
                  }

                  foreach ($before_images_data as $key => $imgs) {
                  	  $type='before';
                      InvoiceImage::create([
                        'company_id'=>$data['company_id'],
                        'url'=>$imgs->url,
                        'notes'=>$imgs->notes,
                        'type'=>$type,
                        'invoice_id'=>$invoice->id
                      ]); 
                  }

                  foreach ($other_images_data as $key => $imgs) {
                       $type='other';
                      InvoiceImage::create([
                        'company_id'=>$data['company_id'],
                        'url'=>$imgs->url,
                        'notes'=>$imgs->notes,
                        'type'=>$type,
                        'invoice_id'=>$invoice->id
                      ]); 
                  }

		            return response()->json([
			            'message' => 'Invoice Successfully Created',
			            'data' => $invoice,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
     
}






 public function invoicesEdit(Request $request){
               $data=$request->input();
                   $validator =  Validator::make($request->all(),[
						        'invoice_date' => 'required',
						        'due_date' => 'required',
						        'invoice_number' => 'required',
						        'customer_id' => 'required',
						        'sub_total' => 'required',
						        'total' => 'required',
						        'company_id' => 'required',
						        'auth_token' => 'required',
        					]);

					if($validator->fails()){
					return response()->json([
					'message' => 'validation_error',
					'data' => $validator->errors(),
					'isError' => true,
					'responseCode'=>201
					], 401);
					}

                   $notes= isset($data['notes'])?$data['notes']:'';
		           $items= json_decode($data['items']);

        $data['invoice_date']= implode("-", array_reverse(explode("/", $data['invoice_date'])));
        $data['due_date']= implode("-", array_reverse(explode("/", $data['due_date'])));     

        $invoice_date=date('Y-m-d',strtotime($data['invoice_date']) );
        $due_date=date('Y-m-d',strtotime($data['due_date']) );



        $invoice_number=isset($data['invoice_number'])?$data['invoice_number']:'';
        $customer_id=isset($data['customer_id'])?$data['customer_id']:'';
        $sub_total=isset($data['sub_total'])?$data['sub_total']:'';
        $discount=isset($data['discount'])?$data['discount']:'';
        $discount_type=isset($data['discount_type'])?$data['discount_type']:'';
        $discount_val=isset($data['discount_val'])?$data['discount_val']:0;
        
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
            'customer_id'=>$customer_id
        ];
            Invoice::where('auth_token', $data['auth_token'])->update($invoiceData);
            $invoice=Invoice::where('auth_token', $data['auth_token'])->first();
            if(isset($invoice->id)){
                InvoiceItem::where('invoice_id',$invoice->id)->delete();

                foreach ($items as $key => $value) {
                          $value=(object)$value;
                          $invoiceItemData=[
                            'item_id'=>$value->id,
                            'quantity'=>$value->quantity,
                            'price'=>$value->price,
                            'total'=>($value->quantity*$value->price),
                            'name'=>$value->name,
                            'invoice_id'=>$invoice->id,
                            'company_id'=>$data['company_id']
                          ];
                          InvoiceItem::create($invoiceItemData);
                 }



				             $after_images_data = isset($data['after_photos'])? $data['after_photos']:'[]';
					         $before_images_data = isset($data['before_photos'])? $data['before_photos']:'[]';
					         $other_images_data = isset($data['other_photos'])? $data['other_photos']:'[]';

					         $after_images_data= json_decode($after_images_data);
					         $before_images_data= json_decode($before_images_data);
					         $other_images_data =json_decode($other_images_data);

				             InvoiceImage::where('invoice_id',$invoice->id)->delete();
				                  
				                  foreach ($after_images_data as $key => $imgs) {
				                  	  $type='after';
				                      InvoiceImage::create([
				                        'company_id'=>$data['company_id'],
				                        'url'=>$imgs->url,
				                        'notes'=>$imgs->notes,
				                        'type'=>$type,
				                        'invoice_id'=>$invoice->id
				                      ]); 
				                  }

				                  foreach ($before_images_data as $key => $imgs) {
				                  	  $type='before';
				                      InvoiceImage::create([
				                        'company_id'=>$data['company_id'],
				                        'url'=>$imgs->url,
				                        'notes'=>$imgs->notes,
				                        'type'=>$type,
				                        'invoice_id'=>$invoice->id
				                      ]); 
				                  }

				                  foreach ($other_images_data as $key => $imgs) {
				                       $type='other';
				                      InvoiceImage::create([
				                        'company_id'=>$data['company_id'],
				                        'url'=>$imgs->url,
				                        'notes'=>$imgs->notes,
				                        'type'=>$type,
				                        'invoice_id'=>$invoice->id
				                      ]); 
				                  }

            }

		            return response()->json([
			            'message' => 'Invoice Successfully Updated',
			            'data' => $invoice,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
     
}

    public function invoicesDelete(Request $request){
             $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $id= isset($data['id'])?$data['id']:'';
          $invoice=Invoice::where('id',$id)->first();
          InvoiceImage::where('invoice_id',$invoice->id)->delete();
          InvoiceItem::where('invoice_id',$invoice->id)->delete();
          Payment::where('invoice_id',$invoice->id)->delete();
          Invoice::where('id',$id)->delete();
             return response()->json([
			            'message' => 'Invoice Successfully Deleted',
			            'data' => [],
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

  }

    public function invoicesClone(Request $request){
		$data=$request->input();
		$company_id= isset($data['company_id'])?$data['company_id']:'';
		$id= isset($data['id'])?$data['id']:'';


 $invoice=Invoice::where('id',$id)->first();
          $invoiceItems=InvoiceItem::where('invoice_id',$invoice->id)->get();

          $invoiceData= [
              'invoice_date'=>$invoice->invoice_date,
              'due_date'=>$invoice->due_date,
              'invoice_number'=>$this->generateUniqueInvoiceId($data),
              'notes'=>$invoice->notes,
              'discount_type'=>$invoice->discount_type,
              'discount'=>$invoice->discount,
              'discount_val'=>$invoice->discount_val,
              'sub_total'=>$invoice->sub_total,
              'total'=>$invoice->total,
              'due_amount'=>$invoice->due_amount,
              'auth_token'=>$this->createUniqueId(),
              'company_id'=>$company_id,
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
                            'company_id'=>$company_id
                          ];
                          InvoiceItem::create($invoiceItemData);
                 }
          }

         return response()->json([
			            'message' => 'Invoice Successfully Cloned',
			            'data' => [],
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

    }


    public function invoicesMarkAsSent(Request $request){
		$data=$request->input();
		$company_id= isset($data['company_id'])?$data['company_id']:'';
		$id= isset($data['id'])?$data['id']:'';

         Invoice::where('id',$id)->update(['status'=> 'SENT']);

         return response()->json([
			            'message' => 'Invoice Successfully updated as SENT',
			            'data' => [],
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

    }

        public function invoicesSend(Request $request){
		$data=$request->input();
		$company_id= isset($data['company_id'])?$data['company_id']:'';
		$id= isset($data['id'])?$data['id']:'';



	  		    $Invoice=Invoice::where('id',$id)->first();
		        $InvoiceItem=InvoiceItem::where('invoice_id',$Invoice->id)->get();
		  	    $Customer=Customer::where('id',$Invoice->customer_id)->first();
		  	    $Company=Company::where('id',$Invoice->company_id)->first();   
			    $pdf = PDF::loadView('pdf.invoice', compact('Invoice', 'InvoiceItem', 'Customer', 'Company'));
			    $file=public_path().'/pdf/_filename.pdf';
		  	    $pdf->save($file);
    	        $invoice=Invoice::where('id',$id)->first();
 
 		         $invoiceData= [
	            'status'=> 'SENT',
	             ];

                Invoice::where('id',$id)->update($invoiceData);

				Mail::send('emails.reminder', ['invoice' => $invoice], function ($m) use ($Customer, $file) {
				  $m->to('aashishkumarmishra@live.com', $Customer->name)->subject('Your Reminder!');
				  $m->attach($file, [
				                    'as' => 'name.pdf',
				                    'mime' => 'application/pdf',
				                ]);
				});
         return response()->json([
			            'message' => 'Invoice Successfully Sent',
			            'data' => [],
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

    }





 public function expensesAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

            if($q==''){
              $expenses=Expense::where('company_id',$company_id)->orderBy('id','DESC')->paginate(10);
            }else{
               $expenses=Expense::where('company_id',$company_id)->where('amount', 'like', '%'.$q.'%')->orderBy('id','DESC')->paginate(10);

            }
	        
	        return response()->json([
	            'message' => 'All expenses List',
	            'data' => $expenses,
	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}


public function expensesAdd(Request $request){
    	$data=$request->input();

                   $validator =  Validator::make($request->all(),[
					'expense_date' => 'required',
					'amount' => 'required',
					'expense_category_id' => 'required',
					'company_id'=> 'required'
					]);

					if($validator->fails()){
					return response()->json([
					'message' => 'validation_error',
					'data' => $validator->errors(),
					'isError' => true,
					'responseCode'=>201
					], 401);
					}

                   $notes= isset($data['notes'])?$data['notes']:'';
		          $Expense=  Expense::create([
		                'expense_date' => date('Y-m-d',strtotime($data['expense_date'])),
						'amount' => $data['amount'],
						'notes' => $notes,
						'expense_category_id' => $data['expense_category_id'],
 		                'company_id' => $data['company_id'],
		                'auth_token'=>  $this->createUniqueId(),
		                
		             ]); 

		          
		            return response()->json([
			            'message' => 'Expense Successfully Created',
			            'data' => $Expense,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

 }

 public function expensesCategoriesAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

            if($q==''){
              $expensesCategories=ExpenseCategory::where('company_id',$company_id)->orderBy('id','DESC')->select('name as label','id as value','expense_categories.*')->paginate(10);
            }else{
               $expensesCategories=ExpenseCategory::where('company_id',$company_id)->where('name', 'like', '%'.$q.'%')->orderBy('id','DESC')->select('name as label','id as value','expense_categories.*')->paginate(10);

            }
	        
	        return response()->json([
	            'message' => 'All expenses category List',
	            'data' => $expensesCategories,
	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}


public function expenses(){
	 $expenses=Expense::orderBy('id','DESC')->get();
			        return response()->json([
			            'message' => 'All Expenses',
			            'data' => $expenses,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
}

public function expensesNew(Request $request){
    	 $data=$request->input();
                $validator =  Validator::make($request->all(),[
				     'expense_date' => 'required',
                      'amount' => 'required',
                      'expense_category_id' => 'required',
                      'receipt' => 'max:2048',
                     
				    ]);
				    if($validator->fails()){
				        return response()->json([
				            'message' => 'validation_error',
				            'data' => $validator->errors(),
				            'isError' => true,
				            'responseCode'=>201
				        ], 401);
				    }
  $attachment_receipt='';
            if($request->has('receipt')) {
                    $fileName = time().'.'.$request->receipt->extension();  
                    $request->receipt->move(public_path('uploads/attachment_receipt'), $fileName);
                    $attachment_receipt=$fileName;
            }
			        $data=  Expense::create([
                'expense_date' => date('Y-m-d',strtotime($data['expense_date'])),
                 'amount' => $data['amount'],
                 'notes' => $data['notes'],
                 'expense_category_id' => $data['expense_category_id'],
                 'attachment_receipt'=>$attachment_receipt,
                 'auth_token'=> $this->createUniqueId(),
                 'company_id' => 1,
                
             ]); 


			       $expense=Expense::where('id',$data->id)->first();
			        return response()->json([
			            'message' => 'Expense Successfully Created',
			            'data' => $expense,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
    }

    public function expensesEdit(Request $request,$auth_token){
    	$data=$request->input();
         
           $validator =  Validator::make($request->all(),[
				    'expense_date' => 'required',
                    'amount' => 'required',
                    'expense_category_id' => 'required',
                    'receipt' => 'max:2048',
                   
				    ]);
				    if($validator->fails()){
				        return response()->json([
				            'message' => 'validation_error',
				            'data' => $validator->errors(),
				            'isError' => true,
				            'responseCode'=>201
				        ], 401);
				    }
           $data = Expense::where('auth_token',$auth_token)
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
			        return response()->json([
			            'message' => 'Expense Successfully Updated',
			            'data' => $data,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
    }
  
public function expensesDelete($auth_token) {
               $data =   Expense::where('auth_token',$auth_token)->delete();
                 return response()->json([
			            'message' => 'Expense Successfully Deleted',
			            'data' => $data,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
        }
public function expensesCategoriesEdit(Request $request){
    	$data=$request->input();

                   $validator =  Validator::make($request->all(),[
					'name' => 'required',
					'company_id'=> 'required',
					'auth_token'=> 'required'
					]);

					if($validator->fails()){
					return response()->json([
					'message' => 'validation_error',
					'data' => $validator->errors(),
					'isError' => true,
					'responseCode'=>201
					], 401);
					}

              
		             $ExpenseCategory=  ExpenseCategory::where('auth_token', $data['auth_token'])->update([
		                'name' => $data['name'],
		                'description' => isset($data['description'])?$data['description']:''
		             ]); 
		            return response()->json([
			            'message' => 'Expense Category update Created',
			            'data' => $ExpenseCategory,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

 }

  public function expensesCategoriesAdd(Request $request){
    	$data=$request->input();

                   $validator =  Validator::make($request->all(),[
					'name' => 'required',
					'company_id'=> 'required'
					]);

					if($validator->fails()){
					return response()->json([
					'message' => 'validation_error',
					'data' => $validator->errors(),
					'isError' => true,
					'responseCode'=>201
					], 401);
					}

              
		          $category=  ExpenseCategory::create([
		                'name' => $data['name'],
		                'description' => isset($data['description'])?$data['description']:'',
		                'company_id' => $data['company_id'],
		                'auth_token'=>  $this->createUniqueId(),
		                
		             ]); 
		            return response()->json([
			            'message' => 'Expense Category Successfully Created',
			            'data' => $category,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

 }


 public function paymentAll(Request $request){
            $data=$request->input();
            $company_id= isset($data['company_id'])?$data['company_id']:'';
            $q= isset($data['q'])?$data['q']:'';

            if($q==''){
                
              $payments = Payment::where('payments.company_id',$company_id)
		        ->leftJoin('customers', 'customers.id', '=', 'payments.customer_id')
		        ->leftJoin('invoices', 'invoices.id', '=', 'payments.invoice_id')
		        ->select('customers.name','invoices.invoice_number','payments.*')
		        ->orderBy('payments.id','DESC')->paginate(10);

      
            }else{
                
               $payments = Payment::where('payments.company_id',$company_id)
			        ->leftJoin('customers', 'customers.id', '=', 'payments.customer_id')
			        ->leftJoin('invoices', 'invoices.id', '=', 'payments.invoice_id')
			        ->select('customers.name','invoices.invoice_number','payments.*')
			        ->orderBy('payments.id','DESC')->paginate(10);

            }
	        
	        $paymentsData = $payments->getCollection();
            $pdata=[];
            foreach ($paymentsData as $key => $value) {

            	$invoices=Invoice::where('customer_id', $value['customer_id'])->where('company_id', $company_id)->select('invoices.*', 'invoices.invoice_number as text','invoices.invoice_number as label','invoices.id as value',)->get();


                  $pdata[]=[
						'id'=>$value['id'],
						'payment_number'=>$value['payment_number'],
						'payment_date'=>date('d/m/Y', strtotime($value['payment_date'])),
						'notes'=>$value['notes'],
						'amount'=>$value['amount'],
						'customer_id'=>$value['customer_id'],
						'invoice_id'=>$value['invoice_id'],
						'company_id'=>$value['company_id'],
						'payment_method_id'=>$value['payment_method_id'],
						'auth_token'=>$value['auth_token'],
						'created_at'=>$value['created_at'],
						'updated_at'=>$value['updated_at'],
						'invoice_number'=>$value['invoice_number'],
						'name'=>$value['name'],
						'all_invoices'=>$invoices,
                  ];
            }
  

	        return response()->json([
	            'message' => 'All expenses category List',
	            'data' => $payments,
                'results'=>$pdata,
	            'isError' => false,
	            'responseCode'=>200
	        ], 200);
}


public function paymentAdd(Request $request){
    	$data=$request->input();

                   $validator =  Validator::make($request->all(),[
						'payment_number' => 'required',
						'payment_date' => 'required',
						'amount'=>'required',
						'customer_id'=>'required',
						'invoice_id'=>'required',
						'payment_method_id'=>'required'
					]);

					if($validator->fails()){
					return response()->json([
					'message' => 'validation_error',
					'data' => $validator->errors(),
					'isError' => true,
					'responseCode'=>201
					], 401);
					}

                   $notes= isset($data['notes'])?$data['notes']:'';

					 $invoice=Invoice::where('id',$data['invoice_id'])->where('customer_id',$data['customer_id'])->first();
			            if(isset($invoice->due_amount) && ($data['amount']> $invoice->due_amount)){
			            	return response()->json([
								'message' => 'validation_error',
								'data' => ['amount'=>['amount must be less or equal to due amount !']],
								'isError' => true,
								'responseCode'=>201
								], 401);
 			            }





                  
                  $data['payment_date']= implode("-", array_reverse(explode("/", $data['payment_date'])));
		          $payment=  Payment::create([
						'payment_number' => $data['payment_number'],
						'payment_date' => date('Y-m-d',strtotime($data['payment_date'])),
						'amount'=>$data['amount'],
						'customer_id'=>$data['customer_id'],
						'invoice_id'=>$data['invoice_id'],
						'payment_method_id'=>$data['payment_method_id'],
						'notes' => $notes,
						'company_id' => $data['company_id'],
						'auth_token'=>  $this->createUniqueId(),
		      
		             ]); 

		          

             $remainAmount= $invoice->due_amount - $payment->amount;
             $paid_status='';
             $status=$invoice->status;
             if($remainAmount>0){ $paid_status='PARTIALLY PAID'; }else{ $paid_status='PAID'; $status='COMPLETED'; }
             Invoice::where('id',$data['invoice_id'])->where('customer_id',$data['customer_id'])->update(['due_amount'=>$remainAmount,'paid_status'=>$paid_status, 'status'=>$status]);



		            return response()->json([
			            'message' => 'Payment Successfully Created',
			            'data' => $payment,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

 }

public function paymentEdit(Request $request){
       
             $this->validate($request, [
              'payment_number' => 'required',
            'payment_date' => 'required',
            'notes' => 'required',
            'amount'=>'required',
            'customer_id'=>'required',
            'invoice_id'=>'required',
            'payment_method_id'=>'required',
            'auth_token'=>'required'
               ]);
                 $data=$request->input();
 
         $auth_token=$data['auth_token'];
         $payment = Payment::where('auth_token', $auth_token)->first();
         $invoice = Invoice::where('id',$payment->invoice_id)->first();
         $customer = Customer::where('id',$invoice->customer_id)->first();


             $total_due_amount= $invoice->due_amount + $payment->amount;
             if($data['amount']> $total_due_amount){
                          return response()->json([
								'message' => 'validation_error',
								'data' => ['amount'=>['amount must be less or equal to due amount !']],
								'isError' => true,
								'responseCode'=>201
								], 401);
            }




            $data['payment_date']= implode("-", array_reverse(explode("/", $data['payment_date']))); 
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


		            return response()->json([
			            'message' => 'Payment successfully Updated!',
			            'data' => $payment,
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);

 
         
    }
 function uploads(Request $request){
           if($request->has('file')) {
                    $fileName = time().time().time().'.'.$request->file->extension();  
                    $request->file->move(public_path('uploads/files'), $fileName);                    
            }

		    return response()->json([
			            'message' => 'file Successfully updated',
			            'data' => url('uploads/files/'.$fileName),
			            'isError' => false,
			            'responseCode'=>200
			        ], 200);
 }

 
 
public  function getInvoiceID(Request $request){
	$data= $request->input();
   $invoice_number_count=   Invoice::where('company_id', $data['company_id'])->count() +1;
    $j=99999999999999999;
    $invoiceNumber='';
    for ($i=$invoice_number_count; $i<$j ; $i++) { 
        $invoiceNumber='INV'.str_pad($i, 8, '0', STR_PAD_LEFT);
    	$check=Invoice::where('company_id', $data['company_id'])->where('invoice_number', $invoiceNumber)->first();
    	if(!isset($check->id)) { $j=0;	}
    }
        return response()->json([
        'message' => 'Invoice id',
        'data' => $invoiceNumber,
        'isError' => false,
        'responseCode'=>200
    ], 200);

}
public  function generateUniqueInvoiceId($data){
    $invoice_number_count=   Invoice::where('company_id', $data['company_id'])->count() +1;
    $j=99999999999999999;
    $invoiceNumber='';
    for ($i=$invoice_number_count; $i<$j ; $i++) { 
        $invoiceNumber='INV'.str_pad($i, 8, '0', STR_PAD_LEFT);
    	$check=Invoice::where('company_id', $data['company_id'])->where('invoice_number', $invoiceNumber)->first();
    	if(!isset($check->id)) { $j=0;	}
    }
   return $invoiceNumber;
}


public  function getEstimateID(Request $request){
	$data= $request->input();
   $estimate_number_count=   Estimate::where('company_id', $data['company_id'])->count() +1;
    $j=99999999999999999;
    $estimate_number='';
    for ($i=$estimate_number_count; $i<$j ; $i++) { 
        $estimate_number='EST'.str_pad($i, 8, '0', STR_PAD_LEFT);
    	$check=Estimate::where('company_id', $data['company_id'])->where('estimate_number', $estimate_number)->first();
    	if(!isset($check->id)) { $j=0;	}
    }
   return response()->json([
        'message' => 'Estimate id',
        'data' => $estimate_number,
        'isError' => false,
        'responseCode'=>200
    ], 200);
 }

public  function getPaymentID(Request $request){
	$data= $request->input();
   $pay_number_count=   Payment::where('company_id', $data['company_id'])->count() +1;
    $j=99999999999999999;
    $payment_number='';
    for ($i=$pay_number_count; $i<$j ; $i++) { 
        $payment_number='PAY'.str_pad($i, 8, '0', STR_PAD_LEFT);
      $check=Payment::where('company_id', $data['company_id'])->where('payment_number', $payment_number)->first();
      if(!isset($check->id)) { $j=0;  }
    }
       return response()->json([
        'message' => 'Invoice id',
        'data' => $payment_number,
        'isError' => false,
        'responseCode'=>200
    ], 200);
}


public  function paymentMethodsAll(Request $request){
	$data= $request->input();
       $PaymentMethods=   PaymentMethod::where('company_id', $data['company_id'])->select('payment_methods.*', 'payment_methods.name as text','payment_methods.name as label','payment_methods.id as value')->get();
       return response()->json([
        'message' => 'Paymen tMethods',
        'data' => $PaymentMethods,
        'isError' => false,
        'responseCode'=>200
    ], 200);
}



public  function tasks(Request $request){
	$data= $request->input();
 
       $tasks=   Task::where('company_id', $data['company_id'])->where('status', $data['type'])->orderBy('id','DESC')->paginate(10);
       return response()->json([
        'message' => 'tasks',
        'data' => $tasks,
        'isError' => false,
        'responseCode'=>200
    ], 200);
}


public  function taskAdd(Request $request){
                   $data=$request->input();
                   $validator =  Validator::make($request->all(),[
                    'task' => 'required',
                    'company_id' => 'required',
				    ]);
				    if($validator->fails()){
				        return response()->json([
				            'message' => 'validation_error',
				            'data' => $validator->errors(),
				            'isError' => true,
				            'responseCode'=>201
				        ], 401);
				    }
       $tasks=   Task::create(['task'=>$data['task'], 'company_id'=>$data['company_id']]);
       return response()->json([
        'message' => 'tasks',
        'data' => $tasks,
        'isError' => false,
        'responseCode'=>200
    ], 200);
}



public  function taskUpdate(Request $request){
	$data= $request->input();
    $tasks=[];
    if($data['status']=='Complete'){
    	       $tasks=   Task::where('company_id', $data['company_id'])->where('id', $data['id'])->update(['status'=>'Completed']);
    }
    if($data['status']=='Delete'){
    	        Task::where('company_id', $data['company_id'])->where('id', $data['id'])->delete();
    }

       return response()->json([
        'message' => 'tasks',
        'data' => $data,
        'isError' => false,
        'responseCode'=>200
    ], 200);
}

 public  function taxAdd(Request $request){
                   $data=$request->input();
                   $validator =  Validator::make($request->all(),[
                    'name' => 'required',
                    'percent' => 'required',
                     'company_id' => 'required',
				    ]);
				    if($validator->fails()){
				        return response()->json([
				            'message' => 'validation_error',
				            'data' => $validator->errors(),
				            'isError' => true,
				            'responseCode'=>201
				        ], 401);
				    }
       $tax=   Tax::create(['name'=>$data['name'],'description'=>$data['description'],'percent'=>$data['percent'], 'company_id'=>$data['company_id']]);
 

       return response()->json([
        'message' => 'Tax Successfully Created',
        'data' => $tax,
        'isError' => false,
        'responseCode'=>200
    ], 200);
 }
public function show()
    {
        $artisan = \Artisan::call('schedule:run');
        $output = \Artisan::output();
        return $output;
    }

}
