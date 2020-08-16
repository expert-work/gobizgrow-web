<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'id',
        'name',
        'unit',
        'price',
        'company_id',
        'description',
        'auth_token'
    ];

 
}
