@extends('template-induk')

@section('title', 'Tambah Server IT')
@section('subtitle', 'Tambahkan server baru ke dalam sistem monitoring')

@section('page-header')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/it') }}">IT Performance</a></li>
    <li class="breadcrumb-item active">Tambah Server</li>
@endsection

@section('page-actions')
    <a href="{{ url('/it') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Kembali
    </a>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pb-0">
                <div class="d-flex align-items-center">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-server text-white fs-4"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">Informasi Server Baru</h5>
                        <p class="text-muted mb-0">Lengkapi form berikut untuk menambahkan server</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <form method="POST" action="{{ url('/it') }}" class="needs-validation" novalidate>
                    @csrf
                    
                    <!-- Server Information Section -->
                    <div class="mb-4">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="bi bi-info-circle me-2"></i>Informasi Dasar Server
                        </h6>
                        
                        <div class="row g-3">
                            <!-- Server Name -->
                            <div class="col-md-6">
                                <label for="server_name" class="form-label fw-semibold">
                                    <i class="bi bi-server me-1"></i>Nama Server
                                </label>
                                <input type="text" class="form-control" id="server_name" name="server_name" 
                                       placeholder="e.g. Web Server 01" required>
                                <div class="invalid-feedback">
                                    Nama server wajib diisi.
                                </div>
                            </div>
                            
                            <!-- Server Type -->
                            <div class="col-md-6">
                                <label for="server_type" class="form-label fw-semibold">
                                    <i class="bi bi-tag me-1"></i>Tipe Server
                                </label>
                                <select class="form-select" id="server_type" name="server_type" required>
                                    <option value="">Pilih Tipe Server</option>
                                    <option value="web">Web Server</option>
                                    <option value="database">Database Server</option>
                                    <option value="application">Application Server</option>
                                    <option value="backup">Backup Server</option>
                                    <option value="mail">Mail Server</option>
                                    <option value="file">File Server</option>
                                </select>
                                <div class="invalid-feedback">
                                    Tipe server wajib dipilih.
                                </div>
                            </div>
                            
                            <!-- IP Address -->
                            <div class="col-md-6">
                                <label for="ip_address" class="form-label fw-semibold">
                                    <i class="bi bi-globe me-1"></i>IP Address
                                </label>
                                <input type="text" class="form-control" id="ip_address" name="ip_address" 
                                       placeholder="192.168.1.10" pattern="^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$" required>
                                <div class="invalid-feedback">
                                    IP Address tidak valid.
                                </div>
                            </div>
                            
                            <!-- Port -->
                            <div class="col-md-6">
                                <label for="port" class="form-label fw-semibold">
                                    <i class="bi bi-door-open me-1"></i>Port
                                </label>
                                <input type="number" class="form-control" id="port" name="port" 
                                       placeholder="80" min="1" max="65535">
                                <div class="form-text">Port untuk monitoring (opsional)</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Server Specifications Section -->
                    <div class="mb-4">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="bi bi-cpu me-2"></i>Spesifikasi Server
                        </h6>
                        
                        <div class="row g-3">
                            <!-- CPU Cores -->
                            <div class="col-md-4">
                                <label for="cpu_cores" class="form-label fw-semibold">
                                    <i class="bi bi-cpu me-1"></i>CPU Cores
                                </label>
                                <input type="number" class="form-control" id="cpu_cores" name="cpu_cores" 
                                       placeholder="4" min="1">
                            </div>
                            
                            <!-- RAM -->
                            <div class="col-md-4">
                                <label for="ram_gb" class="form-label fw-semibold">
                                    <i class="bi bi-memory me-1"></i>RAM (GB)
                                </label>
                                <input type="number" class="form-control" id="ram_gb" name="ram_gb" 
                                       placeholder="8" min="1">
                            </div>
                            
                            <!-- Storage -->
                            <div class="col-md-4">
                                <label for="storage_gb" class="form-label fw-semibold">
                                    <i class="bi bi-hdd me-1"></i>Storage (GB)
                                </label>
                                <input type="number" class="form-control" id="storage_gb" name="storage_gb" 
                                       placeholder="500" min="1">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Monitoring Configuration Section -->
                    <div class="mb-4">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="bi bi-gear me-2"></i>Konfigurasi Monitoring
                        </h6>
                        
                        <div class="row g-3">
                            <!-- Monitoring Interval -->
                            <div class="col-md-6">
                                <label for="monitoring_interval" class="form-label fw-semibold">
                                    <i class="bi bi-clock me-1"></i>Interval Monitoring
                                </label>
                                <select class="form-select" id="monitoring_interval" name="monitoring_interval">
                                    <option value="60">1 Menit</option>
                                    <option value="300" selected>5 Menit</option>
                                    <option value="600">10 Menit</option>
                                    <option value="1800">30 Menit</option>
                                    <option value="3600">1 Jam</option>
                                </select>
                            </div>
                            
                            <!-- Alert Threshold -->
                            <div class="col-md-6">
                                <label for="alert_threshold" class="form-label fw-semibold">
                                    <i class="bi bi-exclamation-triangle me-1"></i>Alert Threshold (%)
                                </label>
                                <input type="number" class="form-control" id="alert_threshold" name="alert_threshold" 
                                       placeholder="80" min="1" max="100" value="80">
                                <div class="form-text">Alert akan dikirim jika usage melebihi threshold</div>
                            </div>
                            
                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-semibold">
                                    <i class="bi bi-toggle-on me-1"></i>Status
                                </label>
                                <select class="form-select" id="status" name="status">
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="maintenance">Maintenance</option>
                                </select>
                            </div>
                            
                            <!-- Enable Alerts -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold d-block">
                                    <i class="bi bi-bell me-1"></i>Pengaturan Alert
                                </label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="enable_alerts" name="enable_alerts" checked>
                                    <label class="form-check-label" for="enable_alerts">
                                        Aktifkan notifikasi alert
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description Section -->
                    <div class="mb-4">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="bi bi-file-text me-2"></i>Deskripsi
                        </h6>
                        
                        <div class="row">
                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">
                                    <i class="bi bi-card-text me-1"></i>Deskripsi Server
                                </label>
                                <textarea class="form-control" id="description" name="description" rows="4" 
                                          placeholder="Deskripsi fungsi dan peran server dalam infrastruktur IT..."></textarea>
                                <div class="form-text">Jelaskan fungsi dan peran server ini dalam infrastruktur IT</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ url('/it') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-2"></i>
                            Simpan Server
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.form-label {
    color: #495057;
    margin-bottom: 0.5rem;
}

.form-control:focus,
.form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
}

.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.invalid-feedback {
    display: block;
}

.was-validated .form-control:invalid,
.was-validated .form-select:invalid {
    border-color: #dc3545;
}

.was-validated .form-control:valid,
.was-validated .form-select:valid {
    border-color: #198754;
}
</style>
@endpush

@push('scripts')
<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// IP Address validation
document.getElementById('ip_address').addEventListener('input', function(e) {
    const value = e.target.value;
    const ipPattern = /^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/;
    
    if (value && !ipPattern.test(value)) {
        e.target.setCustomValidity('Format IP Address tidak valid');
    } else {
        e.target.setCustomValidity('');
    }
});
</script>
@endpush