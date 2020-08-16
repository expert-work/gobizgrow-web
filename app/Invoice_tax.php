<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Invoice_tax extends Model {
     protected $fillable = [
        'id', 'name', 'tax_id', 'percent', 'tax_amount', 'invoice_id', 'company_id', 'created_at', 'updated_at' 
    ];
}
