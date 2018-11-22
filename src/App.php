<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 21:58
 */

namespace App;


use App\Output\OutputInterface;
use App\Readers\ResourceParserInterface;
use App\Tasks\TaskInterface;

class App
{

    protected $resourceParser=false;
    protected $tasks = [];
    protected $loggers=[];
    protected $year;

    public function __construct($input)
    {
        //TODO Validate input
        $this->year = $input[1];
    }

    public function setReader(ResourceParserInterface $resourceParser){
        $this->resourceParser = $resourceParser;
    }

    public function run(){

        $this->resourceParser->read();

        foreach ($this->tasks as $task){
            $task->execute();
        }

        foreach($this->loggers as $log){
            $log->execute();
        }

        echo "All tasks are done!";
        return;
    }

    public function setTask(TaskInterface $task){
        $this->tasks[] = $task;
    }

    public function setLogger(OutputInterface $output){
        $this->loggers[]=$output;
    }

    public function getYear(){
        return $this->year;
    }

}