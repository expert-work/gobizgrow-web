<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['id','customer_id', 'make', 'model', 'year', 'color', 'mileage', 'notes', 'company_id', 'auth_token'];

 
}
