<?php

// 328/hello-fat-free/index.php
//this is my controller!

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require
require_once ('vendor/autoload.php');

//test the datalayer class
//var_dump(DataLayer::getCondiments());
//var_dump(DataLayer::getMeals());
//require_once ('classes/order.php'); no longer needed as the composer handles it via autoload
//var_dump(getMeals());
//$testfood = '   xy   ';
//echo validFood($testfood) ? "valid": "not valid";
//var_dump(validFood($testfood));

//instantiate the F3 base class (F3 is fat free framework)
$f3 = Base::instance();

/* commented out because we can only run once.
Should be at end of the program.
this is a warning for future self.
//run Fat Free
$f3->run();
*/

//$order = new Order('pad thai', 'lunch', ['soy sauce']);
//var_dump($order);

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
        $food ="";
        $meal = "";

        if (Validator::validFood($_POST['food']))
        {
            $food = $_POST['food'];
        }
        else
        {
            $f3->set('errors["food"]', 'Please enter a food');
        }
        if (Validator::validMeal($_POST['meal']))
        {
            $meal = $_POST['meal'];
        }
        else
        {
            $f3->set('errors["meal"]', 'Please select a meal');
        }
            //add the data to the session array
            $order = new Order($food, $meal);
            $f3->set('SESSION.order', $order);
            //get data out of post array and put it in session array
            $f3->set('SESSION.food', $food);
            $f3->set('SESSION.meal', $meal);
            //send us to page 2
        if (empty($f3->get('errors')))
        {
            $f3->reroute('order2');
        }

    }
    else
    {
        echo "<p>You got her with the GET method</p>";
    }
    //before we render that page
    //get data from the model
    //and add it to the F3 hive
    $meals = DataLayer::getMeals();
    $f3->set('meals', $meals);

    //Render a view page
    $view = new Template();
    echo $view->render('views/order1.html');
});

//route for order form part 2 menu
$f3->route('GET|POST /order2', function ($f3){
    //echo '<h1>Order 2</h1>';
    var_dump($f3->get('SESSION'));
    //Render a view page
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //$condiments = $_POST['conds'];
        if (isset($_POST['conds']))
        {
            $condiments = implode(", ", $_POST['conds']);
            $f3->get("SESSION.order")->setCondi($condiments);
            $f3->set('SESSION.condiments', $condiments);

            $f3->reroute('summary');
        }
    }
    else
    {
        echo "<p>here via GET</p>";
    }

    //use data layers
    $condi = DataLayer::getCondiments();
    $f3->set('condi', $condi);

    $view = new Template();
    echo $view->render('views/order2.html');
});

//route for summary menu
$f3->route('GET|POST /summary', function ($f3){
    //write the data to the database



    //var_dump($f3->get('SESSION.order'));
    //Render a view page
    $view = new Template();
    echo $view->render('views/summary.html');
    session_destroy();
});
//run Fat Free
$f3->run();
