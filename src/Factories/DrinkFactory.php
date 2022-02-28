<?php


namespace GetWith\CoffeeMachine\Factories;

use GetWith\CoffeeMachine\Models\Chocolate;
use GetWith\CoffeeMachine\Models\Coffee;
use GetWith\CoffeeMachine\Models\Tea;

class DrinkFactory
{
    public function makeDrink(string $drinkType){
        switch ($drinkType) {
            case 'tea':
                $drink = new Tea;
                break;
            case 'coffee':
                $drink = new Coffee;
                break;
            case 'chocolate':
                $drink = new Chocolate;
                break;
            default:
                throw new \WrongDrinkTypeException('The drink type should be tea, coffee or chocolate.');
        }
        return $drink;
    }

}