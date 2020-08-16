<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [  'id', 'payment_number', 'payment_date', 'notes', 'amount', 'customer_id', 'invoice_id', 'company_id', 'payment_method_id', 'auth_token', 'created_at', 'updated_at' ];

 
}
