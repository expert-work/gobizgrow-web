<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class HourOperation extends Model
{
    protected $fillable = [
        'id', 'company_id','monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'created_at', 'updated_at','monday_from', 'monday_to', 'tuesday_from', 'tuesday_to', 'wednesday_from', 'wednesday_to', 'thursday_from', 'thursday_to', 'friday_from', 'friday_to', 'saturday_from', 'saturday_to', 'sunday_from', 'sunday_to'
        
 
    ];

 
}
