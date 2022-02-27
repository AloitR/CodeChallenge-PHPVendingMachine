<?php

namespace GetWith\CoffeeMachine\Models;

class Drink {

    protected string $type;
    protected float $price;

    public function getType(): string{
        return $this->type;
    }

    public function getPrice(): float{
            return $this->price;
    }

}