<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 23:43
 */

namespace App\Repositories;


use App\Result;

class ResultsRepository
{
    protected static $items=[];

    public static function add(Result $item){
        self::$items[]=$item;
    }

    public static function getAll(){
        return self::$items;
    }
}