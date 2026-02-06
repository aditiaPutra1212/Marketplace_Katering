@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center py-lg-5">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate-fade-up">
                <div class="card-body p-0">
                    <div class="bg-danger text-white text-center py-4 px-3">
                        <div class="bg-white d-inline-block p-3 rounded-circle mb-3">
                            <i class="bi bi-person-lock text-danger h2 mb-0"></i>
                        </div>
                        <h3 class="fw-bold mb-1">Selamat Datang</h3>
                        <p class="mb-0 opacity-75">Silakan masuk ke akun Anda</p>
                    </div>
                    
                    <div class="p-4 p-lg-5">
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 rounded-3 mb-4">
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Alamat Email</label>
                                <div class="input-group border rounded-3 overflow-hidden">
                                    <span class="input-group-text bg-white border-0"><i class="bi bi-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control border-0 py-2" placeholder="nama@email.com" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label small fw-bold">Password</label>
                                <div class="input-group border rounded-3 overflow-hidden">
                                    <span class="input-group-text bg-white border-0"><i class="bi bi-key text-muted"></i></span>
                                    <input type="password" name="password" class="form-control border-0 py-2" placeholder="••••••••" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-danger w-100 rounded-pill py-2 fw-bold shadow-sm mb-4">
                                MASUK SEKARANG <i class="bi bi-box-arrow-in-right ms-2"></i>
                            </button>

                            <div class="text-center">
                                <p class="text-muted small mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-danger fw-bold text-decoration-none">Daftar Sekarang</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4 animate-fade-up" style="animation-delay: 0.2s;">
                <a href="{{ route('landing') }}" class="text-muted text-decoration-none small"><i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

<style>
    .input-group:focus-within {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.1);
    }
    .form-control:focus {
        box-shadow: none !important;
    }
</style>
@endsection