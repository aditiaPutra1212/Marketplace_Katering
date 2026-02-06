@extends('layout.app')

@section('content')
<!-- Hero Section -->
<section class="py-5 text-center bg-white border-bottom animate-fade-up">
    <div class="container py-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold text-dark mb-4">Nikmati Hidangan Lezat <br><span class="text-danger">Dimana Saja, Kapan Saja</span></h1>
                <p class="lead text-muted mb-5">Pesan katering favoritmu dari merchant terpercaya dengan kualitas rasa bintang lima dan harga yang bersahabat.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#menu" class="btn btn-danger btn-lg px-5 rounded-pill shadow-sm">Jelajahi Menu</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg px-5 rounded-pill">Mulai Jualan</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats / About Brief Section -->
<section id="about" class="py-5 bg-light">
    <div class="container">
        <div class="row text-center g-4 animate-fade-up" style="animation-delay: 0.2s;">
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <div class="display-5 text-danger mb-3"><i class="bi bi-shop"></i></div>
                    <h5 class="fw-bold">Merchant Terpercaya</h5>
                    <p class="text-muted mb-0">Ratusan merchant katering pilihan dengan standar kebersihan tinggi.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <div class="display-5 text-danger mb-3"><i class="bi bi-truck"></i></div>
                    <h5 class="fw-bold">Pengiriman Cepat</h5>
                    <p class="text-muted mb-0">Sistem logistik yang memastikan makanan sampai tepat waktu.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <div class="display-5 text-danger mb-3"><i class="bi bi-shield-check"></i></div>
                    <h5 class="fw-bold">Kualitas Terjamin</h5>
                    <p class="text-muted mb-0"> Bahan segar pilihan untuk setiap hidangan yang kami sajikan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Menu Section -->
<section id="menu" class="py-5">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-end mb-5 animate-fade-up">
            <div>
                <h6 class="text-danger fw-bold text-uppercase">Pilihan Menu</h6>
                <h2 class="fw-bold">Menu Katering Terpopuler</h2>
            </div>
            <a href="{{ route('login') }}" class="text-decoration-none text-danger fw-bold">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>

        <div class="row g-4">
            @forelse($menus as $menu)
                <div class="col-lg-3 col-md-6 animate-fade-up" style="animation-delay: {{ 0.1 * $loop->index }}s">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
                        <div style="height: 200px; position: relative;">
                            @if($menu->photo)
                                <img src="{{ asset('storage/' . $menu->photo) }}" class="card-img-top h-100 w-100 object-fit-cover" alt="{{ $menu->name }}">
                            @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center h-100 text-white">
                                    <i class="bi bi-image h1"></i>
                                </div>
                            @endif
                            <div class="position-absolute bottom-0 start-0 p-3 w-100 bg-gradient-dark text-white" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                <span class="badge bg-danger rounded-pill">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold text-dark mb-0">{{ $menu->name }}</h5>
                                <span class="badge bg-light text-danger border border-danger small">{{ $menu->category }}</span>
                            </div>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-shop me-1 text-danger"></i> 
                                <a href="{{ route('merchant.public_profile', $menu->merchant->id) }}" class="text-muted text-decoration-none hover-danger">
                                    {{ $menu->merchant->company_name ?? $menu->merchant->user->name }}
                                </a>
                            </p>
                            
                            <div class="card-text text-muted mb-4" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#detailModal{{ $menu->id }}">
                                <p class="mb-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 3em;">
                                    {{ $menu->description }}
                                </p>
                                <small class="text-danger fw-bold">Lihat Detail...</small>
                            </div>
                            
                            @auth
                                @if(Auth::user()->role == 'customer')
                                    <button type="button" class="btn btn-danger w-100 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#detailModal{{ $menu->id }}">Pesan Sekarang</button>
                                @else
                                    <button disabled class="btn btn-secondary w-100 rounded-pill fw-bold">Pesan Sekarang</button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-danger w-100 rounded-pill fw-bold">Pesan Sekarang</a>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Modal Detail Menu -->
                <div class="modal fade" id="detailModal{{ $menu->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $menu->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 rounded-4 overflow-hidden">
                            <div class="modal-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-6">
                                        @if($menu->photo)
                                            <img src="{{ asset('storage/' . $menu->photo) }}" class="img-fluid h-100 w-100 object-fit-cover" style="min-height: 400px;" alt="{{ $menu->name }}">
                                        @else
                                            <div class="bg-secondary d-flex align-items-center justify-content-center h-100 text-white" style="min-height: 400px;">
                                                <i class="bi bi-image h1"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 p-4 p-lg-5">
                                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div class="mb-4">
                                            <span class="badge bg-danger rounded-pill mb-2">{{ $menu->category }}</span>
                                            <h3 class="fw-bold text-dark mb-1">{{ $menu->name }}</h3>
                                            <p class="text-danger fw-bold h4">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-muted text-uppercase small mb-2">Deskripsi Menu:</h6>
                                            <p class="text-muted">{{ $menu->description }}</p>
                                        </div>

                                        <div class="mb-4 p-3 bg-light rounded-3">
                                            <h6 class="fw-bold mb-1">
                                                <i class="bi bi-shop text-danger me-2"></i>
                                                <a href="{{ route('merchant.public_profile', $menu->merchant->id) }}" class="text-dark text-decoration-none">
                                                    {{ $menu->merchant->company_name ?? $menu->merchant->user->name }}
                                                </a>
                                            </h6>
                                            <p class="small text-muted mb-0"><i class="bi bi-geo-alt me-1"></i> {{ $menu->merchant->address }}</p>
                                        </div>

                                        @auth
                                            @if(Auth::user()->role == 'customer')
                                                <form action="{{ route('customer.order.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                                    <div class="row">
                                                        <div class="col-md-5 mb-3">
                                                            <label class="form-label small fw-bold">Jumlah Porsi</label>
                                                            <input type="number" name="quantity" class="form-control rounded-3" value="10" min="1" required>
                                                        </div>
                                                        <div class="col-md-7 mb-3">
                                                            <label class="form-label small fw-bold">Tgl Pengiriman</label>
                                                            <input type="date" name="delivery_date" class="form-control rounded-3" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold">Alamat Pengiriman</label>
                                                        <textarea name="delivery_address" class="form-control rounded-3" rows="2" required>{{ Auth::user()->customer->address ?? '' }}</textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger w-100 rounded-pill py-2 fw-bold shadow-sm">PESAN SEKARANG</button>
                                                </form>
                                            @else
                                                <p class="text-muted small text-center mb-0">Hanya pelanggan yang dapat memesan.</p>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-danger w-100 rounded-pill py-2 fw-bold shadow-sm">
                                                LOGIN UNTUK MEMESAN <i class="bi bi-arrow-right ms-2"></i>
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="display-1 text-muted"><i class="bi bi-emoji-frown"></i></div>
                    <h4 class="text-muted mt-3">Belum ada menu yang tersedia.</h4>
                    <p>Jadilah merchant pertama yang menawarkan katering lezat di sini!</p>
                    <a href="{{ route('register') }}" class="btn btn-danger px-4 rounded-pill">Daftar Merchant</a>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-danger text-white mt-5">
    <div class="container py-lg-4 text-center">
        <h2 class="fw-bold mb-4">Siap untuk Memulai Hidangan Spesial Anda?</h2>
        <p class="lead mb-5 opacity-75">Gabung bersama ribuan customer lainnya yang sudah menikmati kemudahan memesan katering.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 rounded-pill text-danger fw-bold shadow-sm">Daftar Sekarang</a>
            <a href="#contact" class="btn btn-outline-light btn-lg px-5 rounded-pill">Hubungi Kami</a>
        </div>
    </div>
</section>

<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endsection
