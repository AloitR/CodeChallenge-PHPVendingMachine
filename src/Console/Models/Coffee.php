<?php

namespace GetWith\CoffeeMachine\Models;

class Coffee extends Drink {

    public function __construct(){
        $this->type = 'coffee';
        $this->price = '0.5';
    }

}