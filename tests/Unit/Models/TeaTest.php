<?php

namespace GetWith\CoffeeMachine\Tests\Unit\Models;

use Exception;
use GetWith\CoffeeMachine\Exceptions\NotEnoughMoneyException;
use GetWith\CoffeeMachine\Exceptions\WrongSugarAmountException;
use GetWith\CoffeeMachine\Models\Tea;
use PHPUnit\Framework\TestCase;

class TeaTest extends TestCase
{

    public function testNotEnoughMoney(){
        $drink = new Tea;
        $this->expectException(NotEnoughMoneyException::class);
        $drink->buyDrink(0);
    }

    public function testNegativeMoney(){
        $drink = new Tea;
        $this->expectException(NotEnoughMoneyException::class);
        $drink->buyDrink(-4);
    }

    /**
     * @throws NotEnoughMoneyException
     */
    public function testEnoughMoney(){
        $drink = new Tea;
        $this->assertSame('You have ordered a tea', $drink->buyDrink(4));
    }

    /**
     * @throws Exception
     */
    public function testWrongExceedingSugar(){
        $drink = new Tea;
        $this->expectException(WrongSugarAmountException::class);
        $drink->addSugar(4);
    }

    /**
     * @throws Exception
     */
    public function testWrongNegativeSugar(){
        $drink = new Tea;
        $this->expectException(WrongSugarAmountException::class);
        $drink->addSugar(-4);
    }

    /**
     * @throws Exception
     */
    public function testDecimalSugar(){
        $drink = new Tea;
        $this->expectException(WrongSugarAmountException::class);
        $drink->addSugar(1.4);
    }

    /**
     * @throws NotEnoughMoneyException
     * @throws Exception
     */
    public function testCorrectSugar(){
        $drink = new Tea;
        $message = $drink->buyDrink(2);
        $message .= $drink->addSugar(1);
        $this->assertSame('You have ordered a tea with 1 sugars (stick included)', $message);
    }

    /**
     * @throws NotEnoughMoneyException
     * @throws Exception
     */
    public function testCorrectHot(){
        $drink = new Tea;
        $message = $drink->buyDrink(2);
        $message .= $drink->addExtraHot(1);
        $message .= $drink->addSugar(1);
        $this->assertSame('You have ordered a tea extra hot with 1 sugars (stick included)', $message);
    }
}
