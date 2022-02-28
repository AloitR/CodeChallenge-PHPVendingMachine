<?php

namespace GetWith\CoffeeMachine\Tests\Unit\Models;

use GetWith\CoffeeMachine\Models\Coffee;
use GetWith\CoffeeMachine\Models\Tea;
use GetWith\CoffeeMachine\Models\Chocolate;
use PHPUnit\Framework\TestCase;

class DrinkTest extends TestCase
{
    public function testModelCoffee()
    {
        $coffee = new Coffee;
        $this->assertInstanceOf(Coffee::class , $coffee);
    }

    public function testModelChocolate()
    {
        $chocolate = new Chocolate;
        $this->assertInstanceOf(Chocolate::class , $chocolate);
    }

    public function testModelTea()
    {
        $tea = new Tea;
        $this->assertInstanceOf(Tea::class , $tea);
    }
}