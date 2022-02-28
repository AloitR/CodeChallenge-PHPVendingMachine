<?php

namespace GetWith\CoffeeMachine\Tests\Integration\Console;

use GetWith\CoffeeMachine\Console\MakeDrinkCommand;
use GetWith\CoffeeMachine\Exceptions\NotEnoughMoneyException;
use GetWith\CoffeeMachine\Exceptions\WrongSugarAmountException;
use GetWith\CoffeeMachine\Models\Tea;
use GetWith\CoffeeMachine\Tests\Integration\IntegrationTestCase;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class TeaTest extends TestCase
{
    protected function setUp(): void{
        parent::setUp();
    }

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

    public function testEnoughMoney(){
        $drink = new Tea;
        $this->assertSame('You have ordered a tea', $drink->buyDrink(4));
    }

    public function testWrongExceedingSugar(){
        $drink = new Tea;
        $this->expectException(WrongSugarAmountException::class);
        $drink->addSugar(4);
    }

    public function testWrongNegativeSugar(){
        $drink = new Tea;
        $this->expectException(WrongSugarAmountException::class);
        $drink->addSugar(-4);
    }

    public function testDecimalSugar(){
        $drink = new Tea;
        $this->expectException(WrongSugarAmountException::class);
        $drink->addSugar(1.4);
    }

    public function testCorrectSugar(){
        $drink = new Tea;
        $message = $drink->buyDrink(2);
        $message .= $drink->addSugar(1);
        $this->assertSame('You have ordered a tea with 1 sugars (stick included)', $message);
    }

    public function testCorrectHot(){
        $drink = new Tea;
        $message = $drink->buyDrink(2);
        $message .= $drink->addExtraHot(1);
        $message .= $drink->addSugar(1);
        $this->assertSame('You have ordered a tea extra hot with 1 sugars (stick included)', $message);
    }
}
