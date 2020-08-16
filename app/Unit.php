<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model {
     protected $fillable = [
        'id', 'name', 'company_id','auth_token'
    ];



}
