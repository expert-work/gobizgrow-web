<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model {
     protected $fillable = [
       'id', 'user_id', 'welcome_email', 'first_invoice_email', 'created_at', 'updated_at'
    ];



}
