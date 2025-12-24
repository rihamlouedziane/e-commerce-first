<?php

declare(strict_types=1);

namespace App\Cart\Persist;

use App\DTO\Cart;
use App\DTO\Promotion as PromotionDTO;

class CartPersister
{
    /**
     * @param Cart $cart
     * @param PromotionDTO[] $promotions
     *
     * @return bool
     */
    public function persist(Cart $cart, array $promotions = []): bool
    {
        // do some logic like persisting the cart to the database

        return true;
    }

    // ... add more methods (probably private) if you want
}
