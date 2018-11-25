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