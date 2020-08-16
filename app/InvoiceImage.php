<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class InvoiceImage extends Model
{
    protected $fillable = [
          'id', 'company_id', 'url','notes' ,'type', 'invoice_id', 'created_at', 'updated_at'
 
    ];

 
}
