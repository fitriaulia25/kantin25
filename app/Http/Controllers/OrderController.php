<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Pesanan::with('user')->get(); // Mengambil semua pesanan beserta user terkait
        return view('orders.index', compact('orders'));
    }
}
