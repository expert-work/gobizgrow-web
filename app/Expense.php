<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [ 'id', 'expense_date', 'attachment_receipt', 'amount', 'notes', 'expense_category_id', 'company_id', 'auth_token', 'created_at', 'updated_at'    ];

 
}
