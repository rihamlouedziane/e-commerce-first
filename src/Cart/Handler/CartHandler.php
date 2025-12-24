<?php

declare(strict_types=1);

namespace App\Cart\Handler;

use App\DTO\Promotion as PromotionDTO;
use App\Cart\Persist\CartPersister;
use App\Cart\Promotion\Promotion;
use App\DTO\Cart;

final class CartHandler
{
    // Inject the dependancies here
    public function __construct(
        private CartPersister $cartPersister,
        private Promotion $promotionApplier,
    ) {
    }

    /**
     * @param Cart $cart
     * @param PromotionDTO[] $promotions
     *
     * @return bool
     */
    public function handle(Cart $cart, array $promotions = []): bool
    {
        // Make sure that all the promotions are **Instances of ** Promotion
        if (!\array_all($promotions, fn ($item) => $item instanceof PromotionDTO)) {
            return false;
        }

        // Apply the promotions before persisting to the database
        foreach ($promotions as $promotion) {
            $this->promotionApplier->apply($promotion, $cart);
        }

        // ... we can imagine here whatever logic that might returns false or something
        // here I am just testing on the prices to show you some cases where the `hande()` can return false
        // you can do any handling logic here
        if ($cart->getTotalRawPrice() <= 0 || $cart->getTotalNetPrice() <= 0) {
            return false;
        }


        return $this->cartPersister->persist($cart);;
    }
}
