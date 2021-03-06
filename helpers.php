<?php
use App\App;
use Carbon\Carbon;

/**
 * Calculates differences between dates
 *
 * @param $date
 * @param string $dimension
 * @return mixed
 */
function dateDiff($date,$dimension="year"){

    $compare_year = Carbon::parse(INPUT_YEAR);
    $date = Carbon::createFromTimestamp($date);
    $dimensions = [
        'year'=>$compare_year->diffInYears($date),
        'month'=>$compare_year->diffInMonths($date),
        'days'=>$compare_year->diffInDays($date),
    ];

    if(array_key_exists($dimension,$dimensions)){
        return $dimensions[$dimension];
    }
    throw new Exception("Wrong dimension");
}

/**
 * Get data from config file
 *
 * @param $key
 * @return bool
 */
function config($key){
   $config =  include 'config.php';

   if(key_exists($key,$config)){
       return $config[$key];
   }
   return false;
}