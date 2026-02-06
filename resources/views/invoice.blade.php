@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4 d-print-none">
                <a href="{{ url()->previous() }}" class="text-danger text-decoration-none fw-bold"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden" id="printableInvoice">
                <div class="card-header bg-danger text-white py-4 px-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-0">INVOICE</h2>
                            <p class="mb-0 opacity-75">#{{ $order->invoice_number }}</p>
                        </div>
                        <div class="text-end">
                            <h4 class="fw-bold mb-0">Marketplace Katering</h4>
                            <p class="mb-0 small opacity-75">Solusi Katering Terpercaya</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-5">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h6 class="text-muted text-uppercase small fw-bold mb-3">Tagihan Untuk:</h6>
                            @if($order->user->customer)
                                <h5 class="fw-bold mb-1">{{ $order->user->customer->company_name }}</h5>
                                <p class="text-muted mb-0 small"><i class="bi bi-person me-1"></i> PIC: {{ $order->user->name }}</p>
                                <p class="text-muted mb-0 small"><i class="bi bi-geo-alt me-1"></i> {{ $order->user->customer->address }}</p>
                                <p class="text-muted mb-0 small"><i class="bi bi-telephone me-1"></i> {{ $order->user->customer->contact }}</p>
                            @else
                                <h5 class="fw-bold mb-1">{{ $order->user->name }}</h5>
                                <p class="text-muted mb-0">{{ $order->user->email }}</p>
                            @endif
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h6 class="text-muted text-uppercase small fw-bold mb-3">Dibayar Kepada:</h6>
                            <h5 class="fw-bold mb-1 text-danger">{{ $order->menu->merchant->company_name }}</h5>
                            <p class="text-muted mb-0">{{ $order->menu->merchant->address }}</p>
                            <p class="text-muted mb-0">Hubungi: {{ $order->menu->merchant->contact }}</p>
                        </div>
                    </div>

                    <div class="table-responsive mb-5">
                        <table class="table border-bottom">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 ps-3">Deskripsi Produk</th>
                                    <th class="py-3 text-center">Harga Satuan</th>
                                    <th class="py-3 text-center">Jumlah</th>
                                    <th class="py-3 text-end pe-3">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-middle">
                                    <td class="py-4 ps-3">
                                        <div class="fw-bold h6 mb-1">{{ $order->menu->name }}</div>
                                        <span class="badge bg-light text-danger border border-danger small">{{ $order->menu->category }}</span>
                                        <div class="small text-muted mt-2">
                                            <strong><i class="bi bi-calendar-event me-1"></i> Jadwal:</strong> {{ date('d F Y', strtotime($order->delivery_date)) }} <br>
                                            <strong><i class="bi bi-truck me-1"></i> Alamat Kirim:</strong> {{ $order->delivery_address }}
                                        </div>
                                    </td>
                                    <td class="text-center">Rp {{ number_format($order->menu->price) }}</td>
                                    <td class="text-center">{{ $order->quantity }} Porsi</td>
                                    <td class="text-end pe-3 fw-bold">Rp {{ number_format($order->total_price) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <div class="bg-light p-4 rounded-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">Status Pembayaran:</span>
                                    <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : 'success' }} px-3 rounded-pill">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 fw-bold mb-0">Total Tagihan</span>
                                    <span class="h4 fw-bold text-danger mb-0">Rp {{ number_format($order->total_price) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 pt-5 border-top text-center text-muted small">
                        <p class="mb-1">Terima kasih telah menggunakan layanan Marketplace Katering.</p>
                        <p class="mb-0">Invoice ini adalah dokumen sah yang dihasilkan secara otomatis oleh sistem.</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5 d-print-none">
                <button onclick="window.print()" class="btn btn-dark rounded-pill px-5 py-2 fw-bold">
                    <i class="bi bi-printer me-2"></i> CETAK INVOICE
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .navbar, .footer, .d-print-none { display: none !important; }
        body { background-color: white !important; }
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
        .container { width: 100% !important; max-width: 100% !important; padding: 0 !important; }
    }
</style>
@endsection
