<?php

namespace GetWith\CoffeeMachine\Tests\Unit\Models;

use Exception;
use GetWith\CoffeeMachine\Exceptions\NotEnoughMoneyException;
use GetWith\CoffeeMachine\Exceptions\WrongSugarAmountException;
use GetWith\CoffeeMachine\Models\Chocolate;
use PHPUnit\Framework\TestCase;

class ChocolateTest extends TestCase
{

    public function testNotEnoughMoney(){
        $drink = new Chocolate;
        $this->expectException(NotEnoughMoneyException::class);
        $drink->buyDrink(0);
    }

    public function testNegativeMoney(){
        $drink = new Chocolate;
        $this->expectException(NotEnoughMoneyException::class);
        $drink->buyDrink(-4);
    }

    public function testEnoughMoney(){
        $drink = new Chocolate;
        $this->assertSame('You have ordered a chocolate', $drink->buyDrink(4));
    }

    /**
     * @throws Exception
     */
    public function testWrongExceedingSugar(){
        $drink = new Chocolate;
        $this->expectException(WrongSugarAmountException::class);
        $drink->addSugar(4);
    }

    /**
     * @throws Exception
     */
    public function testWrongNegativeSugar(){
        $drink = new Chocolate;
        $this->expectException(WrongSugarAmountException::class);
        $drink->addSugar(-4);
    }

    /**
     * @throws Exception
     */
    public function testDecimalSugar(){
        $drink = new Chocolate;
        $this->expectException(WrongSugarAmountException::class);
        $drink->addSugar(1.4);
    }

    /**
     * @throws NotEnoughMoneyException
     * @throws Exception
     */
    public function testCorrectSugar(){
        $drink = new Chocolate;
        $message = $drink->buyDrink(2);
        $message .= $drink->addSugar(1);
        $this->assertSame('You have ordered a chocolate with 1 sugars (stick included)', $message);
    }

    /**
     * @throws NotEnoughMoneyException
     * @throws Exception
     */
    public function testCorrectHot(){
        $drink = new Chocolate;
        $message = $drink->buyDrink(2);
        $message .= $drink->addExtraHot(1);
        $message .= $drink->addSugar(1);
        $this->assertSame('You have ordered a chocolate extra hot with 1 sugars (stick included)', $message);
    }
}
