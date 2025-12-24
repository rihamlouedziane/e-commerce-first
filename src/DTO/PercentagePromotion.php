<?php

declare(strict_types=1);

namespace App\DTO;

class PercentagePromotion extends Promotion
{
    public function compute(float $initialPrice): float
    {
        return $initialPrice * (1 - 0.01 * $this->value);
    }
}
