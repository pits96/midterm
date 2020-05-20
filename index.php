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
$f3->route('GET|POST /survey',function ($f3){
    $view = new Template();
    $f3->set('options',['Today is a good day!','Calm and Collected','No need to rush']);
    if($_SERVER['REQUEST_METHOD']=='POST') {
        $_SESSION['name'] = $_POST['name'];
        if(!empty($_POST['answers'])){
//        foreach ($_POST['answers'] as $value){
//            $choicestrng.=$value.", ";
//        }
            $choicestrng="";
            for($i=0; $i<sizeof($_POST['answers'])-1;$i++){
                $choicestrng.=$_POST["answers"][$i].", ";
            }
            $choicestrng.=$_POST['answers'][sizeof($_POST['answers'])-1];
        }
        $_SESSION['answersString'] = $choicestrng;
        $f3->reroute('summary');
    }
        echo $view->render('views/survey.html');

});
$f3->route('GET|POST /summary',function (){
    $view = new Template();
    echo $view->render('views/summary.html');
//    session_destroy();
});
$f3->run();