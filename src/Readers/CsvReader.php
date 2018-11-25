<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 16:51
 */

namespace App\Readers;

use App\Employee;


/**
 * Parses csv data
 *
 * Class CsvReader
 * @package App\Readers
 */
class CsvReader implements ResourceParserInterface
{

    public $resource=false;

    public function __construct($path = "resources/employees.csv")
    {
        $this->resource = file($path);
    }

    /**
     * Reads each line of the file and push new
     * Employee instance to Employees stack
     *
     * @return array
     */
    public function read()
    {
        $data = [];
        if($this->resource){
            $csv = array_map("str_getcsv", $this->resource);
            $keys = array_shift($csv);
            foreach ($csv as $i=>$row) {
                $csv[$i] = array_combine($keys, $row);
            }
        }
        foreach ($csv as $employee){
            if($this->validate($employee)){
                $data[] = new Employee($employee);
            }
        }
        return $data;
    }

    /**
     * Checks that data is not empty
     *
     * @param array $data
     * @return bool
     */
    protected function validate($data=[]){

        if(!empty($data['name']) and !empty($data['birthday']) and !empty($data['hired'] )){
            return true;
        }
        return false;
    }
}