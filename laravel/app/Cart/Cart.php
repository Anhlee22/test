<?php
    namespace App\Cart;
class Cart{
    public $products = null;
    public $totalprice = 0;
    public $totalquanty = 0;

    public function __construct($cart){
        if($cart){
            $this->products = $cart->products;
            $this->totalprice = $cart->totalprice;
            $this->totalquanty = $cart->totalquanty;
        }
    }
}
?>