<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 22:36
 */

namespace App\Output;


use App\Repositories\ResultsRepository;

class FileLogger implements OutputInterface
{
    protected $result;

    public function execute()
    {
        foreach(ResultsRepository::getAll() as $result){
            $this->result .=$result->getResult()."\n";
        }

        file_put_contents("results_".app()->getYear().".txt",$this->result);
        return;
    }
}