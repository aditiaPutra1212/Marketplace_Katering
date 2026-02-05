@extends('layout.app')

@section('content')
<h3>🧾 Riwayat Pesanan Saya (Invoice)</h3>
<div class="card mt-3">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Menu</th>
                    <th>Katering</th>
                    <th>Tgl Kirim</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><code>{{ $order->invoice_number }}</code></td>
                    <td>{{ $order->menu->name }} ({{ $order->quantity }} porsi)</td>
                    <td>{{ $order->menu->merchant->company_name }}</td>
                    <td>{{ $order->delivery_date }}</td>
                    <td class="fw-bold">Rp {{ number_format($order->total_price) }}</td>
                    <td>
                        <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : 'success' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada riwayat pesanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection