<?php

declare(strict_types=1);

namespace App\DTO;

class RegularPromotion extends Promotion
{
    public function compute(float $initialPrice): float
    {
        return $initialPrice - $this->value;
    }
}
