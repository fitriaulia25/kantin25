@extends('layouts.style')

@section('title', $product->nama)

@section('content')
    <div class="container">
        <div class="card-detail">
            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}">
            <div class="detail-content">
                <h1>{{ $product->nama }}</h1>
                <p><strong>Harga:</strong> Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
                <p><strong></strong> {{ $product->deskripsi }}</p>
                    <a href="{{ route('index') }}" class="back-link">Kembali ke Daftar Makanan</a>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>body {
    font-family: Arial, sans-serif;
    background-color: #F0EBE3;
    margin: 0;
}

.navbar {
    width: 100%;
    background-color: #333;
    overflow: hidden;
    position: fixed;
    top: 0;
    z-index: 1000;
    display: flex;
    justify-content: center;
    padding: 10px 0;
    padding-top: 60px;
    position: sticky;
    top: 0;
}

.navbar a {
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
}

.navbar a:hover {
    background-color: #ddd;
    color: black;
}

.content {
    margin-top: 60px; /* Sesuaikan nilai ini agar konten tidak tertutup navbar */
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.card-detail {
    background-color: #FFFFFF;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    max-width: 600px;
    margin: 20px;
}

.card-detail img {
    max-width: 300px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.detail-content {
    max-width: 500px;
}

.detail-content h1 {
    font-size: 2em;
    margin-bottom: 10px;
}

.detail-content p {
    font-size: 1.2em;
    margin-bottom: 10px;
}

.back-link {
    background-color: #ADBC9F;
    color: black;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    margin-top: 10px;
}

.back-link:hover {
    background-color: #6B8A7A;
}

</style>
