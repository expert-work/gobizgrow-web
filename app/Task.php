<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'id', 'task', 'company_id', 'status', 'created_at', 'updated_at'
    ];

 
}
