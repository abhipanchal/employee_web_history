<?php
namespace App\Interfaces;


interface EmployeeWebHistoryRepositoryInterface
{
    public function store($input);
    public function getByIPWebHistory($ip_address);
    public function deleteHistory($ip_address);

}