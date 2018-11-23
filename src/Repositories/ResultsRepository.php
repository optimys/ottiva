<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 23:43
 */

namespace App\Repositories;


use App\Result;

/**
 * Holds results of each task
 *
 * Class ResultsRepository
 * @package App\Repositories
 */
class ResultsRepository
{
    protected static $items=[];

    /**
     * Adds item to the stack
     *
     * @param Result $item
     */
    public static function add(Result $item){
        self::$items[]=$item;
    }

    /**
     * Returns all items from the stack
     *
     * @return array
     */
    public static function getAll(){
        return self::$items;
    }
}