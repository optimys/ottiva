<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 16:43
 */

namespace App\Readers;


interface ResourceParserInterface
{

    public function __construct($path="/src/resources/employees.csv");

    public function read();

}