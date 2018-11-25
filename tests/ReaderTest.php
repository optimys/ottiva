<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 26-Nov-18
 * Time: 00:14
 */

class TestReader extends \PHPUnit\Framework\TestCase
{

    public $data;
    public $employee;

    public function setUp()
    {
        $this->data = [
            "birthday" => "11.12.1984",
            "hired" => "11.02.2013",
            "name" => "ALEX KALASHNIKOV",
            "special_contract" => 27
        ];

        $this->employee = new \App\Employee($this->data);
    }


    function testRead(){



        $reader = new \App\Readers\CsvReader("tests/employee.csv");
        $data = $reader->read();
        $this->assertEquals($this->employee->name,$data[0]->name);

        $reader->read();
    }

    public function tearDown()
    {
        // If you use Mockery in your tests you MUST use this method
        \Mockery::close();

        // clean up the memory taken by your instance of service
        $this->dataService = null;

        // Forces collection of any existing garbage cycles
        gc_collect_cycles();
    }

}