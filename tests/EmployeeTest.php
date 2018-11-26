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
        define("INPUT_YEAR","Sun Nov 26 2018 15:06:55 GMT+0300");
        $this->data = [
            "birthday" => "11.12.1984",
            "hired" => "11.02.2013",
            "name" => "ALEX KALASHNIKOV",
            "special_contract" => 27
        ];

        $this->employee = new \App\Employee($this->data);
    }


    public function test_that_protected_properties_are_accessible()
    {
        $this->assertEquals("ALEX KALASHNIKOV",$this->employee->name);
        $this->assertEquals(27,$this->employee->vocation_days);
        $this->assertEquals(strtotime("11.12.1984"),$this->employee->birthday);
        $this->assertEquals(strtotime("11.02.2013"),$this->employee->hired);
    }


    public function test_that_get_age_returns_correct_age()
    {
        $this->assertEquals(33,$this->employee->get_age());
    }


    public function test_that_employee_experience_counts_correct()
    {
        $this->assertEquals(5,$this->employee->get_experience());
    }


    public function test_that_is_newComer_calculates_correct()
    {
        $this->assertFalse($this->employee->is_newComer());
    }

    /**
     * checks employee who works 5 or more years and older then 29 years
     *
     * @return bool
     */
    public function tes_that_is_experienced_method_works()
    {
        $this->assertTrue($this->employee->is_experienced());
    }

    /**
     * checks all the rest employees
     *
     * @return bool
     */
    public function test_that_is_usual_method_works()
    {
        $this->assertFalse($this->employee->is_usual());
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