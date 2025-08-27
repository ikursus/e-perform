@extends('template-induk')

@section('title', 'Import Data Investor')
@section('subtitle', 'Upload dan kelola data investor dari file eksternal')

@section('page-header')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Import Data Investor</li>
@endsection

@section('page-actions')
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#templateModal">
            <i class="bi bi-download me-2"></i>
            Download Template
        </button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="bi bi-upload me-2"></i>
            Import Data
        </button>
    </div>
@endsection

@section('content')
<!-- Import Statistics -->
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-file-earmark-arrow-up text-white fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="card-title mb-1">Total Import</h6>
                        <h4 class="mb-0 text-primary">24</h4>
                        <small class="text-muted">File berhasil diimport</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-people text-white fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="card-title mb-1">Data Investor</h6>
                        <h4 class="mb-0 text-success">1,247</h4>
                        <small class="text-muted">Total record tersimpan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-exclamation-triangle text-white fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="card-title mb-1">Data Error</h6>
                        <h4 class="mb-0 text-warning">12</h4>
                        <small class="text-muted">Record dengan error</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-clock-history text-white fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="card-title mb-1">Import Terakhir</h6>
                        <h6 class="mb-0 text-info">2 jam lalu</h6>
                        <small class="text-muted">investor_data_2024.xlsx</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import History -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pb-0">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history me-2"></i>Riwayat Import Data
                </h5>
                <p class="text-muted mb-0">Daftar file yang telah diimport ke sistem</p>
            </div>
            <div class="d-flex gap-2">
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Cari berdasarkan nama file...">
                </div>
                <select class="form-select" style="width: auto;">
                    <option value="">Semua Status</option>
                    <option value="success">Berhasil</option>
                    <option value="error">Error</option>
                    <option value="processing">Processing</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="border-0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                            </div>
                        </th>
                        <th class="border-0">Nama File</th>
                        <th class="border-0">Tanggal Import</th>
                        <th class="border-0">Total Record</th>
                        <th class="border-0">Berhasil</th>
                        <th class="border-0">Error</th>
                        <th class="border-0">Status</th>
                        <th class="border-0">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                    <i class="bi bi-file-earmark-excel text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">investor_data_2024.xlsx</h6>
                                    <small class="text-muted">2.4 MB</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span>15 Jan 2024</span><br>
                            <small class="text-muted">14:30 WIB</small>
                        </td>
                        <td><span class="fw-semibold">150</span></td>
                        <td><span class="text-success fw-semibold">148</span></td>
                        <td><span class="text-danger fw-semibold">2</span></td>
                        <td>
                            <span class="badge bg-success-subtle text-success">
                                <i class="bi bi-check-circle me-1"></i>Berhasil
                            </span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Lihat Detail</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Download Log</a></li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Hapus</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                    <i class="bi bi-file-earmark-excel text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">investor_update_jan.xlsx</h6>
                                    <small class="text-muted">1.8 MB</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span>14 Jan 2024</span><br>
                            <small class="text-muted">09:15 WIB</small>
                        </td>
                        <td><span class="fw-semibold">89</span></td>
                        <td><span class="text-success fw-semibold">79</span></td>
                        <td><span class="text-danger fw-semibold">10</span></td>
                        <td>
                            <span class="badge bg-warning-subtle text-warning">
                                <i class="bi bi-exclamation-triangle me-1"></i>Dengan Error
                            </span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Lihat Detail</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Download Log</a></li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Hapus</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                    <i class="bi bi-file-earmark-text text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">investor_data.csv</h6>
                                    <small class="text-muted">956 KB</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span>13 Jan 2024</span><br>
                            <small class="text-muted">16:45 WIB</small>
                        </td>
                        <td><span class="fw-semibold">67</span></td>
                        <td><span class="text-success fw-semibold">67</span></td>
                        <td><span class="text-success fw-semibold">0</span></td>
                        <td>
                            <span class="badge bg-success-subtle text-success">
                                <i class="bi bi-check-circle me-1"></i>Berhasil
                            </span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>Lihat Detail</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Download Log</a></li>
                                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Hapus</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan 1-3 dari 24 data
            </div>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                    <li class="page-item active">
                        <span class="page-link">1</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-upload me-2"></i>
                    Import Data Investor
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="importForm" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- File Upload Area -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Upload File</label>
                        <div class="border border-2 border-dashed rounded-3 p-4 text-center" id="dropZone">
                            <div class="mb-3">
                                <i class="bi bi-cloud-upload fs-1 text-muted"></i>
                            </div>
                            <h6 class="mb-2">Drag & drop file di sini atau klik untuk browse</h6>
                            <p class="text-muted mb-3">Mendukung format: .xlsx, .xls, .csv (Maksimal 10MB)</p>
                            <input type="file" class="form-control d-none" id="fileInput" name="file" accept=".xlsx,.xls,.csv">
                            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('fileInput').click()">
                                <i class="bi bi-folder2-open me-2"></i>
                                Pilih File
                            </button>
                        </div>
                        <div id="fileInfo" class="mt-3 d-none">
                            <div class="alert alert-info">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-file-earmark-excel me-3 fs-4"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1" id="fileName"></h6>
                                        <small class="text-muted" id="fileSize"></small>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile()">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Import Options -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Opsi Import</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="skipHeader" name="skip_header" checked>
                                    <label class="form-check-label" for="skipHeader">
                                        Skip baris pertama (header)
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="updateExisting" name="update_existing">
                                    <label class="form-check-label" for="updateExisting">
                                        Update data yang sudah ada
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="validateData" name="validate_data" checked>
                                    <label class="form-check-label" for="validateData">
                                        Validasi data sebelum import
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="sendNotification" name="send_notification" checked>
                                    <label class="form-check-label" for="sendNotification">
                                        Kirim notifikasi setelah selesai
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Column Mapping -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Mapping Kolom</label>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            Pastikan kolom pada file sesuai dengan format yang diharapkan. Download template untuk referensi.
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Kolom Database</th>
                                        <th>Kolom File</th>
                                        <th>Wajib</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nama Investor</td>
                                        <td>A (Nama)</td>
                                        <td><i class="bi bi-check-circle text-success"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>B (Email)</td>
                                        <td><i class="bi bi-check-circle text-success"></i></td>
                                    </tr>
                                    <tr>
                                        <td>No. Telepon</td>
                                        <td>C (Telepon)</td>
                                        <td><i class="bi bi-dash-circle text-muted"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Investor</td>
                                        <td>D (Jenis)</td>
                                        <td><i class="bi bi-check-circle text-success"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Nilai Investasi</td>
                                        <td>E (Nilai)</td>
                                        <td><i class="bi bi-dash-circle text-muted"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>
                    Batal
                </button>
                <button type="button" class="btn btn-primary" onclick="startImport()">
                    <i class="bi bi-upload me-2"></i>
                    Mulai Import
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Template Download Modal -->
<div class="modal fade" id="templateModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-download me-2"></i>
                    Download Template
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Pilih format template yang ingin didownload:</p>
                <div class="d-grid gap-2">
                    <a href="#" class="btn btn-outline-success">
                        <i class="bi bi-file-earmark-excel me-2"></i>
                        Template Excel (.xlsx)
                    </a>
                    <a href="#" class="btn btn-outline-info">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        Template CSV (.csv)
                    </a>
                </div>
                <div class="alert alert-info mt-3">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Catatan:</strong> Template berisi format kolom yang sesuai dengan sistem. Pastikan data Anda mengikuti format yang sama.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
#dropZone {
    transition: all 0.3s ease;
    cursor: pointer;
}

#dropZone:hover {
    border-color: var(--primary-color) !important;
    background-color: rgba(37, 99, 235, 0.05);
}

#dropZone.dragover {
    border-color: var(--primary-color) !important;
    background-color: rgba(37, 99, 235, 0.1);
}

.table th {
    font-weight: 600;
    color: #495057;
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.dropdown-menu {
    border: 0;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
</style>
@endpush

@push('scripts')
<script>
// File upload handling
const dropZone = document.getElementById('dropZone');
const fileInput = document.getElementById('fileInput');
const fileInfo = document.getElementById('fileInfo');
const fileName = document.getElementById('fileName');
const fileSize = document.getElementById('fileSize');

// Drag and drop events
dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('dragover');
});

dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('dragover');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('dragover');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        handleFile(files[0]);
    }
});

// File input change
fileInput.addEventListener('change', (e) => {
    if (e.target.files.length > 0) {
        handleFile(e.target.files[0]);
    }
});

// Handle file selection
function handleFile(file) {
    const allowedTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 
                         'application/vnd.ms-excel', 
                         'text/csv'];
    
    if (!allowedTypes.includes(file.type)) {
        alert('Format file tidak didukung. Gunakan .xlsx, .xls, atau .csv');
        return;
    }
    
    if (file.size > 10 * 1024 * 1024) { // 10MB
        alert('Ukuran file terlalu besar. Maksimal 10MB');
        return;
    }
    
    fileName.textContent = file.name;
    fileSize.textContent = formatFileSize(file.size);
    fileInfo.classList.remove('d-none');
    
    // Set file to input
    const dt = new DataTransfer();
    dt.items.add(file);
    fileInput.files = dt.files;
}

// Remove file
function removeFile() {
    fileInput.value = '';
    fileInfo.classList.add('d-none');
}

// Format file size
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Start import
function startImport() {
    const form = document.getElementById('importForm');
    const formData = new FormData(form);
    
    if (!fileInput.files.length) {
        alert('Pilih file terlebih dahulu');
        return;
    }
    
    // Show loading state
    const modal = bootstrap.Modal.getInstance(document.getElementById('importModal'));
    modal.hide();
    
    // Here you would typically send the form data to the server
    // For demo purposes, we'll just show a success message
    setTimeout(() => {
        alert('Import berhasil dimulai! Anda akan menerima notifikasi setelah proses selesai.');
        location.reload();
    }, 1000);
}

// Select all checkbox
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});
</script>
@endpush