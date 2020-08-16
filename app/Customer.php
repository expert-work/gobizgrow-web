<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
       'id', 'name', 'email', 'phone', 'street_address', 'city', 'state', 'zip_code', 'customer_notes', 'auth_token', 'company_id', 'created_at', 'updated_at','is_delete'
    ];

 
}
