@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Selamat Datang di</h2>
            <h1>Guma Landscape</h1>
            <p>Nikmati keindahan alam dengan fasilitas lengkap, area luas, dan berbagai layanan terbaik untuk acara keluarga, gathering, dan reservasi villa.</p>
            <a href="{{ url('/reservasi') }}" class="cta-button">Reservasi Sekarang</a>
        </div>
    </section>

    <!-- Facilities Section -->
    <section class="facilities">
        <h2 class="section-title-center">Fasilitas Kami</h2>
        <div class="facilities-grid">
            <div class="facility-card">
                <h3>Villa Eksklusif</h3>
                <p>Penginapan mewah dengan pemandangan alam yang menakjubkan dan fasilitas lengkap untuk kenyamanan maksimal.</p>
            </div>
            <div class="facility-card">
                <h3>Restaurant & Cafe</h3>
                <p>Menu makanan dan minuman terbaik dengan bahan-bahan segar dan berkualitas, ditemani pemandangan alam.</p>
            </div>
            <div class="facility-card">
                <h3>Area Gathering</h3>
                <p>Lokasi perfect untuk acara keluarga, reunian, meeting perusahaan, dan gathering dengan kapasitas besar.</p>
            </div>
        </div>
    </section>
@endsection