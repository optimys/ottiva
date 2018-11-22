<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 18:50
 */

namespace App\Repositories;


use App\Employee;

class EmployeeRepository
{

    protected static $items=[];

    public static function add(Employee $item){
        self::$items[]=$item;
    }

    public static function getAll(){
        return self::$items;
    }

    public static function getByName($name){
        return array_walk(self::$items,function($index,$member)use($name){
             if($member->getName==$name)return $member;
        });
    }
}