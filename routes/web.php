<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/test-unique', 'ShopAdminController@generateUniqueInvoiceId');
Route::get('/test', function(){
	$d= TwilioSendSMS('+18049296961', 'Hi Sir, its a test message');
 echo "<pre>";
	print_r($d);
});


Route::get('/shop-admins', 'SuperAdminController@shopAdmin');
Route::get('/shop-admins/new', 'SuperAdminController@shopAdminNew');
Route::post('/shop-admins/new', 'SuperAdminController@shopAdminNew');
Route::get('/shop-admins/edit/{id}', 'SuperAdminController@shopAdminEdit');
Route::post('/shop-admins/edit/{id}','SuperAdminController@shopAdminEdit');
Route::get('/shop-admins/delete/{id}','SuperAdminController@shopAdminDelete');


Route::get('/industries', 'SuperAdminController@industries');
Route::get('/industries/new', 'SuperAdminController@industriesNew');
Route::post('/industries/new', 'SuperAdminController@industriesNew');
Route::get('/industries/edit/{id}', 'SuperAdminController@industriesEdit');
Route::post('/industries/edit/{id}','SuperAdminController@industriesEdit');
Route::get('/industries/delete/{id}','SuperAdminController@industriesDelete');


Route::get('/employees', 'SuperAdminController@employees');
Route::get('/employees/new', 'SuperAdminController@employeesNew');
Route::post('/employees/new', 'SuperAdminController@employeesNew');
Route::get('/employees/edit/{id}', 'SuperAdminController@employeesEdit');
Route::post('/employees/edit/{id}','SuperAdminController@employeesEdit');
Route::get('/employees/delete/{id}','SuperAdminController@employeesDelete');



Route::get('/profile','ProfileController@index');
Route::post('/profile','ProfileController@index');
Route::post('/profile/photo','ProfileController@uploadImage');
Route::post('/profile/changepass','ProfileController@changePassword');


Route::get('/customers', 'ShopAdminController@customers');
Route::get('/customers/view/{auth_token}', 'ShopAdminController@customersView');
Route::post('/customers/view/{auth_token}', 'ShopAdminController@customersView');

Route::get('/customer_notes/delete/{auth_token}', 'ShopAdminController@customerNoteDelete');

 


Route::get('/customers/new', 'ShopAdminController@customersNew');
Route::post('/customers/new', 'ShopAdminController@customersNew');
Route::get('/customers/edit/{auth_token}', 'ShopAdminController@customersEdit');
Route::post('/customers/edit/{auth_token}','ShopAdminController@customersEdit');
Route::get('/customers/delete/{auth_token}','ShopAdminController@customersDelete');
Route::post('multidelete','ShopAdminController@customersMultidelete');



Route::get('/invoices', 'ShopAdminController@invoices');
Route::get('/invoices/drafts', 'ShopAdminController@invoicesDrafts');
Route::get('/invoices/dues', 'ShopAdminController@invoicesDues');

Route::get('/invoices/new', 'ShopAdminController@invoicesNew');
Route::post('/invoices/new', 'ShopAdminController@invoicesNew');
Route::get('/invoices/edit/{auth_token}', 'ShopAdminController@invoicesEdit');
Route::post('/invoices/edit/{auth_token}','ShopAdminController@invoicesEdit');
Route::get('/invoices/delete/{auth_token}','ShopAdminController@invoicesDelete');
Route::get('/invoices/pdfview','ShopAdminController@pdfview');
Route::get('/invoices/view/{auth_token}', 'ShopAdminController@invoicesView');

Route::get('/invoices/send/{auth_token}', 'PdfController@invoicesSend');

Route::get('/invoices/mark-as-sent/{auth_token}', 'ShopAdminController@invoicesMarkAsSent');

Route::get('/invoices/record-payment/{auth_token}', 'ShopAdminController@invoicesRecordPayment');
Route::post('/invoices/record-payment/{auth_token}', 'ShopAdminController@invoicesRecordPayment');
 

Route::get('/invoices/clone/{auth_token}', 'ShopAdminController@invoicesClone');


Route::get('/expenses', 'ShopAdminController@expenses');
Route::get('/expenses/new', 'ShopAdminController@expensesNew');
Route::post('/expenses/new', 'ShopAdminController@expensesNew');
Route::get('/expenses/edit/{auth_token}', 'ShopAdminController@expensesEdit');
Route::post('/expenses/edit/{auth_token}','ShopAdminController@expensesEdit');
Route::get('/expenses/delete/{auth_token}','ShopAdminController@expensesDelete');


Route::get('/expenses-categories', 'ShopAdminController@expensescategories');
Route::get('/expenses-categories/new', 'ShopAdminController@expensescategoriesNew');
Route::post('/expenses-categories/new', 'ShopAdminController@expensescategoriesNew');
Route::get('/expenses-categories/edit/{auth_token}', 'ShopAdminController@expensescategoriesEdit');
Route::post('/expenses-categories/edit/{auth_token}','ShopAdminController@expensescategoriesEdit');
Route::get('/expenses-categories/delete/{auth_token}','ShopAdminController@expensescategoriesDelete');

Route::get('/units', 'ShopAdminController@units');
Route::get('/units/new', 'ShopAdminController@unitsNew');
Route::post('/units/new', 'ShopAdminController@unitsNew');
Route::get('/units/edit/{auth_token}', 'ShopAdminController@unitsEdit');
Route::post('/units/edit/{auth_token}','ShopAdminController@unitsEdit');
Route::get('/units/delete/{auth_token}','ShopAdminController@unitsDelete');


Route::get('/items', 'ShopAdminController@items');
Route::get('/items/new', 'ShopAdminController@itemsNew');
Route::post('/items/new', 'ShopAdminController@itemsNew');
Route::get('/items/edit/{auth_token}', 'ShopAdminController@itemsEdit');
Route::post('/items/edit/{auth_token}','ShopAdminController@itemsEdit');
Route::get('/items/delete/{auth_token}','ShopAdminController@itemsDelete');

Route::get('/categories', 'ShopAdminController@categories');
Route::get('/categories/new', 'ShopAdminController@categoriesNew');
Route::post('/categories/new', 'ShopAdminController@categoriesNew');
Route::get('/categories/edit/{auth_token}', 'ShopAdminController@categoriesEdit');
Route::post('/categories/edit/{auth_token}','ShopAdminController@categoriesEdit');
Route::get('/categories/delete/{auth_token}','ShopAdminController@categoriesDelete');

Route::get('/estimates', 'ShopAdminController@estimates');
Route::get('/estimates/sent', 'ShopAdminController@estimatesSent');
Route::get('/estimates/draft', 'ShopAdminController@estimatesDrafts');
Route::get('/estimates/view/{auth_token}', 'ShopAdminController@estimatesView');

Route::get('/estimates/new', 'ShopAdminController@estimatesNew');
Route::post('/estimates/new', 'ShopAdminController@estimatesNew');
Route::get('/estimates/edit/{auth_token}','ShopAdminController@estimateEdit');
Route::post('/estimates/edit/{auth_token}','ShopAdminController@estimateEdit');
Route::get('/estimates/clone/{auth_token}','ShopAdminController@estimateClone');







Route::get('/estimates/delete/{auth_token}', 'ShopAdminController@estimatesDelete');
Route::get('/estimates/send/{auth_token}', 'PdfController@estimatesSend');
Route::get('/estimates/convert-to-invoice/{auth_token}', 'ShopAdminController@estimatesConvertToInvoice');
Route::get('/estimates/mark-as-sent/{auth_token}', 'ShopAdminController@estimatesMarkAsSent');
Route::get('/estimates/mark-as-accepted/{auth_token}', 'ShopAdminController@estimatesMarkAsAccepted');
Route::get('/estimates/mark-as-rejected/{auth_token}', 'ShopAdminController@estimatesMarkAsRejected');















Route::get('/payments', 'ShopAdminController@payments');
Route::get('/payments/new', 'ShopAdminController@paymentsNew');

Route::get('/payments/new/{auth_token}', 'ShopAdminController@paymentsNew');
Route::post('/payments/new/{auth_token}', 'ShopAdminController@paymentsNew');


Route::post('/payments/new', 'ShopAdminController@paymentsNew');
Route::get('/payments/edit/{auth_token}', 'ShopAdminController@paymentsEdit');
Route::post('/payments/edit/{auth_token}','ShopAdminController@paymentsEdit');


Route::get('/payment-methods', 'ShopAdminController@paymentMethods');
Route::get('/payment-methods', 'ShopAdminController@paymentMethods');
Route::get('/payment-methods/new', 'ShopAdminController@paymentMethodNew');
Route::post('/payment-methods/new', 'ShopAdminController@paymentMethodNew');



Route::get('/payment-methods/delete/{auth_token}','ShopAdminController@paymentMethodDelete');



Route::get('/payment-methods/edit/{auth_token}','ShopAdminController@paymentMethodEdit');
Route::post('/payment-methods/edit/{auth_token}','ShopAdminController@paymentMethodEdit');




Route::get('/payments/view/{auth_token}','ShopAdminController@paymentsView');



 Route::get('/payments/delete/{auth_token}','ShopAdminController@paymentsDelete');


Route::get('/company-infos', 'ShopAdminController@companyinfos');
Route::post('/company-infos','ShopAdminController@companyinfos');

Route::get('/tax-types', 'ShopAdminController@taxtypes');
Route::get('/tax-types/new', 'ShopAdminController@taxtypesNew');
Route::post('/tax-types/new','ShopAdminController@taxtypesNew');
Route::get('/tax-types/edit/{id}', 'ShopAdminController@taxtypesEdit');
Route::post('/tax-types/edit/{id}','ShopAdminController@taxtypesEdit');
Route::get('/tax-types/delete/{id}','ShopAdminController@taxtypesDelete');

Route::get('/test-pdf','PdfController@export_pdf');
Route::get('/invoice-pdf/{auth_token}','PdfController@invoicePdf');
Route::get('/estimate-pdf/{auth_token}','PdfController@estimatePdf');
Route::get('/payment-pdf/{auth_token}','PdfController@paymentPdf');

Route::get('/connect-db/','PdfController@connectDB');


Route::post('web-api/strip-pay','ShopAdminController@stripPay');
Route::get('web-api/strip-pay','ShopAdminController@stripPay');
Route::get('web-api/add-task','ShopAdminController@addTask');
Route::get('web-api/add-task-complete','ShopAdminController@addTaskComplete');
Route::get('web-api/add-task-delete','ShopAdminController@addTaskDelete');

Route::post('web-api/add-update-vehicle','ShopAdminController@addUpdateVehicle');
Route::get('web-api/delete-vehicle','ShopAdminController@deleteVehicle');


Route::get('reports/sales','ReportController@reportSales');
Route::get('reports/profit-loss','ReportController@reportProfitLoss');
Route::get('reports/expenses','ReportController@reportExpensess');
Route::get('reports/taxes','ReportController@reportTaxes');


Route::get('/pdf/reports/taxes','PdfController@reportTaxes');
Route::get('/pdf/reports/expensess','PdfController@reportExpensess');
Route::get('/pdf/reports/profit-loss','PdfController@reportProfitLoss');
Route::get('/pdf/reports/sales','PdfController@reportSales');
 



Route::get('/obd2-brands','Obd2Controller@obd2Brand');
Route::get('/obd2-codes','Obd2Controller@obd2Codes');
Route::get('/web-api/obd2-by-id','Obd2Controller@obd2ById');


Route::get('/automotive-dictionary','DictionaryController@automotiveDictionary');
Route::get('/automotive-dictionary-words','DictionaryController@automotiveDictionaryWords');


Route::post('/cancel-subcription','ShopAdminController@cancelSubcription');
Route::get('/cancel-subcription','ShopAdminController@cancelSubcription');



///STRIPE

Route::get('connect/stripe-outh','StripeController@connectAccountResponse');
Route::get('recent-accounts/','StripeController@recentAccounts');
Route::post('create-payment-intent/','StripeController@createPaymentIntent');
Route::get('collect','StripeController@collectStripe');




Route::get('/stripe-test/', function(){
	         \Stripe\Stripe::setApiKey('sk_test_3XRQ95xkBL4tKqn81hZkkm0e');
        $customer = \Stripe\Customer::retrieve("cus_HeTN3MaPlUFBaO");
$subscription = $customer->subscriptions->retrieve("sub_HeTNNenKBvwYkf");

print_r($subscription);
});




