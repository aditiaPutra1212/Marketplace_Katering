@extends('layout.app')

@section('content')
<div class="container py-4">
    <!-- Header & Search Section -->
    <div class="row mb-5 animate-fade-up">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-1">Cari Katering Favoritmu</h2>
            <p class="text-muted">Temukan berbagai pilihan menu lezat untuk kebutuhan kantormu.</p>
        </div>
        <div class="col-lg-4 d-flex align-items-center">
            <form action="{{ route('customer.dashboard') }}" method="GET" class="w-100">
                <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                    <span class="input-group-text bg-white border-0 ps-3"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-0 py-2" placeholder="Cari menu, jenis, atau lokasi..." value="{{ request('search') }}">
                    <button class="btn btn-danger px-4" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="mb-5 animate-fade-up" style="animation-delay: 0.1s">
        <h6 class="fw-bold text-muted text-uppercase small mb-3">Pilih Jenis Makanan:</h6>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('customer.dashboard') }}" class="btn {{ !request('search') ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4 btn-sm">Semua</a>
            <a href="{{ route('customer.dashboard', ['search' => 'Nasi Box']) }}" class="btn {{ request('search') == 'Nasi Box' ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4 btn-sm">Nasi Box</a>
            <a href="{{ route('customer.dashboard', ['search' => 'Prasmanan']) }}" class="btn {{ request('search') == 'Prasmanan' ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4 btn-sm">Prasmanan</a>
            <a href="{{ route('customer.dashboard', ['search' => 'Snack Box']) }}" class="btn {{ request('search') == 'Snack Box' ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4 btn-sm">Snack Box</a>
            <a href="{{ route('customer.dashboard', ['search' => 'Tumpeng']) }}" class="btn {{ request('search') == 'Tumpeng' ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4 btn-sm">Tumpeng</a>
        </div>
    </div>

    <div class="row g-4">
        @forelse($menus as $menu)
        <div class="col-lg-3 col-md-6 animate-fade-up" style="animation-delay: {{ 0.1 * $loop->index }}s">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
                <div style="height: 180px; position: relative;">
                    @if($menu->photo)
                        <img src="{{ asset('storage/' . $menu->photo) }}" class="card-img-top h-100 w-100 object-fit-cover" alt="{{ $menu->name }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center h-100 text-muted">
                            <i class="bi bi-image h1"></i>
                        </div>
                    @endif
                    <div class="position-absolute top-0 end-0 p-2">
                        <span class="badge bg-danger rounded-pill shadow-sm">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="mb-2">
                        <span class="badge bg-light text-danger border border-danger small">{{ $menu->category }}</span>
                    </div>
                    <h5 class="card-title fw-bold text-dark mb-1">{{ $menu->name }}</h5>
                    <p class="text-muted small mb-3"><i class="bi bi-shop me-1 text-danger"></i> {{ $menu->merchant->company_name }}</p>
                    
                    <div class="card-text text-muted small mb-4" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#orderModal{{ $menu->id }}">
                        <p class="mb-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 3em;">
                            {{ $menu->description }}
                        </p>
                        <small class="text-danger fw-bold">Lihat Detail...</small>
                    </div>
                    
                    <button type="button" class="btn btn-danger w-100 rounded-pill fw-bold" data-bs-toggle="modal" data-bs-target="#orderModal{{ $menu->id }}">
                        Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Detail & Pesan -->
        <div class="modal fade" id="orderModal{{ $menu->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg">
                    <div class="modal-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-5">
                                @if($menu->photo)
                                    <img src="{{ asset('storage/' . $menu->photo) }}" class="img-fluid h-100 w-100 object-fit-cover" style="min-height: 400px;" alt="{{ $menu->name }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center h-100 text-muted" style="min-height: 400px;">
                                        <i class="bi bi-image h1"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-7 p-4 p-lg-5">
                                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                <form action="{{ route('customer.order.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    
                                    <div class="mb-4">
                                        <span class="badge bg-danger rounded-pill mb-2">{{ $menu->category }}</span>
                                        <h3 class="fw-bold text-dark mb-1">{{ $menu->name }}</h3>
                                        <p class="text-danger fw-bold h4 mb-3">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                        <h6 class="fw-bold text-muted text-uppercase small mb-2">Deskripsi Menu:</h6>
                                        <p class="text-muted small mb-0">{{ $menu->description }}</p>
                                    </div>

                                    <hr class="my-4">

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Jumlah Porsi</label>
                                            <input type="number" name="quantity" class="form-control rounded-3" value="10" min="1" required shadow-sm>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Tanggal Pengiriman</label>
                                            <input type="date" name="delivery_date" class="form-control rounded-3" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-bold">Alamat Pengiriman</label>
                                            <textarea name="delivery_address" class="form-control rounded-3" rows="2" required placeholder="Alamat lengkap pengiriman...">{{ Auth::user()->customer->address ?? '' }}</textarea>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-danger w-100 rounded-pill py-2 fw-bold shadow-sm mt-4">
                                        KONFIRMASI PESANAN <i class="bi bi-check-circle ms-2"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @empty
        <div class="col-12 text-center py-5">
            <div class="display-1 text-muted"><i class="bi bi-emoji-frown"></i></div>
            <h4 class="text-muted mt-3">Tidak ada menu ditemukan.</h4>
            <p>Cobalah kata kunci lain atau pilih kategori yang tersedia.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    .card-hover {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05) !important;
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