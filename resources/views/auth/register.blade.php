@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-white text-center"><h4>Daftar Akun Baru</h4></div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Daftar Sebagai:</label>
                        <select name="role" id="roleSelect" class="form-select" onchange="toggleMerchantFields()">
                            <option value="customer">Kantor (Customer)</option>
                            <option value="merchant">Katering (Merchant)</option>
                        </select>
                    </div>

                    <div id="merchantFields" style="display: none;" class="p-3 bg-light border rounded mb-3">
                        <h6>Data Katering</h6>
                        <div class="mb-2">
                            <label>Nama Perusahaan Katering</label>
                            <input type="text" name="company_name" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>No Kontak</label>
                            <input type="text" name="contact" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Alamat Lengkap (Lokasi)</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Daftar Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleMerchantFields() {
        var role = document.getElementById('roleSelect').value;
        var fields = document.getElementById('merchantFields');
        if(role === 'merchant') {
            fields.style.display = 'block';
        } else {
            fields.style.display = 'none';
        }
    }
</script>
@endsection