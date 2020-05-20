<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once("vendor/autoload.php");

session_start();

//Instantiate the F3 Base class
$f3 = Base::instance();
$f3->route('GET /',function (){
   $view = new Template();
   echo $view->render('views/home.html');
});
$f3->route('GET /survey',function ($f3){
    $view = new Template();
    $f3->set('options',['Today is a good day.','Calm and collected','No need to rush']);
    echo $view->render('views/survey.html');
});
$f3->run();