<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 26-Nov-18
 * Time: 01:04
 */

class HelpersTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {

    }

    public function test_config_function_can_return_correct_data(){
        $this->assertEquals(26,config('vocation_days'));
        $this->assertFalse(config('not_existing_key'));
    }

    public function test_that_dateDiff_able_to_calculate_diff_dates(){
        define("INPUT_YEAR","Sun Nov 26 2018 15:06:55 GMT+0300");

        $compare_year = 1416997631; //26.11.2014 13:26:16
        $this->assertEquals(4,dateDiff($compare_year));
        $this->assertEquals(48,dateDiff($compare_year,'month'));
        $this->assertEquals(1467,dateDiff($compare_year,'days'));

    }

    public function test_that_dateDiff_returns_exeption_with_invalid_dimension_param(){
        define("INPUT_YEAR","Sun Nov 26 2018 15:06:55 GMT+0300");
        $compare_year = 1416997631; //26.11.2014 13:26:16
        $this->expectException(Exception::class);
        dateDiff($compare_year,'not_existing_dimension');
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