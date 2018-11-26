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


    function test_that_read_method_able_to_read_csv_file(){
        $reader = new \App\Readers\CsvReader("tests/employee.csv");
        $data = $reader->read();
        $this->assertEquals($this->employee,$data[0]);

        $reader->read();
    }

    function test_that_validate_method_can_validate_data(){
        $reader = new \App\Readers\CsvReader("tests/employee.csv");
        $this->assertTrue($reader->validate($this->data));
        $this->assertFalse($reader->validate([]));
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        \Mockery::close();
        $this->dataService = null;
        gc_collect_cycles();
    }

}