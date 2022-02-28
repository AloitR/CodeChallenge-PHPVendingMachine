<?php

namespace GetWith\CoffeeMachine\Models;

class Chocolate extends Drink {

    public function __construct(){
        $this->type = 'chocolate';
        $this->price = '0.6';
    }
} 