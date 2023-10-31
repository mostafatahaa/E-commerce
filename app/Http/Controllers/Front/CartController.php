<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repository = new CartModelRepository();
        $items = $repository->get();

        return view('front.cart', [
            'cart' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity'   => ['nullable', 'int', 'min:1'],
        ]);
        $product = Product::findOrfail($request->post('product_id'));
        $repository = new CartModelRepository();
        $repository->add($product, $request->post('quantity'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity'   => ['nullable', 'int', 'min:1'],
        ]);
        $product = Product::findOrfail($request->post('product_id'));
        $repository = new CartModelRepository();
        $repository->update($product, $request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repository = new CartModelRepository();
        $repository->delete($product, $request->post('quantity'));
    }
}
