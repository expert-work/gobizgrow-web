<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [
        'id', 'name', 'percent', 'description', 'company_id', 'created_at', 'updated_at'    ];

 
}
