@extends('template-induk2')

@section('title', 'Import Investor Holdings')
@section('subtitle', 'Import data investor holdings dari file Excel/CSV')

@section('page-header')
@endsection

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row mb-3">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('investor-holdings.index') }}">Investor Holdings</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Import Data</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Import Data Investor Holdings</h3>
                    <div class="card-tools">
                        <a href="{{ route('investor-holdings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            <div class="card-body">
                <form action="{{ route('investor-holdings.import.process') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label for="file" class="form-label">Pilih File Excel/CSV</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.xls,.csv" required>
                        <small class="form-text text-muted">
                            Format yang diterima: .xlsx, .xls, .csv (Maksimum 10MB)
                        </small>
                    </div>
                    
                    <div class="form-group mb-3">
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> Panduan Import:</h6>
                            <ul class="mb-0">
                                <li>Pastikan file mengikut format template yang disediakan</li>
                                <li>Kolum yang diperlukan: fund_name, fund_code, date, trans_type, tot_inv, nav, cur_val</li>
                                <li>Format tarikh: DD/MM/YYYY</li>
                                <li>Jenis transaksi: SA (Subscribe), RE (Redeem)</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Import Data
                            </button>
                            <a href="{{ route('investor-holdings.download-template') }}" class="btn btn-success">
                                <i class="fas fa-download"></i> Download Template
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Contoh Format Data</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>fund_name</th>
                                <th>fund_code</th>
                                <th>date</th>
                                <th>trans_type</th>
                                <th>tot_inv</th>
                                <th>nav</th>
                                <th>cur_val</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PBSN All - Weather...</td>
                                <td>PM1</td>
                                <td>31/1/2025</td>
                                <td>SA</td>
                                <td>500000</td>
                                <td>1.1</td>
                                <td>550000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('styles')
<style>
.card {
    border: 1px solid #e3e6f0;
    border-radius: 0.35rem;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
    padding: 0.75rem 1.25rem;
}

.card-title {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
    color: #5a5c69;
}

.form-label {
    font-weight: 600;
    color: #5a5c69;
    margin-bottom: 0.5rem;
}

.btn {
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
}

.alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
}

.table-sm th,
.table-sm td {
    padding: 0.3rem;
    font-size: 0.8rem;
}
</style>
@endpush