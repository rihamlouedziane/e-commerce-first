<?php

declare(strict_types=1);

namespace App\Cart\Promotion;

use App\DTO\Cart;
use App\DTO\Promotion as PromotionDTO;

final class Promotion
{
    public function apply(PromotionDTO $promotion, Cart $cart): Cart
    {
        $cart->apply($promotion);
        // ... tu peux ajouter ici d'autres règles si nécessaire

        return $cart;
    }
}
