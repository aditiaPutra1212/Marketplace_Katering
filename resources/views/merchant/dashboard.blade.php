@extends('layout.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <h5>{{ $merchant->company_name }}</h5>
                <p class="text-muted">{{ $merchant->address }}</p>
                <span class="badge bg-success">Merchant</span>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Tambah Menu Baru</div>
            <div class="card-body">
                <form action="{{ route('merchant.menu.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label>Nama Makanan</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Harga (Rp)</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Foto</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control" rows="2" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Simpan Menu</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <h4>📦 Pesanan Masuk (Invoice)</h4>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Menu</th>
                            <th>Jml</th>
                            <th>Total</th>
                            <th>Tgl Kirim</th>
                            <th>Pemesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->invoice_number }}</td>
                            <td>{{ $order->menu->name }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>Rp {{ number_format($order->total_price) }}</td>
                            <td>{{ $order->delivery_date }}</td>
                            <td>
                                <strong>{{ $order->user->name }}</strong><br>
                                <small class="text-muted">Status: {{ ucfirst($order->status) }}</small>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada pesanan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection