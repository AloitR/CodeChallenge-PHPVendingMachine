<?php


namespace GetWith\CoffeeMachine\Factories;

use GetWith\CoffeeMachine\Models\Chocolate;
use GetWith\CoffeeMachine\Models\Coffee;
use GetWith\CoffeeMachine\Models\Tea;
use GetWith\CoffeeMachine\Exceptions\WrongDrinkTypeException;

class DrinkFactory
{
    /**
     * @throws WrongDrinkTypeException
     */
    public static function makeDrink(string $drinkType): Tea|Chocolate|Coffee
    {
        return match ($drinkType) {
            'tea' => new Tea,
            'coffee' => new Coffee,
            'chocolate' => new Chocolate,
            default => throw new WrongDrinkTypeException('The drink type should be tea, coffee or chocolate.'),
        };
    }

}