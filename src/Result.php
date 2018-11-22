<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 23:38
 */

namespace App;


class Result
{
    protected $result="";

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function getResult(){
        return $this->result;
    }
}