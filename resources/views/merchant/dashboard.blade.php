@extends('layout.app')

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <!-- Sidebar: Merchant Info & Add Menu -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4 animate-fade-up">
                <div class="card-body text-center p-4">
                    <div class="bg-danger text-white d-inline-block p-3 rounded-circle mb-3">
                        <i class="bi bi-shop h3 mb-0"></i>
                    </div>
                    <h5 class="fw-bold mb-1">{{ $merchant->company_name }}</h5>
                    <p class="text-muted small mb-3">{{ $merchant->address }}</p>
                    <div class="d-grid gap-2">
                        <span class="badge bg-danger px-3 rounded-pill py-2 mb-2">Merchant Aktif</span>
                        <a href="{{ route('merchant.profile') }}" class="btn btn-sm btn-outline-danger rounded-pill">Edit Profil Katering</a>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 animate-fade-up" style="animation-delay: 0.1s">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">Tambah Menu Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('merchant.menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Nama Menu</label>
                                <input type="text" name="name" class="form-control rounded-3" placeholder="Contoh: Nasi Box Ayam Bakar" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Jenis Makanan</label>
                                <input type="text" name="category" class="form-control rounded-3" placeholder="Contoh: Prasmanan, Nasi Box, Snack" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Harga (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">Rp</span>
                                <input type="number" name="price" class="form-control rounded-3 border-start-0" placeholder="0" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Foto Menu</label>
                            <input type="file" name="photo" class="form-control rounded-3">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Jelaskan detail menu Anda..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 rounded-pill py-2 fw-bold">Simpan Menu</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content: Orders & Menu Management -->
        <div class="col-lg-8">
            <!-- Menus Management -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 animate-fade-up" style="animation-delay: 0.2s">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Daftar Menu Saya</h5>
                    <span class="badge bg-light text-dark">{{ count($menus) }} Menu</span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @forelse($menus as $menu)
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border rounded-4">
                                    <div class="flex-shrink-0" style="width: 70px; height: 70px;">
                                        @if($menu->photo)
                                            <img src="{{ asset('storage/' . $menu->photo) }}" class="rounded-3 w-100 h-100 object-fit-cover" alt="">
                                        @else
                                            <div class="bg-light rounded-3 w-100 h-100 d-flex align-items-center justify-content-center">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3 overflow-hidden">
                                        <h6 class="fw-bold mb-0 text-truncate">{{ $menu->name }}</h6>
                                        <span class="badge bg-light text-danger border border-danger small mb-1">{{ $menu->category }}</span>
                                        <p class="text-danger small fw-bold mb-2">Rp {{ number_format($menu->price) }}</p>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('merchant.menu.edit', $menu->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Edit</a>
                                            <form action="{{ route('merchant.menu.delete', $menu->id) }}" method="POST" onsubmit="return confirm('Hapus menu ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-4">
                                <p class="text-muted">Belum ada menu. Mulai tambahkan menu pertama Anda!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Incoming Orders -->
            <div class="card border-0 shadow-sm rounded-4 animate-fade-up" style="animation-delay: 0.3s">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">📦 Pesanan Masuk</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Invoice</th>
                                    <th>Menu</th>
                                    <th>Total</th>
                                    <th>Tgl Kirim</th>
                                <tr>
                                    <th class="ps-4">Invoice</th>
                                    <th>Menu</th>
                                    <th>Total</th>
                                    <th>Tgl Kirim</th>
                                    <th>Pemesanan</th>
                                    <th class="pe-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td class="ps-4">
                                        <a href="{{ route('invoice.show', $order->invoice_number) }}" class="fw-bold text-danger">#{{ $order->invoice_number }}</a>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $order->menu->name }}</div>
                                        <span class="badge bg-light text-danger border border-danger small">{{ $order->menu->category }}</span>
                                        <br><small class="text-muted">{{ $order->quantity }} porsi</small>
                                    </td>
                                    <td><span class="fw-bold">Rp {{ number_format($order->total_price) }}</span></td>
                                    <td class="text-muted">{{ date('d M Y', strtotime($order->delivery_date)) }}</td>
                                    <td>
                                        <strong>{{ $order->user->name }}</strong><br>
                                        @php
                                            $statusClass = [
                                                'pending' => 'bg-warning',
                                                'accepted' => 'bg-primary',
                                                'paid' => 'bg-info',
                                                'completed' => 'bg-success text-white',
                                                'cancelled' => 'bg-danger text-white'
                                            ][$order->status] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $statusClass }} rounded-pill small" style="font-size: 0.7rem;">{{ strtoupper($order->status) }}</span>
                                    </td>
                                    <td class="pe-4 text-center">
                                        @if($order->status == 'pending')
                                            <form action="{{ route('merchant.order.accept', $order->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm">
                                                    <i class="bi bi-check-circle me-1"></i> Terima
                                                </button>
                                            </form>
                                        @elseif(in_array($order->status, ['accepted', 'paid']))
                                            <form action="{{ route('merchant.order.complete', $order->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                                                    <i class="bi bi-flag me-1"></i> Selesai
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">Belum ada pesanan masuk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .object-fit-cover { object-fit: cover; }
</style>
@endsection
