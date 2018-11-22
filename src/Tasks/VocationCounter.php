<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 22:30
 */

namespace App\Tasks;


use App\Employee;
use \App\Repositories\EmployeeRepository;
use App\Repositories\ResultsRepository;
use App\Result;

class VocationCounter implements TaskInterface
{
    protected $employees=[];
    protected $result = "";

    public function execute($data=[])
    {
        $this->employees = $data ? $data : EmployeeRepository::getAll();

        if(empty($this->employees)){
          throw new \Exception("No data provided");
        }

        $result = $this->getVocationDays();
        ResultsRepository::add($result);
        return ;
    }

    protected function getVocationDays(){
        $result = "Vocation days for current" .date("Y"). "year : \n";

        $filtered_data = $this->filterEmployees();
        dump($filtered_data);
        return new Result($result);
    }

    protected function filterEmployees(){
        return [
            'experienced' => array_filter($this->employees,function ($member){
                if ($member->is_experienced()){
                    $member->vocations_days += floor($member->get_experience/5);
                    return $member;
                }
            }),

            'newComers' => array_filter($this->employees,function ($member){
                return $member->is_newComer();
            }),

            'usual'=>array_filter($this->employees,function ($member){
                return $member->is_Usual();
            })
        ];
    }

}