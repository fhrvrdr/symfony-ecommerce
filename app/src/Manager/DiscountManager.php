<?php

namespace App\Manager;


use App\Entity\Order\ShoppingSession;
use App\Repository\Product\DiscountRepository;

class DiscountManager
{

    private $discountRepository;

    public function __construct(DiscountRepository $discountRepository)
    {

        $this->discountRepository = $discountRepository;
    }

    public function discount(ShoppingSession $cart)
    {
        $categories[] = null;
        $discount = $this->discountRepository->findOneBy(['name' => '3 to 1']);
        foreach ($cart->getCartItems() as $item) {
            foreach ($item->getProduct()->getCategory() as $category) {
                if ($category === $discount->getCategory()) {
                    $categories[] = array_fill(0, $item->getQuantity(), $category);
                }
            }
        }


        if (count($categories) >= 3) {
            $discount = $this->discountRepository->findOneBy(['name' => '3 to 1']);
            return $discount;
        } else if (count($cart->getCartItems()) == 2) {
            $discount = $this->discountRepository->findOneBy(['name' => 'Fifty Percent']);
            return $discount;
        }
    }
}