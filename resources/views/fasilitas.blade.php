@extends('layouts.main')

@section('content')
    <!-- Facilities Hero Section -->
    <section class="facilities-hero">
        <div class="facilities-container">
            <h1>Fasilitas Guma Landscape</h1>
            <p>Nikmati berbagai fasilitas terbaik kami yang dirancang untuk kenyamanan dan pengalaman tak terlupakan</p>
        </div>
    </section>

    <!-- Facilities Content -->
    <section class="facilities-page">
        <div class="facilities-container">
            <!-- Facility 1: Villa -->
            <div class="facility-item">
                <div class="facility-image">
                    <img src="{{ asset('images/villa.jpeg') }}" alt="Villa Guma Landscape">
                </div>
                <div class="facility-content">
                    <h3>Villa Eksklusif</h3>
                    <p>Villa mewah dengan pemandangan alam yang menakjubkan, dilengkapi dengan fasilitas modern untuk kenyamanan maksimal. Setiap villa didesain dengan konsep alam yang menyatu dengan lingkungan sekitar.</p>
                    <ul class="facility-features">
                        <li>Kamar dengan pemandangan langsung ke alam</li>
                        <li>AC dan fasilitas mandi air panas</li>
                        <li>Balkon pribadi dengan seating area</li>
                        <li>Free WiFi dan TV kabel</li>
                        <li>Kapasitas 2-6 orang per villa</li>
                    </ul>
                </div>
            </div>

            <!-- Facility 2: Restaurant -->
            <div class="facility-item reverse">
                <div class="facility-image">
                    <img src="{{ asset('images/restoran.jpeg') }}" alt="Restaurant Guma Landscape">
                </div>
                <div class="facility-content">
                    <h3>Restoran & Cafe</h3>
                    <p>Menikmati hidangan lezat sambil ditemani pemandangan alam yang memukau. Restaurant kami menyajikan berbagai menu tradisional dan internasional dengan bahan-bahan segar pilihan.</p>
                    <ul class="facility-features">
                        <li>Menu makanan Indonesia dan Western</li>
                        <li>Bahan-bahan organik dari kebun sendiri</li>
                        <li>Kapasitas 100 orang</li>
                        <li>Private dining area available</li>
                        <li>Live music di weekend</li>
                    </ul>
                </div>
            </div>

            <!-- Facility 3: Meeting Room -->
            <div class="facility-item">
                <div class="facility-image">
                    <img src="{{ asset('images/villa.jpeg') }}" alt="Meeting Room Guma Landscape">
                </div>
                <div class="facility-content">
                    <h3>Meeting & Gathering Area</h3>
                    <p>Ruang pertemuan yang nyaman dan profesional, cocok untuk berbagai acara seperti meeting perusahaan, family gathering, reunian, atau acara spesial lainnya.</p>
                    <ul class="facility-features">
                        <li>Kapasitas 50-200 orang</li>
                        <li>Full audio-visual equipment</li>
                        <li>Catering service available</li>
                        <li>Free WiFi high-speed</li>
                        <li>Outdoor & indoor option</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Facilities Grid -->
    <section style="padding: 60px 0; background: white;">
        <div class="facilities-container">
            <h2 class="section-title">Fasilitas Lainnya</h2>
            <div class="facilities-grid-page">
                <div class="facility-card-image">
                    <div class="facility-card-img">
                        <img src="{{ asset('images/villa.jpeg') }}" alt="Kolam Renang">
                    </div>
                    <div class="facility-card-content">
                        <h3>Kolam Renang</h3>
                        <p>Kolam renang dengan pemandangan alam, cocok untuk bersantai dan refreshing bersama keluarga.</p>
                    </div>
                </div>

                <div class="facility-card-image">
                    <div class="facility-card-img">
                        <img src="{{ asset('images/villa.jpeg') }}" alt="Fitness Center">
                    </div>
                    <div class="facility-card-content">
                        <h3>Fitness Center</h3>
                        <p>Fasilitas gym lengkap untuk menjaga kebugaran selama menginap di Guma Landscape.</p>
                    </div>
                </div>

                <div class="facility-card-image">
                    <div class="facility-card-img">
                        <img src="{{ asset('images/villa.jpeg') }}" alt="Kids Playground">
                    </div>
                    <div class="facility-card-content">
                        <h3>Kids Playground</h3>
                        <p>Area bermain anak yang aman dan menyenangkan dengan berbagai permainan edukatif.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection