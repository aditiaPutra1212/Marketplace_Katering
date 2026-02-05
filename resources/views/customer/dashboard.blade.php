@extends('layout.app')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <form action="{{ route('customer.dashboard') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari menu, nama katering, atau lokasi..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    @forelse($menus as $menu)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm">
            @if($menu->photo)
                <img src="{{ asset('storage/' . $menu->photo) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 150px;">No Image</div>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $menu->name }}</h5>
                <p class="text-danger fw-bold">Rp {{ number_format($menu->price) }}</p>
                <p class="small text-muted mb-1">
                    🏢 {{ $menu->merchant->company_name }} <br>
                    📍 {{ $menu->merchant->address }}
                </p>
                <p class="card-text small">{{ Str::limit($menu->description, 50) }}</p>
                
                <button type="button" class="btn btn-sm btn-primary w-100" data-bs-toggle="modal" data-bs-target="#orderModal{{ $menu->id }}">
                    Pesan Sekarang
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderModal{{ $menu->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('customer.order.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Pesan: {{ $menu->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <div class="mb-3">
                            <label>Jumlah Porsi</label>
                            <input type="number" name="quantity" class="form-control" value="10" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Pengiriman</label>
                            <input type="date" name="delivery_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Konfirmasi Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @empty
    <div class="col-12 text-center py-5">
        <h4>Tidak ada menu ditemukan.</h4>
    </div>
    @endforelse
</div>
@endsection