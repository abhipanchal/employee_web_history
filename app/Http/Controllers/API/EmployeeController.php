<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Model\Employee;
use App\Repositories\EmployeeRepository;
use Validator;
use Illuminate\Http\Request;
class EmployeeController extends BaseController {

    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository){
        $this->employeeRepository=$employeeRepository;
    }
    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'emp_id' => 'required',
            'epm_name' => 'required',
            'ip_address'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $employee=new Employee($input);
        $employee = $this->employeeRepository->store($employee);


        return $this->sendResponse($employee->toArray(), 'Employee added successfully.');
    }
    public  function getEmployee($ip_address){

        $employee=$this->employeeRepository->getByIP($ip_address);
        if (is_null($employee)) {
            return $this->sendError('Employee not found.');
        }

        return $this->sendResponse($employee->toArray(), 'Employee retrieved successfully.');
    }
    public function destroyEmployee($ip_address){
        $employee=$this->employeeRepository->deleteByIP($ip_address);
        if ($employee==0){
            $msg='Employee not found';
        }else{
            $msg='Employee deleted successfully.';
        }
        return $this->sendResponse(null, $msg);
    }
}