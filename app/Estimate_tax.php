<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Estimate_tax extends Model {
     protected $fillable = [
        'id', 'name', 'tax_id', 'percent', 'tax_amount', 'estimate_id', 'company_id', 'created_at', 'updated_at' 
    ];
}
