<?php

/*
 * This is my Data Layer
 *  This belongs to the Model
 * */

//validate length of food ensuring that it is greater than 3
function validFood($food)
{
    return strlen(trim($food)) >= 3;
}
function validMeal($meal)
{
    return in_array($meal, getMeals());
}