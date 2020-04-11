<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmployeeWebHistory extends Model
{
    protected $table = 'employee_web_history';

    protected $fillable = ['ip_address','url'];
}
