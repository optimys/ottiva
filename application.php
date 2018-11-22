#!/usr/bin/env php
<?php

use  \App\Readers\CsvReader;
use \App\Tasks\VocationCounter;
use \App\Output\FileLogger;
use \App\App;

require __DIR__ . '/vendor/autoload.php';

$app = new App($argv);

$app->setReader(new CsvReader());

$app->setTask(new VocationCounter());

$app->setLogger(new FileLogger());

$app->run();