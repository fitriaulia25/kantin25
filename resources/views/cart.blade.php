@extends('layouts.style')

@section('title', 'Keranjang Belanja Anda')

@section('content')
<head>
    <link href="{{ asset('css/stylecart.css') }}" rel="stylesheet">
</head>
<div class="container">
    <h1>Keranjang Belanja Anda</h1>

    @if(session('success'))
        <div class="notification">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart_products) > 0)
        <div class="main-content">
            @foreach($cart_products as $key => $product)
                <div class="card">
                    @if(isset($product['gambar']))
                        <img src="{{ asset('storage/' . $product['gambar']) }}" alt="{{ $product['name'] }}" class="product-image">
                    @endif
                    <div class="product-info">
                        <h3 class="product-name">{{ $product['name'] }}</h3>
                        <p class="product-price">Harga: Rp. {{ number_format($product['price'], 0, ',', '.') }}</p>
                        <div class="quantity-form">
                            <form action="{{ route('update.cart') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $key }}">
                                <label for="quantity-{{ $key }}">Jumlah:</label>
                                <input type="number" id="quantity-{{ $key }}" name="quantity" value="{{ $product['quantity'] }}" min="1" class="quantity-input">
                                <button type="submit" class="update-button">Ubah</button>
                            </form>
                            <form action="{{ route('remove.cart') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="product_id" value="{{ $key }}">
                                <button type="submit" class="remove-button">Hapus</button>
                            </form>
                        </div>
                        <p class="product-total">Total: Rp. {{ number_format($product['quantity'] * $product['price'], 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="total-cart">Total Keranjang: Rp. {{ number_format($cart_total, 0, ',', '.') }}</p>
        <form action="{{ route('checkout') }}" method="get">
            <button type="submit" class="checkout-button">Pesan</button>
        </form>
    @else
        <p class="empty-cart">Keranjang Anda kosong.</p>
    @endif

    <a href="{{ route('index') }}" class="back-link">Kembali ke Daftar Makanan</a>
</div>
@endsection

<style>
    .notification {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        position: fixed;
        bottom: 10px;
        right: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
