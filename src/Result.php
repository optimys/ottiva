<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 23:38
 */

namespace App;

/**
 * Collects all results from different tasks in one format
 *
 * Class Result
 * @package App
 */
class Result
{

    protected $header;
    protected $result=[];

    public function __construct($title)
    {
        $this->header = $title;
    }

    /**
     * Returns tasks description
     *
     * @return string
     */
    public function getHeader(){
        return $this->header;
    }

    /**
     * @param string $result
     */
    public function setResult($result){
        $this->result[]= $result;
    }

    /**
     * @return array|bool
     */
    public function getResult(){
        return !empty($this->result) ? $this->result : false ;
    }
}