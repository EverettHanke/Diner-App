<?php

/*
 * This is my Data Layer
 *  This belongs to the Model
 * */

class DataLayer
{
    private $_dbh;
    function __construct()
    {
        $path = $_SERVER['DOCUMENT_ROOT'].'/../config.php';
        require_once $path;
        try
        {
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME,DB_PASSWORD);
            //echo "<h2>CONNECTED</h2>";
        }
        catch (PDOException $e)
        {
            die($e->getMessage());
            die("<p>OOPS SOMETHING WENT WRONG</p>");
        }
    }

    static function getMeals()
    {
        return array('breakfast','brunch' ,'lunch', 'diner', 'dessert');
    }

    static function getCondiments()
    {
        return array('ketchup', 'mustard', 'sriracha', 'hot sauce');
    }

    function saveOrder($order)
    {
        $sql = 'INSERT INTO dinerOrder (food, meal, condiments) VALUES (:food, :meal, :condiments)';

//2. Prepare the statement
        $stmt = $this->_dbh->prepare($sql);

//3. Bind the parameters
        $food = "$order->getFood()";
        $meal = "$order->getMeal()";
        $condiments = "$order->getCondi()";
        $stmt->bindParam(':food', $food );
        $stmt->bindParam(':meal', $meal);
        $stmt->bindParam( ':condiments', $condiments);

//4. Execute the query
        $stmt->execute();

//5. process the results
        $id = $this->_dbh->lastInsertId();
        echo "<p>Order $id was inserted successfully</p>";
    }
    function getOrder()
    {
        $sql = "SELECT * FROM dinerOrder";
        $stmt = $this->_dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

