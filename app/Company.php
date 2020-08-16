<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'id',
        'name',
        'logo',
        'phone',
        'country',
        'state',
        'city',
        'zip',
        'address',
        'address1',
        'company_info',
        'auth_token'
 
    ];

 
}
