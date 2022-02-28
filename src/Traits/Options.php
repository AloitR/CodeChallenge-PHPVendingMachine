<?php

namespace GetWith\CoffeeMachine\Traits;
use Exception;
use GetWith\CoffeeMachine\Exceptions\WrongSugarAmountException;

trait Options {

    public int $sugars;
    public bool $extraHot;
    public bool $stick;

    public function setSugars($sugars){
        $this->sugars = $sugars;
    }

    public function setExtraHot($extraHot){
        $this->extraHot = $extraHot;
    }

    public function setStick($stick){
        $this->stick = $stick;
    }

    /**
     * @throws Exception
     */
    public function addSugar($sugars): string {
        switch ($sugars) {
            case 0:
                return '';
            case 1:
            case 2:
                return ' with '.$sugars.' sugars (stick included)';
            default:
                throw new WrongSugarAmountException('The number of sugars should be between 0 and 2.');
        }
    }

    public function addExtraHot($extraHot): string {
        if($extraHot) {
            $this->setExtraHot($extraHot);
            return ' extra hot';
        } else {
            return '';
        }
    }

}