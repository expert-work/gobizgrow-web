<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class EstimateItem extends Model
{
    protected $fillable = ['id', 'name', 'price', 'quantity', 'total', 'estimate_id', 'item_id', 'company_id', 'created_at', 'updated_at','notes' ];

 
}
