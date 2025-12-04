@extends('layouts.main')

@section('content')
    <section style="padding: 100px 0 80px; background: var(--light);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <h1 style="color: var(--primary); text-align: center; margin-bottom: 3rem;">Menu Kami</h1>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <div class="card">
                    <h3>Makanan Indonesia</h3>
                    <p>Berbagai hidangan tradisional</p>
                </div>
                <div class="card">
                    <h3>Minuman Segar</h3>
                    <p>Juice dan minuman khas</p>
                </div>
                <div class="card">
                    <h3>Snack</h3>
                    <p>Camilan ringan</p>
                </div>
            </div>
        </div>
    </section>
@endsection