<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $table = 'employees';

    protected $dates = ['deleted_at'];
    protected $fillable = ['emp_id','emp_name','ip_address'];



}
