<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Customer_note extends Model
{
    protected $fillable = [
        'id', 'customer_id', 'notes', 'created_at', 'updated_at','auth_token'    ];

 
}
