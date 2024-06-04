<?php

class Controller
{
    private $_f3; //Fat-Free Router

    function __construct($f3)
    {
        $this->_f3 = $f3;

    }

    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function breakfast()
    {
        $view = new Template();
        echo $view->render('views/breakfast-menu.html');
    }

    function lunch()
    {
        $view = new Template();
        echo $view->render('views/lunch-menu.html');
    }

    function diner()
    {
        $view = new Template();
        echo $view->render('views/diner-menu.html');
    }

    function order1()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (Validator::validFood($_POST['food'])) {
                $food = $_POST['food'];
            } else {
                $this->_f3->set('errors["food"]', 'Please enter a food');
            }
            if (Validator::validMeal($_POST['meal'])) {
                $meal = $_POST['meal'];
            } else {
                $this->_f3->set('errors["meal"]', 'Please select a meal');
            }
            //add the data to the session array
            $order = new Order($food, $meal);
            $this->_f3->set('SESSION.order', $order);
            //get data out of post array and put it in session array
            $this->_f3->set('SESSION.food', $food);
            $this->_f3->set('SESSION.meal', $meal);
            //send us to page 2
            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('order2');
            }

        } else {
            echo "<p>You got her with the GET method</p>";
        }

//before we render that page
//get data from the model
//and add it to the F3 hive
        $meals = DataLayer::getMeals();
        $this->_f3->set('meals', $meals);

//Render a view page
        $view = new Template();
        echo $view->render('views/order1.html');
    }

    function order2()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            //$condiments = $_POST['conds'];
            if (isset($_POST['conds']))
            {
                $condiments = implode(", ", $_POST['conds']);
                $this->_f3->get("SESSION.order")->setCondi($condiments);
                $this->_f3->set('SESSION.condiments', $condiments);

                $this->_f3->reroute('summary');
            }
        }
        else
        {
            echo "<p>here via GET</p>";
        }

        //use data layers
        $condi = DataLayer::getCondiments();
        $this->_f3->set('condi', $condi);

        $view = new Template();
        echo $view->render('views/order2.html');
    }
    function summary()
    {

        $id = $GLOBALS['dataLayer']->saveOrder($this->_f3->get('SESSION.order'));
        echo "Order $id inserted successful";

        //var_dump($f3->get('SESSION.order'));
        //Render a view page
        $view = new Template();
        echo $view->render('views/summary.html');
        session_destroy();
    }
    function admin()
    {

        $view = new Template();
        $orders = $GLOBALS['dataLayer']->getOrder();
        $this->_f3->set('orders', $orders);
        var_dump( $this->_f3->get('orders'));
        echo $view->render('views/admin.html');
        session_destroy();
    }
}