<?php namespace App\Repositories;

use App\Interfaces\EmployeeWebHistoryRepositoryInterface;
use App\Model\Employee;
use App\Model\EmployeeWebHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;


class EmployeeWebHistoryRepository implements EmployeeWebHistoryRepositoryInterface
{
    protected $employee;
    protected $employeeWebHistory;

    function __construct(Employee $employee,EmployeeWebHistory $employeeWebHistory)
    {
        $this->employee = $employee;
        $this->employeeWebHistory = $employeeWebHistory;
    }

    public function store($input)
    {
        $ip_address=$input['ip_address'];
        $employee = Employee::where('ip_address',$ip_address)->where('deleted_at',null)->first();
        if($employee==null){
            return false;
        }else{
            $employee_web_history = EmployeeWebHistory::create($input);
            $employee_web_history->save();
            return $employee_web_history;
        }
    }
    public function getByIPWebHistory($ip_address){
        $employeeWebHistory = EmployeeWebHistory::where('ip_address',$ip_address)->get();
        return $employeeWebHistory;
    }
    public function deleteHistory($ip_address){
        $employeeWebHistory=EmployeeWebHistory::where('ip_address',$ip_address)->delete();
        return $employeeWebHistory;
    }
}