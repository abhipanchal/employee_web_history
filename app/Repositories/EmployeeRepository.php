<?php namespace App\Repositories;

use App\Model\Employee;
use App\Interfaces\EmployeeRepositoryInterface;


class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $course_category;
    protected $employee;
    protected $course_material;

    function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function store(Employee $employee)
    {
        $employee->save();
        return $employee;
    }
    public function getByIP($ip_address){
        $employee = Employee::where('ip_address',$ip_address)->where('deleted_at',null)->first();
        return $employee;
    }
    public function deleteByIP($ip_address){
        $employee=Employee::where('ip_address',$ip_address)->delete();
        return $employee;
    }
}