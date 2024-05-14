<?php

/*
 * This is my Data Layer
 *  This belongs to the Model
 * */

//validate length of food ensuring that it is greater than 3
class Validator
{
    static function validFood($food): bool
    {
        return strlen(trim($food)) >= 3;
    }
    static function validMeal($meal): bool
    {
        return in_array($meal, DataLayer::getMeals());
    }
}
