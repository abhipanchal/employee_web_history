<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\EmployeeController;
use App\Model\Employee;
use App\Repositories\EmployeeRepository;
use Illuminate\Console\Command;


class SETempdata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SETempdata {emp_id} {epm_name} {ip_address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add employee data to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository=$employeeRepository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $employee=new Employee;
        $employee['emp_id']=$this->argument('emp_id');
        $employee['epm_name']=$this->argument('epm_name');
        $employee['ip_address']=$this->argument('ip_address');
        $employee = $this->employeeRepository->store($employee);
        $response = [
            'success' => true,
            'data'    => $employee,
            'message' => 'Employee added successfully.',
        ];
        $this->info(response()->json($response, 200));
    }
}
