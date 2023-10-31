<?php

namespace App\Repositories\Cart;

use App\Models\Product;
use Illuminate\Support\Collection;

interface CartRepository
{
    // get data from cart
    public function get(): Collection; // this means must return collection

    // add item to cart and its quantity...default = 1
    public function add(Product $product, $quantity = 1);

    // update quantity for item
    public function update($id, $quantity);

    // delete specific item form cart
    public function delete($id);

    // clear all items form cart
    public function empty();

    // count all items in cart and return float
    public function total(): float;
}
