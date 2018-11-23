<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 22:36
 */

namespace App\Output;

use App\Repositories\ResultsRepository;

/**
 * Saves results into a file
 *
 * Class FileLogger
 * @package App\Output
 */
class FileLogger implements DataOutputInterface
{

    /**
     * Pull from results repository
     * and write each result into separate file a file
     *
     */
    public function execute()
    {
        $summary  = "";
        foreach(ResultsRepository::getAll() as $result){
            $task = implode("_",explode(" ",$result->getHeader()));
            $data = $result->getResult();
            foreach ($data as $item){
                $summary .= $item."\n";
            }
        }
        file_put_contents("results/results_".$task.".txt",$summary);
        return;
    }
}