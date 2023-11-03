<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderAddress;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'user_id', 'payment_method', 'status', 'payment_status'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')
            ->withDefault([
                'name' => 'Guest Customer'
            ]);
    }
    // many to many (الاوردر يحتوى على اكثر من منتج والمنتج ممكن يكون في اكتر من اودر)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id', 'id')
            ->using(OrderItem::class)
            ->as('order_items')
            ->withPivot([
                'product_name', 'price', 'quantity', 'options'
            ]);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class, 'order_id', 'id');
    }

    public function billingAddress()
    {
        // will return colleciton
        // return $this->addresses()->where('type', '=', 'billing'); 
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'billing');
    }

    public function shippingAddress()
    {
        // will return colleciton
        // return $this->addresses()->where('type', '=', 'shipping'); 
        return $this->hasOne(OrderAddress::class, 'order_id', 'order')
            ->where('type', '=', 'shipping');
    }

    protected static function booted()
    {
        static::creating(function (Order $order) {
            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        $year = date('Y'); // or Carbon::now()->year()
        $number = Order::whereYear('created_at', $year)->max('number');

        if ($number) {
            return $number + 1; // this will be the next number
        }
        return $year . '0001';
    }
}
