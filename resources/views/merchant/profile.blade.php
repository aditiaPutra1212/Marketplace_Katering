@extends('layout.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('merchant.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profil Katering</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-4 animate-fade-up">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="fw-bold mb-0 text-center text-danger">Pengelolaan Profil Katering</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('merchant.profile.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Perusahaan Katering</label>
                            <input type="text" name="company_name" class="form-control rounded-3" value="{{ old('company_name', $merchant->company_name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">No Kontak / WhatsApp</label>
                            <input type="text" name="contact" class="form-control rounded-3" value="{{ old('contact', $merchant->contact) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Alamat Lengkap (Lokasi)</label>
                            <textarea name="address" class="form-control rounded-3" rows="3" required>{{ old('address', $merchant->address) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Deskripsi Katering</label>
                            <textarea name="description" class="form-control rounded-3" rows="4" placeholder="Ceritakan tentang katering Anda..." required>{{ old('description', $merchant->description) }}</textarea>
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
@endsection
