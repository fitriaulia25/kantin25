<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pembayarancontroller extends Controller
{
    public function pembayaran(Request $request)
    {
        $nama = $request->input('nama');
        $rombel = $request->input('rombel');
        $uang = $request->input('uang');
    
        $cart = session()->get('cart', []);
        $total_harga = 0;
        $total_item = 0;
    
        foreach ($cart as $product) {
            $total_harga += $product['quantity'] * $product['price'];
            $total_item += $product['quantity'];
        }
    
        $kembalian = $uang - $total_harga;
    
        return view('pembayaran', compact('nama', 'rombel', 'total_item', 'total_harga', 'uang', 'kembalian'));
    }
    
}
