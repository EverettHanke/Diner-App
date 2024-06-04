<?php

// 328/hello-fat-free/index.php
//this is my controller!

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require
require_once ('vendor/autoload.php');

//instantiate the F3 base class (F3 is fat free framework)
$f3 = Base::instance();
$con = new Controller($f3);
$dataLayer = new DataLayer();

$myOrder = new Order('breakfast', 'pancakes', 'maple syrup');
$dataLayer->saveOrder($myOrder);
$orders = $dataLayer->getOrder();
var_dump($orders);

//Define a default route
$f3->route('GET /', function (){
    //echo '<h1>Hello Fat-Free</h1>';
    //Render a view page
   $GLOBALS['con']->home();
});
//route for breakfast menu
$f3->route('GET /menu/breakfast', function (){
    //echo '<h1>Breakfast</h1>';

    //Render a view page
    $GLOBALS['con']->breakfast();

});
//route for lunch menu
$f3->route('GET /menu/lunch', function (){
    //echo '<h1>Lunch</h1>';

    //Render a view page
    $GLOBALS['con']->lunch();
});
//route for diner menu
$f3->route('GET /menu/diner', function (){
    //echo '<h1>Diner</h1>';

    //Render a view page
    $GLOBALS['con']->diner();

});

//route for order for part 1 menu
$f3->route('GET|POST /order1', function ($f3) {
    //echo '<h1>Order 1</h1>';
    //if the form has been posted
    $GLOBALS['con']->order1();
}
);

//route for order form part 2 menu
$f3->route('GET|POST /order2', function ($f3) {
    //echo '<h1>Order 2</h1>';
    var_dump($f3->get('SESSION'));
    //Render a view page
    $GLOBALS['con']->order2();

});

//route for summary menu
$f3->route('GET|POST /summary', function (){
    //write the data to the database
   $GLOBALS['con']->summary();
});
$f3->route('GET|POST /admin', function (){
    $GLOBALS['con']->admin();
});
//run Fat Free
$f3->run();
