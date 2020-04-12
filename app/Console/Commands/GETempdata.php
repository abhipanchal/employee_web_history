<?php

namespace App\Console\Commands;

use App\Repositories\EmployeeRepository;
use Illuminate\Console\Command;

class GETempdata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GETempdata {ip_address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrive data of employee by ip_address';

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
        $employee=$this->employeeRepository->getByIP($this->argument('ip_address'));
        if (is_null($employee)) {
            $response = [
                'success' => false,
                'message' => 'Employee not found.',
            ];
            $this->info(response()->json($response, 404));
        }
        $response = [
            'success' => true,
            'data'    => $employee,
            'message' => 'Employee retrieved successfully.',
        ];
        $this->info(response()->json($response, 200));

    }
}
