<?php
namespace App\Interfaces;


use App\Model\Employee;

interface EmployeeRepositoryInterface
{
    public function store(Employee $employee);
    public function getByIP($ip_address);
    public function deleteByIP($ip_address);

}