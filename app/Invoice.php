<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'id', 'invoice_date', 'due_date', 'invoice_number', 'status', 'paid_status', 'notes', 'discount_type', 'discount', 'discount_val', 'sub_total','total_tax','total', 'due_amount', 'sent', 'viewed', 'company_id', 'customer_id','auth_token', 'created_at', 'updated_at' 
 
    ];

 
}
