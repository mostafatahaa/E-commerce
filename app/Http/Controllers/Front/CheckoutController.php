<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart)
    {
        // if cart is empty
        if ($cart->get()->count() == 0) {
            return redirect()->route('home');
        }

        return view('front.checkout', [
            'cart'  => $cart,
            'countries'  => Countries::getNames()
        ]);
    }

    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([]);

        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {
                $order = Order::create([
                    'store_id'  => $store_id,
                    'user_id'   => Auth::id(),
                    'payment_method' => 'cod', // cash on deleviry
                ]);

                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id'      => $order->id,
                        'product_id'    => $item->product_id,
                        'product_name'  => $item->product->name, // product is the relation
                        'price'         => $item->product->price, // product is the relation
                        'quantity'      => $item->quantity
                    ]);
                }
                // post('addr) input array...$type = address type  $address = address deatails 
                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
            }

            DB::commit();

            // event('order.created', $order, Auth::user());
            event(new OrderCreated($order));
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('home');
    }
}
