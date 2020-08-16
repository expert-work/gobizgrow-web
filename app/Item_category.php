<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Item_category extends Model
{
    protected $fillable = [
        'id',
        'item_id',
        'category_id',
        'price',
        'company_id',
     ];

 
}
