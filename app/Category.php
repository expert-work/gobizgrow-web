<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description',
        'company_id',
        'auth_token'
     ];

 
}
