<?php

/**
 * Order class represents a diner order
 */
class Order
{
    private $_food;
    private $_meal;
    private $_condi;

    /**
     * Constuctor creates an Order object
     * @param $_food the user ordered
     * @param $_meal the selected meal
     * @param $_condi the selected condiments
     */
    public function __construct($_food="None", $_meal="None", $_condi="None")
    {
        $this->_food = $_food;
        $this->_meal = $_meal;
        $this->_condi = $_condi;
    }
    /**
     * @return string food name
     */
    public function getFood()
    {
        return $this->_food;
    }
    /**
     * setter for food
     */
    public function setFood($food)
    {
        $this->_food = $food;
    }
    /**
     * @return string meal
     */
    public function getMeal()
    {
        return $this->_meal;
    }

    /**
     * setter for meal
     */
    public function setMeal($meal)
    {
        $this->_meal = $meal;
    }

    /**
     * @return string array of condiments
     */
    public function getCondi()
    {
        return $this->_condi;
    }
    /**
     * setter for condiments
     */
    public function setCondi($condi)
    {
        $this->_condi = $condi;
    }
}
