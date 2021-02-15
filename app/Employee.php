<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'email', 'numberphone','sallary','attend_time','sinout_time','tawzef_date'
    ];
}
