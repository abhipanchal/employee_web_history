<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Repositories\EmployeeWebHistoryRepository;
use Validator;
use Illuminate\Http\Request;
class EmployeeWebHistoryController extends BaseController {

    protected $employeeWebHistoryRepository;

    public function __construct(EmployeeWebHistoryRepository $employeeWebHistoryRepository){
        $this->employeeWebHistoryRepository=$employeeWebHistoryRepository;
    }
    public function setHistory(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'ip_address' => 'required',
            'url' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $employee = $this->employeeWebHistoryRepository->store($input);
        if($employee==false){
            return $this->sendResponse(null, 'Employee not found having'. $input['ip_address'].'IP address.');

        }else{
            return $this->sendResponse($employee->toArray(), 'Employee added successfully.');
        }
    }
    public  function getEmployeeWebHistory($ip_address){

        $employeeWebHistory=$this->employeeWebHistoryRepository->getByIPWebHistory($ip_address);
        if (is_null($employeeWebHistory)) {
            return $this->sendError('History not found.');
        }
        return $this->sendResponse($employeeWebHistory->toArray(), 'History retrieved successfully.');
    }
    public function destroyEmployeeWebHistory($ip_address){
        $employeeWebHistory=$this->employeeWebHistoryRepository->deleteHistory($ip_address);
        if ($employeeWebHistory==0){
            $msg='History not found';
        }else{
            $msg='History deleted successfully.';

        }
        return $this->sendResponse(null, $msg);
    }
}