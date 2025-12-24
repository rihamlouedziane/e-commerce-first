<?php
declare(strict_types=1);

namespace App\DTO;

use App\DTO\Promotion;

class Cart
{
    private array $promotions = [];

    private readonly float $totalRawPrice;

    private float $totalNetPrice = 0.00;

    public function __construct(float $totalRawPrice)
    {
        $this->totalRawPrice = $totalRawPrice;
    }

    public function getTotalRawPrice(): float
    {
        return $this->totalRawPrice;
    }

    public function apply(Promotion $promotion): static
    {
        $netPrice = $this->getTotalRawPrice();
        $netPrice = $promotion->compute($netPrice);

        $this->setTotalNetPrice($netPrice);

        // Ajouter la promotion appliquée au panier
        $this->promotions[] = $promotion;

        return $this;
    }

    public function getTotalNetPrice(): float
    {
        return $this->totalNetPrice;
    }

    public function setTotalNetPrice(float $totalNetPrice): void
    {
        $this->totalNetPrice = $totalNetPrice;
    }
}
