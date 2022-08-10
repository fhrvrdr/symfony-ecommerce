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
        $cartItems = [];
        $discount = $this->discountRepository->findOneBy(['name' => '3 to 1']);
        foreach ($cart->getCartItems() as $item) {
            foreach ($item->getProduct()->getCategory() as $category) {
                if ($category === $discount->getCategory()) {
                    array_push($cartItems, $item);
                }
            }
        }

        $cartItems2 = [];
        foreach ($cart->getCartItems() as $item) {
            array_push($cartItems2, $item);
        }


        $counter = 0;
        foreach ($cartItems as $item) {
            $counter += $item->getQuantity();
        }

        $price = [];
        if ($counter >= 3) {
            foreach ($cartItems as $item) {
                foreach ($item->getProduct()->getCategory() as $category) {
                    if ($category === $discount->getCategory()) {
                        array_push($price, $item->getProduct()->getPrice());
                    }
                }

            }
            return min($price);
        } else if (count($cart->getCartItems()) == 2) {
            foreach ($cartItems2 as $item) {
                array_push($price, $item->getProduct()->getPrice());
            }
            
            $discount = min($price) / 2;
            return $discount;
        }
    }
}