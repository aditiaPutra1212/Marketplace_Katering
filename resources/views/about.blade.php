@extends('layout.app')

@section('content')
<div class="container py-5 mt-4">
    <div class="row align-items-center g-5">
        <div class="col-lg-6 animate-fade-up">
            <span class="badge bg-danger rounded-pill px-3 py-2 mb-3">TENTANG KAMI</span>
            <h1 class="display-4 fw-bold mb-4">Solusi Katering <span class="text-danger">Karyawan</span> Nomor 1 di Lampung</h1>
            <p class="lead text-muted mb-4 lh-lg">
                Marketplace Katering hadir untuk menghubungkan kantoran dan instansi dengan penyedia jasa boga terbaik. Kami percaya bahwa produktivitas dimulai dari asupan gizi yang berkualitas.
            </p>
            
            <div class="row g-4 mb-5">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <div class="bg-light p-3 rounded-circle me-3">
                            <i class="bi bi-shield-check text-danger h4 mb-0"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Higienis & Sehat</h6>
                            <small class="text-muted">Standar dapur terbaik</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <div class="bg-light p-3 rounded-circle me-3">
                            <i class="bi bi-clock text-danger h4 mb-0"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Tepat Waktu</h6>
                            <small class="text-muted">Pengiriman terjadwal</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-light border-0 shadow-sm rounded-4 p-4 mb-0">
                <p class="text-muted fst-italic mb-0">
                    "Kami sudah melayani lebih dari 100+ perusahaan di Lampung dengan ribuan porsi setiap bulannya. Kepercayaan pelanggan adalah prioritas utama kami."
                </p>
            </div>
        </div>
        <div class="col-lg-6 animate-fade-up" style="animation-delay: 0.2s;">
            <div class="position-relative">
                <img src="https://images.unsplash.com/photo-1555244162-803834f70033?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-5 shadow-lg" alt="About Image">
                <div class="position-absolute bottom-0 end-0 bg-danger text-white p-4 rounded-4 shadow m-4 animate-fade-up" style="animation-delay: 0.4s;">
                    <h2 class="fw-bold mb-0">5+ Th</h2>
                    <p class="small mb-0">Pengalaman Kuliner</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="bg-dark py-5 mt-5">
    <div class="container text-center py-4">
        <div class="row g-4">
            <div class="col-md-3">
                <h2 class="text-white fw-bold mb-1">50+</h2>
                <p class="text-white-50 small mb-0">Merchant Terpercaya</p>
            </div>
            <div class="col-md-3">
                <h2 class="text-white fw-bold mb-1">10k+</h2>
                <p class="text-white-50 small mb-0">Porsi Terkirim</p>
            </div>
            <div class="col-md-3">
                <h2 class="text-white fw-bold mb-1">98%</h2>
                <p class="text-white-50 small mb-0">Kepuasan Pelanggan</p>
            </div>
            <div class="col-md-3">
                <h2 class="text-white fw-bold mb-1">24/7</h2>
                <p class="text-white-50 small mb-0">Layanan Bantuan</p>
            </div>
        </div>
    </div>
</section>
@endsection
