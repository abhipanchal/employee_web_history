<?php

namespace App\Console\Commands;

use App\Repositories\EmployeeRepository;
use Illuminate\Console\Command;

class UNSETempdata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UNSETempdata {ip_address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete employee by ip_address';

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
        $employee=$this->employeeRepository->deleteByIP($this->argument('ip_address'));
        if ($employee==0){
            $msg='Employee not found';
        }else{
            $msg='Employee deleted successfully.';
        }
        $response = [
            'success' => true,
            'data'    => null,
            'message' => $msg,
        ];
        $this->info(response()->json($response, 200));

    }
}
