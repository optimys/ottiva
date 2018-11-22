<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 21-Nov-18
 * Time: 22:25
 */

namespace App\Tasks;


use App\Employee;

interface TaskInterface
{
    public function execute($data=[]);

}