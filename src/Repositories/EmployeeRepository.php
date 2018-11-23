<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 18:50
 */

namespace App\Repositories;


use App\Employee;
use Carbon\Carbon;

/**
 * Holds information about users
 *
 * Class EmployeeRepository
 * @package App\Repositories
 */
class EmployeeRepository
{

    protected static $items=[];

    /**
     * Adds Employee to stack
     *
     * @param Employee $item
     */
    public static function add(Employee $item){
        self::$items[]=$item;
    }

    /**
     * Adds array of Employees to the stack
     *
     * @param array $data
     */
    public static function fill($data=[])
    {
        if(!empty($data)){
            foreach ($data as $item){
                self::add($item);
            }
        }

    }

    /**
     * Returns all stack
     *
     * @return array
     */
    public static function getAll(){
        return self::$items;
    }

    /**
     * Filters stack
     *
     * @param string $field
     * @param string $operator
     * @param string $compare
     * @return array
     */
    public static function where($field,$operator="=",$compare=""){

        if(property_exists(Employee::class,$field)){
            $filtered =  array_filter(self::$items,function($member) use($field,$operator,$compare){
                switch ($operator){
                    case ">" :
                        if($member->$field > $compare){
                            return $member;
                        }
                        break;
                    case "=" :
                        if( $member->$field === $compare){
                            return $member;
                        }
                        break;

                    case "<" :
                        if( $member->$field < $compare){
                            return $member;
                        }
                        break;
                    case "<=" :
                        if( $member->$field <= $compare){
                            return $member;
                        }
                        break;
                    case ">=" :
                        if( $member->$field >= $compare){
                            return $member;
                        }
                        break;
                }
            });
            return $filtered;
        }
    }
}