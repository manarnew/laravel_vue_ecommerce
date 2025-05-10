<?php

namespace App\Http\Helpers;

use App\Models\CartItem;

use function Pest\Laravel\json;

class Cart
{
    public static function getCartItemsCount(): int
    {
        $request = \request();
        $user = $request->user();
        if ($user) {
            return CartItem::where('user_id', $user->id)->sum('quantity');
        } else {
            $cartItems = self::getCookieCartItems();

            return array_reduce($cartItems, function ($carry, $item) {
                return $carry + $item['quantity'];
            }, 0);
        }
    }
    public static function getCartItems()
    {
        $request = \request();
        $user = $request->user();
        if ($user) {
            return CartItem::where('user_id', $user->id)->get()->map(
                fn($item) => ['product_id' => $item->product_id, 'quantity' => $item->quantity]
            );
        } else {
            return self::getCookieCartItems();
        }
    }
    public static function getCookieCartItems(): array
    {
        $request = \request();
        return json_decode($request->cookie('cart_items', '[]'), true);
    }
    public static function getCountFromItems($items)
    {
        return array_reduce(
            $items,
            fn($carry, $item) => $carry + $item['quantity'],
            0
        );
    }
    public static function moveCartItemsIntoDB()
    {
        $request = \request();
        $cartItems = self::getCookieCartItems();
        $dbCartItems = CartItem::where('user_id', $request->user()->id)->get()->keyBy('product_id');
        $newCartItems = [];
        foreach ($cartItems as $item) {
            if (isset($dbCartItems[$item['product_id']])) {
                continue;
            }
            $newCartItems[] = [
                'user_id' => $request->user()->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
            ];
        }
        if (!empty($newCartItems)) {
            CartItem::insert($newCartItems);
        }
    }
}
