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

/* commented out because we can only run once.
Should be at end of the program.
this is a warning for future self.
//run Fat Free
$f3->run();
*/

//Define a default route
$f3->route('GET /', function (){
    //echo '<h1>Hello Fat-Free</h1>';

    //Render a view page
    $view = new Template();
    echo $view->render('views/home.html');
});
//route for breakfast menu
$f3->route('GET /menu/breakfast', function (){
    //echo '<h1>Breakfast</h1>';

    //Render a view page
    $view = new Template();
    echo $view->render('views/breakfast-menu.html');
});
//route for lunch menu
$f3->route('GET /menu/lunch', function (){
    //echo '<h1>Lunch</h1>';

    //Render a view page
    $view = new Template();
    echo $view->render('views/lunch-menu.html');
});
//route for diner menu
$f3->route('GET /menu/diner', function (){
    //echo '<h1>Diner</h1>';

    //Render a view page
    $view = new Template();
    echo $view->render('views/diner-menu.html');
});

//route for order for part 1 menu
$f3->route('GET|POST /order1', function ($f3){
    //echo '<h1>Order 1</h1>';

    //if the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        echo "<p>You got here with the POST method</p>";
        //lets vardump it
        //var_dump($_POST);
        //check if the data is valid
        //get the data from post array
        $food = $_POST['food'];
        $meal = $_POST['meal'];
        if (true)
        {
            //get data out of post array and put it in session array
            $f3->set('SESSION.food', $food);
            $f3->set('SESSION.meal', $meal);

        }
    }
    else
    {
        echo "<p>You got her with the GET method</p>";
    }
    //Render a view page
    $view = new Template();
    echo $view->render('views/order1.html');
});

//route for order form part 2 menu
$f3->route('GET /order2', function (){
    //echo '<h1>Order 2</h1>';

    //Render a view page
    $view = new Template();
    echo $view->render('views/order2.html');
});
//run Fat Free
$f3->run();
