@extends('layout.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center py-lg-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate-fade-up">
                <div class="card-body p-0">
                    <div class="bg-danger text-white text-center py-4 px-3">
                        <div class="bg-white d-inline-block p-3 rounded-circle mb-3">
                            <i class="bi bi-person-plus text-danger h2 mb-0"></i>
                        </div>
                        <h3 class="fw-bold mb-1">Daftar Akun Baru</h3>
                        <p class="mb-0 opacity-75">Mulai pengalaman katering Anda bersama kami</p>
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

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control rounded-3 py-2" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold">Alamat Email</label>
                                    <input type="email" name="email" class="form-control rounded-3 py-2" placeholder="nama@email.com" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Password</label>
                                    <input type="password" name="password" class="form-control rounded-3 py-2" placeholder="••••••••" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control rounded-3 py-2" placeholder="••••••••" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-danger">Mendaftar Sebagai:</label>
                                <select name="role" id="roleSelect" class="form-select rounded-3 py-2 border-danger shadow-sm" style="background-color: #fff5f5;" onchange="toggleMerchantFields()">
                                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Kantor (Customer - Ingin memesan)</option>
                                    <option value="merchant" {{ old('role') == 'merchant' ? 'selected' : '' }}>Katering (Merchant - Ingin berjualan)</option>
                                </select>
                            </div>

                            <div id="additionalFields" style="display: block;" class="p-4 bg-light border-start border-danger border-4 rounded-3 mb-4 animate-fade-up">
                                <h6 id="additionalTitle" class="fw-bold text-danger mb-3"><i class="bi bi-shop me-2"></i> Data Kantor / Bisnis</h6>
                                <div class="mb-3">
                                    <label id="companyLabel" class="form-label small fw-bold">Nama Kantor / Perusahaan</label>
                                    <input type="text" name="company_name" class="form-control rounded-3" placeholder="Contoh: PT. Maju Bersama" value="{{ old('company_name') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">No Kontak (WhatsApp Aktif)</label>
                                    <input type="text" name="contact" class="form-control rounded-3" placeholder="0812xxxxxx" value="{{ old('contact') }}" required>
                                </div>
                                <div class="mb-0">
                                    <label id="addressLabel" class="form-label small fw-bold">Alamat Kantor / Lokasi Pengiriman</label>
                                    <textarea name="address" class="form-control rounded-3" rows="3" placeholder="Alamat lengkap..." required>{{ old('address') }}</textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-danger w-100 rounded-pill py-2 fw-bold shadow-sm mb-4">
                                DAFTAR SEKARANG <i class="bi bi-check-circle ms-2"></i>
                            </button>

                            <div class="text-center">
                                <p class="text-muted small mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-danger fw-bold text-decoration-none">Login ke Akun</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleMerchantFields() {
        var role = document.getElementById('roleSelect').value;
        var title = document.getElementById('additionalTitle');
        var companyLabel = document.getElementById('companyLabel');
        var addressLabel = document.getElementById('addressLabel');
        
        if(role === 'merchant') {
            title.innerHTML = '<i class="bi bi-shop me-2"></i> Data Bisnis Katering';
            companyLabel.innerText = 'Nama Perusahaan / Merk Katering';
            addressLabel.innerText = 'Alamat Produksi / Kantor';
        } else {
            title.innerHTML = '<i class="bi bi-building me-2"></i> Data Kantor / Instansi';
            companyLabel.innerText = 'Nama Kantor / Perusahaan';
            addressLabel.innerText = 'Alamat Kantor / Lokasi Pengiriman';
        }
    }
    
    // Initial call
    document.addEventListener('DOMContentLoaded', function() {
        toggleMerchantFields();
    });
</script>
@endsection