<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
          'id', 'name', 'price', 'quantity', 'total', 'invoice_id', 'item_id', 'company_id', 'created_at', 'updated_at','notes'
 
    ];

 
}
