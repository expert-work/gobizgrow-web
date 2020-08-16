<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Obd2  extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
       'id', '_id', 'brand', 'code', 'code_causes', 'code_description', 'code_description_expanded', 'code_symptoms', 'more_code_info', 'repair_critital', 'repair_self', 'code_warnings', 'when_error_occurs', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

 
}
