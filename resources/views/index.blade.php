@extends('layouts.style')

@section('title', 'Kantin')

@section('content')
<head>
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
    <div class="container">
        <div class="main-content">
            @foreach($products as $product)
                <div class="card">
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" class="product-image">
                    <div class="product-info">
                        <h3>{{ $product->nama }}</h3>
                        <p>Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>
                    <button class="btn-tambah" onclick="openModal({{ $product->id }})">Tambah ke Keranjang</button>
                    <a href="{{ route('products.show', $product->id) }}" class="btn-show">Tampilkan Produk</a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Modal -->
    @foreach($products as $product)
        <div id="modal-{{ $product->id }}" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal({{ $product->id }})">&times;</span>
                <h2>{{ $product->nama }}</h2>
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" class="modal-product-image">
                <form action="{{ route('cart.add') }}" method="post" onsubmit="showNotification(event)">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <label for="quantity-{{ $product->id }}">Jumlah:</label>
                    <input type="number" id="quantity-{{ $product->id }}" name="quantity" value="1" min="1">
                    <button type="submit">Tambah ke Keranjang</button>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Notification -->
    <div id="notification" class="notification">
        <p>Produk telah ditambahkan ke keranjang!</p>
    </div>
@endsection

<script>
    function openModal(productId) {
        document.getElementById('modal-' + productId).style.display = 'block';
    }

    function closeModal(productId) {
        document.getElementById('modal-' + productId).style.display = 'none';
    }

    function showNotification(event) {
        event.preventDefault();
        const notification = document.getElementById('notification');
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 3000);
        
        const form = event.target;
        const formData = new FormData(form);
        const productId = formData.get('product_id');
        const quantity = formData.get('quantity');
        
        // Kirim permintaan AJAX untuk menambahkan produk ke keranjang
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': formData.get('_token')
            }
        }).then(response => {
            if (response.ok) {
                closeModal(productId);
            }
        });
    }
</script>
    