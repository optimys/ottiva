<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 26-Nov-18
 * Time: 15:53
 */

class CountVocationDaysTest extends \PHPUnit\Framework\TestCase
{
    public function test_that_command_has_appropriate_reader_instance(){
        $command = new \App\Commands\CountVocationDays();
        $this->assertInstanceOf(\App\Readers\ResourceParserInterface::class,$command->reader());
    }

    public function test_that_command_has_appropriate_loggers_array(){
        $command = new \App\Commands\CountVocationDays();
        $this->assertEquals([new \App\Output\FileLogger()],$command->logger());
    }
}