<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);
        $total = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        $pesanan = Pesanan::create([
            'user_id' => $user->id,
            'username' => $user->name,
            'items' => $cart,
            'total' => $total,
        ]);

        // Kosongkan keranjang setelah checkout
        session()->forget('cart');

        return redirect()->route('index')->with('success', 'Pesanan Anda berhasil dibuat!');
    }
}
