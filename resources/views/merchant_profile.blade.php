@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        <!-- Merchant Info -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                <div class="card-body p-4 text-center">
                    <div class="bg-danger text-white d-inline-block p-4 rounded-circle mb-4 shadow-sm">
                        <i class="bi bi-shop h1 mb-0"></i>
                    </div>
                    <h2 class="fw-bold mb-2">{{ $merchant->company_name }}</h2>
                    <p class="text-muted mb-4"><i class="bi bi-geo-alt me-2 text-danger"></i> {{ $merchant->address }}</p>
                    
                    <div class="bg-light p-3 rounded-4 mb-4 text-start">
                        <h6 class="fw-bold mb-2 text-dark">Kontak Katering:</h6>
                        <p class="mb-0 text-muted small"><i class="bi bi-telephone me-2 text-primary"></i>{{ $merchant->contact }}</p>
                    </div>

                    <div class="text-start mb-4">
                        <h6 class="fw-bold mb-2 text-dark">Tentang Kami:</h6>
                        <p class="text-muted small lh-lg mb-0">{{ $merchant->description ?? 'Belum ada deskripsi.' }}</p>
                    </div>

                    <div class="d-grid">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $merchant->contact) }}" target="_blank" class="btn btn-success rounded-pill py-2 shadow-sm">
                            <i class="bi bi-whatsapp me-2"></i> Chat via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Merchant Menus -->
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Daftar Menu</h3>
                <span class="badge bg-danger rounded-pill px-3 py-2">{{ count($merchant->menus) }} Menu</span>
            </div>

            <div class="row g-4">
                @forelse($merchant->menus as $menu)
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden menu-card">
                            <div class="position-relative">
                                @if($menu->photo)
                                    <img src="{{ asset('storage/' . $menu->photo) }}" class="card-img-top object-fit-cover" style="height: 200px;" alt="{{ $menu->name }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="bi bi-image h1 text-muted"></i>
                                    </div>
                                @endif
                                <div class="position-absolute bottom-0 start-0 m-3 px-3 py-1 bg-white rounded-pill shadow-sm">
                                    <span class="text-danger fw-bold small">Rp {{ number_format($menu->price) }}</span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <span class="badge bg-light text-danger border border-danger small mb-2">{{ $menu->category }}</span>
                                <h5 class="card-title fw-bold text-dark mb-3">{{ $menu->name }}</h5>
                                
                                <p class="card-text text-muted small mb-4" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 3em;">
                                    {{ $menu->description }}
                                </p>
                                
                                @auth
                                    @if(Auth::user()->role == 'customer')
                                        <button type="button" class="btn btn-danger w-100 rounded-pill fw-bold py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#orderModal{{ $menu->id }}">
                                            Pesan Sekarang
                                        </button>
                                    @else
                                        <button disabled class="btn btn-secondary w-100 rounded-pill py-2 fw-bold">Login sebagai Customer</button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-danger w-100 rounded-pill fw-bold py-2 shadow-sm">
                                        Pesan Sekarang
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>

                    @if(Auth::check() && Auth::user()->role == 'customer')
                        <!-- Order Modal -->
                        <div class="modal fade" id="orderModal{{ $menu->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4 overflow-hidden shadow">
                                    <div class="row g-0">
                                        <div class="col-lg-5">
                                            @if($menu->photo)
                                                <img src="{{ asset('storage/' . $menu->photo) }}" class="img-fluid h-100 object-fit-cover" style="min-height: 400px;" alt="{{ $menu->name }}">
                                            @else
                                                <div class="bg-light h-100 d-flex align-items-center justify-content-center" style="min-height: 400px;">
                                                    <i class="bi bi-image h1 text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="modal-header border-0 pb-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body p-4 pt-0">
                                                <span class="badge bg-danger rounded-pill px-3 py-1 mb-2">{{ $menu->category }}</span>
                                                <h3 class="fw-bold text-dark mb-1">{{ $menu->name }}</h3>
                                                <h4 class="text-danger fw-bold mb-4">Rp {{ number_format($menu->price) }}</h4>
                                                
                                                <div class="mb-4">
                                                    <h6 class="fw-bold text-dark small text-uppercase">Deskripsi Menu:</h6>
                                                    <p class="text-muted small mb-0">{{ $menu->description }}</p>
                                                </div>

                                                <form action="{{ route('customer.order.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                                    
                                                    <div class="row">
                                                        <div class="col-md-5 mb-3">
                                                            <label class="form-label small fw-bold">Jumlah Porsi</label>
                                                            <div class="input-group">
                                                                <input type="number" name="quantity" class="form-control rounded-3" value="10" min="1" required>
                                                                <span class="input-group-text bg-white small">Porsi</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7 mb-3">
                                                            <label class="form-label small fw-bold">Tanggal Pengiriman</label>
                                                            <input type="date" name="delivery_date" class="form-control rounded-3" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label class="form-label small fw-bold">Alamat Pengiriman</label>
                                                        <textarea name="delivery_address" class="form-control rounded-3" rows="2" placeholder="Masukkan alamat lengkap pengiriman..." required>{{ Auth::user()->customer->address ?? '' }}</textarea>
                                                        <small class="text-muted" style="font-size: 0.7rem;">Default: Alamat kantor Anda</small>
                                                    </div>

                                                    <button type="submit" class="btn btn-danger w-100 rounded-pill py-3 fw-bold shadow-sm">
                                                        BUAT PESANAN SEKARANG
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="bg-light p-5 rounded-4">
                            <i class="bi bi-egg-fried h1 text-muted d-block mb-3"></i>
                            <p class="text-muted mb-0">Merchant ini belum menambahkan menu apapun.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
    .menu-card {
        transition: all 0.3s ease;
    }
    .menu-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .object-fit-cover { object-fit: cover; }
</style>
@endsection
