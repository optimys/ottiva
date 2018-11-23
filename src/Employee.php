<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 17:49
 */

namespace App;

use Carbon\Carbon;

/**
 * Represents employee data
 *
 * Class Employee
 * @package App
 */
class Employee
{

    protected $birthday;
    protected $hired;
    protected $name;
    protected $vocation_days;

    public function __construct($data  =[])
    {
        $this->birthday = strtotime($data['birthday']);//Carbon::parse($data['birthday']);
        $this->hired = strtotime($data['hired']);//Carbon::parse($data['hired']);
        $this->name = $data['name'];
        $this->vocation_days = $data['special_contract'] ? (int)$data['special_contract'] : config('vocation_days');
    }

    /**
     * @return int
     */
    public function get_age(){
        return dateDiff($this->birthday);
    }


    public function get_experience($dimension="year"){

        return dateDiff($this->hired,$dimension);

    }

    public function get_hired($format = false){
        if($format){
            return Carbon::createFromTimestamp($this->hired)->format($format);
        }
        return $this->hired;

    }

    public function get_birthday($format = false){
        if($format){
            return Carbon::createFromTimestamp($this->birthday)->format($format);
        }
        return $this->birthday;
    }

    /**
     * checks employee who works less then 1 year
     *
     * @return bool
     */
    public function is_newComer(){
        return $this->get_experience() == 0 ? true : false;
    }

    /**
     * checks employee who works 5 or more years and older then 29 years
     *
     * @return bool
     */
    public function is_experienced(){
        return $this->get_age() >=30 and $this->get_experience() >=5;
    }

    /**
     * checks all the rest employees
     *
     * @return bool
     */
    public function is_usual(){
        return (!$this->is_experienced() and !$this->is_newComer()) ? true :false;
    }

    public function __get($name)
    {
        if(isset($this->$name)){
            return $this->$name;
        }
    }
}