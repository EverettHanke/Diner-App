<?php

/*
 * This is my Data Layer
 *  This belongs to the Model
 * */

class DataLayer
{
    static function getMeals()
    {
        return array('breakfast','brunch' ,'lunch', 'diner', 'dessert');
    }

    static function getCondiments()
    {
        return array('ketchup', 'mustard', 'sriracha', 'hot sauce');
    }
}

