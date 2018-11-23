<?php
use App\App;
use Carbon\Carbon;

function dateDiff($date,$dimension="year"){

    $compare_year = Carbon::now()->setYear(INPUT_YEAR);
    $date = Carbon::createFromTimestamp($date);
    $dimensions = [
        'year'=>$compare_year->diffInYears($date),
        'month'=>$compare_year->diffInMonths($date),
        'days'=>$compare_year->diffInDays($date),
        'hours'=>$compare_year->diffInHours($date)
    ];

    if(array_key_exists($dimension,$dimensions)){
        return $dimensions[$dimension];
    }
    echo "Wrong dimension";exit;
}

function config($key){
   $config =  include 'config.php';

   if(key_exists($key,$config)){
       return $config[$key];
   }
   return false;
}