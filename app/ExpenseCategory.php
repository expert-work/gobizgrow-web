<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = [
    'id', 'name', 'description', 'company_id', 'auth_token', 'created_at', 'updated_at'    ];

}
