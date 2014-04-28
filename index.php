<?php

require_once('app/config.php');

require_once 'app/autoloader.php';
use Autoloader as Autoloader;

require_once 'app/appKernel.php';
use App\appKernel as appKernel;

$app = new appKernel($config);

$app->run();