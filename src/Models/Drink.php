<?php

namespace GetWith\CoffeeMachine\Models;
use Exception;
use GetWith\CoffeeMachine\Exceptions\NotEnoughMoneyException;
use GetWith\CoffeeMachine\Traits\Options;

class Drink {
    
    protected string $type;
    protected float $price;
    use Options;

    public function __construct(){
        $this->setExtraHot(false);
        $this->setSugars(0);
        $this->setStick(false);
    }

    public function getType(): string{
        return $this->type;
    }

    public function getPrice(): float{
        return $this->price;
    }

    public function buyDrink($money): string
    {
        if ($money >= $this->getPrice()) {
            return 'You have ordered a ' . $this->getType() ;
        } else {
            throw new NotEnoughMoneyException('The ' . $this->type . ' costs ' . $this->price . '.');
        }
    }
}