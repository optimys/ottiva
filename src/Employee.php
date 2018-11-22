<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 17:49
 */

namespace App;


use Carbon\Carbon;

//TODO add phpdoc
class Employee
{

    protected $birthday;
    protected $hired;
    protected $name;
    protected $vocation_days;

    public function __construct($data  =[])
    {
        $this->birthday = $data['birthday'];
        $this->hired = $data['hired'];
        $this->name = $data['name'];
        $this->vocation_days = $data['special_contract'] ?: 26;
    }

    /**
     * @return int
     */
    public function get_age(){
        return $this->getDiff($this->birthday);
    }


    public function get_experience($dimension="year"){
        return $this->getDiff($this->hired,$dimension);

    }

    public function get_name(){
        return $this->name;
    }

    public function getVocationDays(){
        return $this->vocation_days;
    }

    protected function getDiff($year,$dimension="year"){
        $dimensions = [
            'year'=>'diffInYears',
            'month'=>'diffInMonths',
            'days'=>'diffInDays',
            'hours'=>'diffInHours'
        ];

        if(array_key_exists($dimension,$dimensions)){
            $year = Carbon::parse($year);
            $compare_year = Carbon::today();
            return $compare_year->$dimensions[$dimension]($year);
        }
    }

    public function has_valid_data(){
        if($this->birthday and $this->hired and $this->name){
            return true;
        }
        return false;
    }

    public function is_newComer(){
        return $this->get_experience() == 0 ? true : false;
    }

    public function is_experienced(){
        return $this->get_age() >=30 and $this->get_experience() >=5;
    }

    public function is_usual(){
        return (!$this->is_experienced() and !$this->is_newComer()) ? true :false;
    }
}