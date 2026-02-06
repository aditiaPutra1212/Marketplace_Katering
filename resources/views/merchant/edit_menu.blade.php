@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('merchant.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Menu</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-4 animate-fade-up">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="fw-bold mb-0 text-center">Edit Menu Katering</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('merchant.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3 text-center">
                            <label class="form-label d-block small fw-bold mb-3">Foto Menu Saat Ini</label>
                            @if($menu->photo)
                                <img src="{{ asset('storage/' . $menu->photo) }}" class="rounded-4 mb-3 shadow-sm object-fit-cover" style="width: 200px; height: 150px;" alt="">
                            @else
                                <div class="bg-light rounded-4 mb-3 mx-auto d-flex align-items-center justify-content-center" style="width: 200px; height: 150px;">
                                    <i class="bi bi-image h1 text-muted"></i>
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Ganti Foto (Opsional)</label>
                            <input type="file" name="photo" class="form-control rounded-3">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Menu</label>
                            <input type="text" name="name" class="form-control rounded-3" value="{{ old('name', $menu->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Jenis Makanan</label>
                            <input type="text" name="category" class="form-control rounded-3" value="{{ old('category', $menu->category) }}" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold">Harga (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">Rp</span>
                                    <input type="number" name="price" class="form-control rounded-3 border-start-0" value="{{ old('price', $menu->price) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control rounded-3" rows="4" required>{{ old('description', $menu->description) }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('merchant.dashboard') }}" class="btn btn-light rounded-pill px-4 py-2 w-50">Batal</a>
                            <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 w-50 fw-bold">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .object-fit-cover { object-fit: cover; }
</style>
@endsection
