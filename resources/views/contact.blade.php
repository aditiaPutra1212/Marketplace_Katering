@extends('layout.app')

@section('content')
<div class="container py-5 mt-4">
    <div class="text-center mb-5 animate-fade-up">
        <span class="badge bg-danger rounded-pill px-3 py-2 mb-3">HUBUNGI KAMI</span>
        <h1 class="display-4 fw-bold">Siap Membantu <span class="text-danger">Kebutuhan</span> Anda</h1>
        <p class="text-muted lead mx-auto" style="max-width: 600px;">Punya pertanyaan atau ingin bekerja sama? Jangan ragu untuk menghubungi tim kami.</p>
    </div>

    <div class="row g-5 animate-fade-up" style="animation-delay: 0.2s;">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-light p-3 rounded-circle me-3">
                            <i class="bi bi-geo-alt text-danger h4 mb-0"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Alamat Kantor</h5>
                            <p class="text-muted small mb-0">Jl. Pagar Alam No.3, Lampung (Samping Indomaret)</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-light p-3 rounded-circle me-3">
                            <i class="bi bi-envelope text-danger h4 mb-0"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Email Support</h5>
                            <p class="text-muted small mb-0">halo@marketplacekatering.co.id</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-light p-3 rounded-circle me-3">
                            <i class="bi bi-telephone text-danger h4 mb-0"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Layanan WhatsApp</h5>
                            <p class="text-muted small mb-0">+62 811 2556 0890</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="fw-bold mb-3">Ikuti Kami:</h6>
                    <div class="d-flex g-3">
                        <a href="#" class="btn btn-outline-danger rounded-circle p-2 me-2"><i class="bi bi-instagram m-1"></i></a>
                        <a href="#" class="btn btn-outline-danger rounded-circle p-2 me-2"><i class="bi bi-facebook m-1"></i></a>
                        <a href="#" class="btn btn-outline-danger rounded-circle p-2"><i class="bi bi-linkedin m-1"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 text-center py-5">
            <div class="bg-white p-5 rounded-5 border-0 shadow-sm">
                 <div class="mb-4">
                    <i class="bi bi-whatsapp display-1 text-success"></i>
                 </div>
                 <h2 class="fw-bold mb-3">Hubungi Customer Service</h2>
                 <p class="text-muted mb-4">Response cepat via WhatsApp selama jam kerja (08:00 - 17:00 WIB)</p>
                 <a href="https://wa.me/6281125560890" target="_blank" class="btn btn-success btn-lg rounded-pill px-5 py-3 fw-bold shadow">
                    MULAI CHAT WHATSAPP <i class="bi bi-arrow-right ms-2"></i>
                 </a>
            </div>
        </div>
    </div>
</div>
@endsection
