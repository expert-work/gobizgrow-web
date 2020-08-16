<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('login', 'ApiController@LoginUsers');
Route::post('registers', 'ApiController@RegistersUsers');
Route::post('forgot/password', 'ApiController@resetPassword');
Route::post('industries', 'ApiController@Industries');


Route::post('get-customers', 'select2Controller@getCustomers');
Route::post('get-items', 'select2Controller@getItems');
Route::post('get-items-all', 'ApiController@getItemsAll');

Route::post('get-invoices-by-customer_id', 'select2Controller@getInvoicesByCustomerId');
Route::post('get-expenses-categories-all', 'select2Controller@expensesCategoriesAll');
Route::post('get-categories-all', 'select2Controller@getCategoriesAll');
Route::post('get-customer-all', 'select2Controller@getCustomersAll');

Route::get('get-taxes-all', 'select2Controller@getTaxesAll');






Route::post('get-estimate-unique_id', 'ApiController@getEstimateID');
Route::post('get-invoice-unique_id', 'ApiController@getInvoiceID');
Route::post('get-payment-unique_id', 'ApiController@getPaymentID');

Route::get('get-estimate-unique_id', 'ApiController@getEstimateID');
Route::get('get-invoice-unique_id', 'ApiController@getInvoiceID');
Route::get('get-payment-unique_id', 'ApiController@getPaymentID');




Route::post('get-units-all', 'select2Controller@getUnitsAll');
Route::get('get-units-all', 'select2Controller@getUnitsAll');



 
Route::get('customers/all', 'ApiController@customersAll');
Route::post('customers/add', 'ApiController@customersAdd');
Route::post('customers/edit/{auth_token}', 'ApiController@customersEdit');
Route::post('customers/delete/{auth_token}', 'ApiController@customersDelete');

Route::get('items/all', 'ApiController@itemAll');
Route::post('items/add', 'ApiController@itemsAdd');



Route::post('items/edit/', 'ApiController@itemsEdit');
Route::post('items/delete/{auth_token}', 'ApiController@itemsDelete');


Route::get('units/all', 'ApiController@unitsAll');
Route::post('units/add', 'ApiController@unitsAdd');
Route::post('units/edit/{auth_token}', 'ApiController@unitsEdit');
Route::post('units/delete/{auth_token}', 'ApiController@unitsDelete');


Route::get('payments/all', 'ApiController@paymentAll');
Route::post('payments/add', 'ApiController@paymentAdd');
Route::post('payments/edit', 'ApiController@paymentEdit');
Route::post('payments/delete/{auth_token}', 'ApiController@paymentDelete');

 








Route::get('categories/all', 'ApiController@categoriesAll');
Route::post('categories/add', 'ApiController@categoriesAdd');
Route::post('categories/edit', 'ApiController@categoriesEdit');

  

Route::get('invoices/all', 'ApiController@invoicesAll');
Route::get('invoices/draft', 'ApiController@invoicesDraft');
Route::get('invoices/due', 'ApiController@invoicesDue');

Route::post('invoices/delete', 'ApiController@invoicesDelete');
Route::post('invoices/clone', 'ApiController@invoicesClone');
Route::post('invoices/mark-as-sent', 'ApiController@invoicesMarkAsSent');
Route::post('invoices/send-invoice', 'ApiController@invoicesSend');


 

Route::post('invoices/add', 'ApiController@invoicesAdd');
Route::post('invoices/edit', 'ApiController@invoicesEdit');


Route::get('estimates/all', 'ApiController@estimatesAll');
Route::get('estimates/draft', 'ApiController@estimatesDraft');
Route::get('estimates/sent', 'ApiController@estimatesSent');
Route::post('estimates/delete', 'ApiController@estimatesDelete');
Route::post('estimates/add', 'ApiController@estimatesAdd');
Route::post('estimates/edit', 'ApiController@estimatesEdit');

Route::post('estimates/convert-to-invoice', 'ApiController@convertToInvoice');
Route::post('estimates/mark-as-sent', 'ApiController@estimateMarkAsSent');
Route::post('estimates/send-estimate', 'ApiController@estimatesSend');
Route::post('estimates/mark-as-accepted', 'ApiController@estimateMarkAsAccepted');
Route::post('estimates/mark-as-rejected', 'ApiController@estimateMarkAsRejected');


Route::get('expenses/all', 'ApiController@expensesAll');
Route::get('expenses-categories/all', 'ApiController@expensesCategoriesAll');
Route::post('expenses-categories/add', 'ApiController@expensesCategoriesAdd');
Route::post('expenses-categories/edit/{auth_token}', 'ApiController@expensesCategoriesEdit');
Route::post('expenses/add', 'ApiController@expensesAdd');
Route::post('expenses/edit', 'ApiController@expensesEdit');

 

Route::get('get-items-category-price', 'ApiController@getItemsCategoryPrice');


Route::get('expenses', 'ApiController@expenses');
Route::post('expenses/new', 'ApiController@expensesNew');
Route::post('expenses/delete/{auth_token}', 'ApiController@expensesDelete');

Route::post('uploads', 'ApiController@uploads');

Route::post('payment-methods/all', 'ApiController@paymentMethodsAll');
Route::get('tasks/all', 'ApiController@tasks');
Route::post('tasks/update', 'ApiController@taskUpdate');
Route::post('tasks/add', 'ApiController@taskAdd');
 

Route::post('taxes/add', 'ApiController@taxAdd');
