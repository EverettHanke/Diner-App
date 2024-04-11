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

//run Fat Free
$f3->run();
