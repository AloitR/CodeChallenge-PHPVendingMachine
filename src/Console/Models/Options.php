<?php

namespace GetWith\CoffeeMachine\Models;

class Options {

    private int $sugar;
    private bool $hot;

    public function __construct(){
        $this->sugar = 0;
        $this->hot = false;
    }
} 