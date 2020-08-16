<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model {
     protected $fillable = [
        'id', 'name', 'company_id','auth_token'
    ];



}
