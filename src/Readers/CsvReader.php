<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 16:51
 */

namespace App\Readers;

//TODO add phpdoc
use App\Employee;
use App\Repositories\EmployeeRepository;
use Carbon\Carbon;

class CsvReader implements ResourceParserInterface
{

    public $resource=false;


    /*
     *
     */
    public function __construct($path = "resources/employees.csv")
    {
        $this->resource = file($path);
    }

    /*
     *
     */
    public function read()
    {
        if($this->resource){
            $csv = array_map("str_getcsv", $this->resource);
            $keys = array_shift($csv);
            foreach ($csv as $i=>$row) {
                $csv[$i] = array_combine($keys, $row);
            }
        }
        foreach ($csv as $employee){
            if($this->validate($employee)){
                EmployeeRepository::add(new Employee($employee));
            }
        }
        return;
    }

    protected function validate($data=[]){

        if(!empty($data['name']) and !empty($data['birthday']) and !empty($data['hired'] )){
            return true;
        }
        return false;
    }
}