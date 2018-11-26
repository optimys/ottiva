<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 26-Nov-18
 * Time: 12:05
 */

class ResultTest extends \PHPUnit\Framework\TestCase
{

    public  $resultObj;

    public function setUp()
    {
        $this->resultObj = new \App\Result('TEST TITLE');
        $this->resultObj->setResult("TEST DATA RESULT1");
        $this->resultObj->setResult("TEST DATA RESULT2");
        $this->resultObj->setResult("TEST DATA RESULT3");
    }

    public function test_that_getHeader_returns_right_title(){
        $this->assertEquals('TEST TITLE',$this->resultObj->getHeader());
    }


    public function test_that_getResult_method_returns_correct_array(){
        $this->assertContains("TEST DATA RESULT1",$this->resultObj->getResult());
        $this->assertContains("TEST DATA RESULT2",$this->resultObj->getResult());
        $this->assertContains("TEST DATA RESULT3",$this->resultObj->getResult());
        $this->assertNotContains("TEST DATA RESULT4",$this->resultObj->getResult());
    }

    public function test_that_getResult_method_returns_false_if_no_results(){
        $result = new \App\Result('TEST TITLE');
        $this->assertFalse($result->getResult());
    }

    public function tearDown()
    {
        \Mockery::close();
        $this->dataService = null;
        gc_collect_cycles();
    }
}