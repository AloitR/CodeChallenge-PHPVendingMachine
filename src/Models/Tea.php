<?php

namespace GetWith\CoffeeMachine\Models;

class Tea extends Drink {

    public function __construct(){
        $this->type = 'tea';
        $this->price = '0.4';
    }

} 