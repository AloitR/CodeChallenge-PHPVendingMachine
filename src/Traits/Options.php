<?php

namespace GetWith\CoffeeMachine\Traits;
use Exception;
use GetWith\CoffeeMachine\Exceptions\WrongSugarAmountException;

trait Options {

    public int $sugars;
    public bool $extraHot;
    public bool $stick;

    public function setSugars($sugars): void
    {
        $this->sugars = $sugars;
    }

    public function setExtraHot($extraHot): void
    {
        $this->extraHot = $extraHot;
    }

    public function setStick($stick): void
    {
        $this->stick = $stick;
    }

    /**
     * @throws Exception
     */
    public function addSugar($sugars): string {
        return match ($sugars) {
            0 => '',
            1, 2 => ' with ' . $sugars . ' sugars (stick included)',
            default => throw new WrongSugarAmountException('The number of sugars should be between 0 and 2.'),
        };
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