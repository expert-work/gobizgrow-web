<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $fillable = ['id', 'estimate_date', 'due_date', 'estimate_number', 'status', 'notes', 'discount_type', 'discount', 'discount_val','total_tax', 'sub_total', 'total', 'sent', 'viewed', 'company_id', 'customer_id', 'auth_token', 'created_at', 'updated_at'  ];

 
}
