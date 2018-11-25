<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 26-Nov-18
 * Time: 00:22
 */

class EmployeeTest extends \PHPUnit\Framework\TestCase
{

    public $data;
    public $employee;

    public function setUp()
    {
        define("INPUT_YEAR",2018);
        $this->data = [
            "birthday" => "11.12.1984",
            "hired" => "11.02.2013",
            "name" => "ALEX KALASHNIKOV",
            "special_contract" => 27
        ];

        $this->employee = new \App\Employee($this->data);
    }


    public function test_getProperty()
    {

        $this->assertEquals("ALEX KALASHNIKOV",$this->employee->name);
        $this->assertEquals(27,$this->employee->vocation_days);
    }


    /**
     * @return int
     */
    public function testGet_age()
    {
        $this->assertEquals(33,$this->employee->get_age());
    }


    public function testGet_experience($dimension = "year")
    {
        $this->assertEquals(5,$this->employee->get_experience());
    }

    /**
     * checks employee who works less then 1 year
     *
     * @return bool
     */
    public function testIs_newComer()
    {
        $this->assertFalse($this->employee->is_newComer());
    }

    /**
     * checks employee who works 5 or more years and older then 29 years
     *
     * @return bool
     */
    public function testIs_experienced()
    {
        $this->assertTrue($this->employee->is_experienced());
    }

    /**
     * checks all the rest employees
     *
     * @return bool
     */
    public function testIs_usual()
    {
        $this->assertFalse($this->employee->is_usual());
    }

    /**
     * {@inheritdoc}
     */
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