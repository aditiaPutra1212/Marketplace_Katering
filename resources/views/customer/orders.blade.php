@extends('layout.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 animate-fade-up">
        <div>
            <h2 class="fw-bold mb-1">Riwayat Pesanan</h2>
            <p class="text-muted">Pantau status pesanan katering kantor Anda di sini.</p>
        </div>
        <div class="bg-danger text-white p-3 rounded-4 shadow-sm">
            <i class="bi bi-receipt h3 mb-0"></i>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4 animate-fade-up">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden animate-fade-up" style="animation-delay: 0.1s">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase small fw-bold text-muted">No. Invoice</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Menu & Jumlah</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Merchant</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Tgl Pengiriman</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Total Bayar</th>
                        <th class="py-3 text-uppercase small fw-bold text-muted">Status</th>
                        <th class="py-3 text-center text-uppercase small fw-bold text-muted pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold text-dark">#{{ $order->invoice_number }}</span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $order->menu->name }}</div>
                            <div class="small text-muted">{{ $order->quantity }} Porsi</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle p-2 me-2">
                                    <i class="bi bi-shop text-danger"></i>
                                </div>
                                <span class="small fw-bold">{{ $order->menu->merchant->company_name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="small"><i class="bi bi-calendar-event me-1 text-muted"></i> {{ date('d M Y', strtotime($order->delivery_date)) }}</div>
                        </td>
                        <td>
                            <div class="fw-bold text-danger">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        </td>
                        <td>
                            @php
                                $statusClass = [
                                    'pending' => 'warning',
                                    'paid' => 'success',
                                    'completed' => 'primary',
                                    'cancelled' => 'danger'
                                ][$order->status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $statusClass }} rounded-pill px-3 py-2 small shadow-sm">
                                <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem"></i>
                                {{ strtoupper($order->status) }}
                            </span>
                        </td>
                        <td class="text-center pe-4">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('invoice.show', $order->invoice_number) }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm">
                                    <i class="bi bi-file-earmark-text me-1"></i> Invoice
                                </a>
                                @if($order->status == 'pending')
                                    <form action="{{ route('customer.order.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-x-circle me-1"></i> Batalkan
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="display-4 text-muted mb-3"><i class="bi bi-inbox"></i></div>
                            <h5 class="text-muted">Belum ada riwayat pesanan.</h5>
                            <a href="{{ route('customer.dashboard') }}" class="btn btn-danger btn-sm rounded-pill px-4 mt-3">Mulai Pesan Sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection