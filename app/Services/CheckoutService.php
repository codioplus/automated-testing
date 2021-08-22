<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Log;

class CheckoutService
{

    private $pricing_rules;
    public $total = 0;

    public function __construct($pricing_rules)
    {

        $this->pricing_rules = $pricing_rules;
    }


    public function scan(string $item)
    {
        $product = Product::where('product_code', $item)->first();
        if ($product) {
            Cart::create(['product_id' => $product->id]);


            $this->total = $this->getTotal();
        }
    }

    public function getTotal()
    {

        $cart_products = Cart::query();
        $cart_products = $cart_products->join('products', 'products.id', '=', 'carts.product_id')->selectRaw('products.product_code, products.price, sum(carts.qty) as quantity')->groupByRaw('products.product_code, products.price')->get();

        $total = 0;

        foreach ($cart_products as $product) {
            //info($product->quantity . ":" . $product->price . ":" . $product->product_code);
            $rule = $this->pricing_rules[$product->product_code] ?? Null;

            if (!is_null($rule)) {
                $total += $this->{$rule[0]}($product, $rule[1], $rule[2]);
            } else {
                $total += $product->quantity * $product->price;
            }
        }

        return $total;
    }


    private function get_one_free($product, $rule1, $rule2)
    {
        $quantity = floor($product->quantity / 2) + $product->quantity % 2;
        return $quantity * $product->price;
    }

    private function bulk_discount($product, $rule1, $rule2)
    {
        $price = $product->price;
        if ($product->quantity >= $rule1) {
            $price = $rule2;
        }

        return $product->quantity * $price;
    }
}
