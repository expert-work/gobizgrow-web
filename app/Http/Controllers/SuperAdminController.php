<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Industry;
use App\Item;
use App\Category;
use App\Unit;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth ;
class SuperAdminController extends Controller
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
 
    public function shopAdmin(){   
 
    	$page_name="Shop Admin";
        $users = User::where('role','shop_admin')->orderBy('id','DESC')->paginate(15);
        return view('super-admin.shop-admin', compact('page_name','users'));
    }

    public function shopAdminNew(Request $request)
    {    
         $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'industry' => 'required',
            'phone' => 'required|min:10',
            'password' => 'required|min:8'
            ]);
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'industry' => $data['industry'],
                'password' => bcrypt($data['password']),
             ]); 
            return redirect('shop-admins')->with('success','Shop Admin successfully Added!');
          }
         $page_name="New Shop Admin";
         $industries = Industry::orderBy('id','DESC')->get();
         return view('super-admin.shop-admin-new', compact('page_name','industries'));
    }

    public function shopAdminEdit(Request $request,$id){
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            'name' => 'required',
            'industry' => 'required',
            'phone' => 'required|min:10',
              ]);
            User::where('id',$id)
                  ->update([
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'industry' => $data['industry'],
                  ]); 
            return back()->with('success','Shop Admin successfully Updated!');
          }
        $page_name="Edit Shop Admin";
        $user = User::where('id', $id)->first();
        $industries = Industry::orderBy('id','DESC')->get();
        return view('super-admin.shop-admin-edit', compact('page_name','user','industries'));
    }

    public function shopAdminDelete($id) {
         User::where('id',$id)->delete();
         return back()->with('error','Deleted successfully!');
    }
 
    public function industries(){   $page_name="Industries";
          $industries = Industry::orderBy('id','DESC')->paginate(15);
          return view('super-admin.industries', compact('page_name','industries'));
    }

    public function industriesNew(Request $request){  
     $page_name="New Industry";
     $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            'industry_name' => 'required',
            ]);
            Industry::create([ 'industry_name' => $data['industry_name']]); 
            return redirect('industries')->with('success','Industry successfully Added!');
          }
      return view('super-admin.industries-new', compact('page_name'));
    }
    

 public function industriesEdit(Request $request,$id){
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
              'industry_name' => 'required',
              ]);
            Industry::where('id',$id)->update([ 'industry_name' => $data['industry_name']]); 
            return back()->with('success','Industry successfully Updated!');
          }
        $page_name="Edit Industry";
        $industry = Industry::where('id', $id)->first();
        return view('super-admin.industries-edit', compact('page_name','industry'));
    }
    public function industriesDelete($id) {
         Industry::where('id',$id)->delete();
         return back()->with('error','Deleted successfully!');
    }


public function employees(){
  $page_name="Employee";
        $users = User::where('role','employee')->orderBy('id','DESC')->paginate(15);
        return view('super-admin.employees', compact('page_name','users'));
}
public function employeesNew(Request $request){
  $page_name="Employee";

        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'phone' => 'required|min:10',
            'password' => 'required|min:8'
            ]);
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
                'role' => 'employee',
             ]); 


            return redirect('employees')->with('success','Employee successfully Added!');
          }
        
        return view('super-admin.employees-new', compact('page_name'));
}
public function employeesEdit(Request $request,$id){
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            'name' => 'required',
            
            'phone' => 'required|min:10',
              ]);
            User::where('id',$id)
                  ->update([
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    
                  ]); 
            return back()->with('success','Employee successfully Updated!');
          }

        $page_name="Edit Employee";
        $user = User::where('id', $id)->first();
        return view('super-admin.employees-edit', compact('page_name','user'));
    }
     public function employeesDelete($id) {
         User::where('id',$id)->delete();
         return back()->with('error','Deleted successfully!');
    }




    public function items(){
  $page_name="Item";
        $items = Item::orderBy('id','DESC')->paginate(15);
        return view('super-admin.items', compact('page_name','items'));
}

public function itemsNew(Request $request){
  $page_name="Item";
 $units = Unit::orderBy('id','DESC')->get();
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'company' => 'required',
            'unit' => 'required'
            ]);
            Item::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'company_id' => ($data['company']),
                'unit' => $data['unit']
             ]); 


            return redirect('items')->with('success','Item successfully Added!');
          }
        
        return view('super-admin.items-new', compact('page_name','units'));
}

public function itemsEdit(Request $request,$id){
        $data=$request->input();
        $units = Unit::orderBy('id','DESC')->get();
         if(count($data)){
            $this->validate($request, [
             'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'company' => 'required',
            'unit' => 'required'
              ]);
            Item::where('id',$id)
                  ->update([
                     'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'company_id' => ($data['company']),
                   'unit' => $data['unit']
                  ]); 
            return back()->with('success','Item successfully Updated!');
          }

        $page_name="Edit Item";
        $item = Item::where('id', $id)->first();
        return view('super-admin.items-edit', compact('page_name','item','units'));
    }

     public function itemsDelete($id) {
         Item::where('id',$id)->delete();
         return back()->with('error','Deleted successfully!');
    }

public function categories(){
  $page_name="Category";
        $categories = Category::orderBy('id','DESC')->paginate(15);
        return view('super-admin.categories', compact('page_name','categories'));
}

public function categoriesNew(Request $request){
  $page_name="Category";

        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            
            'name' => 'required',
            'description' => 'required',
            'company' => 'required',
            ]);
            Category::create([
                'name' => $data['name'],
                'description' => $data['description'],
                
                'company_id' => ($data['company']),
                
             ]); 


            return redirect('categories')->with('success','Category successfully Added!');
          }
        
        return view('super-admin.categories-new', compact('page_name'));
}

public function categoriesEdit(Request $request,$id){
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
             'name' => 'required',
            'description' => 'required',
            
            'company' => 'required',
              ]);
            Category::where('id',$id)
                  ->update([
                     'name' => $data['name'],
                'description' => $data['description'],
                
                'company_id' => ($data['company']),
                   
                  ]); 
            return back()->with('success','Category successfully Updated!');
          }

        $page_name="Edit Category";
        $category = Category::where('id', $id)->first();
        return view('super-admin.categories-edit', compact('page_name','category'));
    }

     public function categoriesDelete($id) {
         Category::where('id',$id)->delete();
         return back()->with('error','Deleted successfully!');
    }

public function units(){
  $page_name="Unit";
        $units = Unit::orderBy('id','DESC')->paginate(15);
        return view('super-admin.units', compact('page_name','units'));
}

public function unitsNew(Request $request){
  $page_name="Unit";

        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
            
            'name' => 'required',
            
            'company' => 'required',
            ]);
            Unit::create([
                'name' => $data['name'],
             
                'company_id' => ($data['company']),
                
             ]); 


            return redirect('units')->with('success','Unit successfully Added!');
          }
        
        return view('super-admin.units-new', compact('page_name'));
}

public function unitsEdit(Request $request,$id){
        $data=$request->input();
         if(count($data)){
            $this->validate($request, [
             'name' => 'required',
            
            'company' => 'required',
              ]);
            Unit::where('id',$id)
                  ->update([
                     'name' => $data['name'],
               
                'company_id' => ($data['company']),
                   
                  ]); 
            return back()->with('success','Unit successfully Updated!');
          }

        $page_name="Edit Unit";
        $unit = Unit::where('id', $id)->first();
        return view('super-admin.units-edit', compact('page_name','unit'));
    }

     public function unitsDelete($id) {
         Unit::where('id',$id)->delete();
         return back()->with('error','Deleted successfully!');
    }




}
