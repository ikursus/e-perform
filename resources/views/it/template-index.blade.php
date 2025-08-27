@extends('template-induk')

@section('title', 'IT Performance')
@section('subtitle', 'Kelola dan pantau kinerja sistem IT')

@section('page-header')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">IT Performance</li>
@endsection

@section('page-actions')
    <a href="{{ url('/it/create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>
        Tambah Data IT
    </a>
@endsection

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary bg-gradient rounded-3 p-3">
                            <i class="bi bi-cpu text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Total Server</h6>
                        <h3 class="mb-0">24</h3>
                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i> 2 server baru
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-gradient rounded-3 p-3">
                            <i class="bi bi-check-circle text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Server Online</h6>
                        <h3 class="mb-0">22</h3>
                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i> 91.7% uptime
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-warning bg-gradient rounded-3 p-3">
                            <i class="bi bi-exclamation-triangle text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Alert Aktif</h6>
                        <h3 class="mb-0">3</h3>
                        <small class="text-warning">
                            <i class="bi bi-clock"></i> Perlu perhatian
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-info bg-gradient rounded-3 p-3">
                            <i class="bi bi-speedometer2 text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Avg Response Time</h6>
                        <h3 class="mb-0">245ms</h3>
                        <small class="text-success">
                            <i class="bi bi-arrow-down"></i> 15ms lebih cepat
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- IT Performance Table -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Server IT</h5>
                    <div class="d-flex gap-2">
                        <div class="input-group" style="width: 250px;">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Cari server...">
                        </div>
                        <select class="form-select" style="width: 150px;">
                            <option value="">Semua Status</option>
                            <option value="online">Online</option>
                            <option value="offline">Offline</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Server Name</th>
                                <th>IP Address</th>
                                <th>Status</th>
                                <th>CPU Usage</th>
                                <th>Memory Usage</th>
                                <th>Disk Usage</th>
                                <th>Last Check</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-server me-2 text-primary"></i>
                                        <strong>Web Server 01</strong>
                                    </div>
                                </td>
                                <td>192.168.1.10</td>
                                <td><span class="badge bg-success">Online</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress me-2" style="width: 60px; height: 8px;">
                                            <div class="progress-bar bg-success" style="width: 45%"></div>
                                        </div>
                                        <small>45%</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress me-2" style="width: 60px; height: 8px;">
                                            <div class="progress-bar bg-warning" style="width: 72%"></div>
                                        </div>
                                        <small>72%</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress me-2" style="width: 60px; height: 8px;">
                                            <div class="progress-bar bg-info" style="width: 35%"></div>
                                        </div>
                                        <small>35%</small>
                                    </div>
                                </td>
                                <td><small class="text-muted">2 menit lalu</small></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ url('/it/1/edit') }}" class="btn btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn btn-outline-info" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-server me-2 text-primary"></i>
                                        <strong>Database Server</strong>
                                    </div>
                                </td>
                                <td>192.168.1.20</td>
                                <td><span class="badge bg-success">Online</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress me-2" style="width: 60px; height: 8px;">
                                            <div class="progress-bar bg-success" style="width: 28%"></div>
                                        </div>
                                        <small>28%</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress me-2" style="width: 60px; height: 8px;">
                                            <div class="progress-bar bg-success" style="width: 55%"></div>
                                        </div>
                                        <small>55%</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress me-2" style="width: 60px; height: 8px;">
                                            <div class="progress-bar bg-warning" style="width: 78%"></div>
                                        </div>
                                        <small>78%</small>
                                    </div>
                                </td>
                                <td><small class="text-muted">1 menit lalu</small></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ url('/it/2/edit') }}" class="btn btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn btn-outline-info" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-server me-2 text-danger"></i>
                                        <strong>Backup Server</strong>
                                    </div>
                                </td>
                                <td>192.168.1.30</td>
                                <td><span class="badge bg-danger">Offline</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress me-2" style="width: 60px; height: 8px;">
                                            <div class="progress-bar bg-secondary" style="width: 0%"></div>
                                        </div>
                                        <small>N/A</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress me-2" style="width: 60px; height: 8px;">
                                            <div class="progress-bar bg-secondary" style="width: 0%"></div>
                                        </div>
                                        <small>N/A</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress me-2" style="width: 60px; height: 8px;">
                                            <div class="progress-bar bg-secondary" style="width: 0%"></div>
                                        </div>
                                        <small>N/A</small>
                                    </div>
                                </td>
                                <td><small class="text-muted">15 menit lalu</small></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ url('/it/3/edit') }}" class="btn btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn btn-outline-info" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <small class="text-muted">Menampilkan 1-3 dari 24 server</small>
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
    </div>
</div>
@endsection

@push('styles')
<style>
.progress {
    background-color: #e9ecef;
}

.table th {
    font-weight: 600;
    color: #495057;
    border-bottom: 2px solid #dee2e6;
}

.btn-group-sm .btn {
    padding: 0.25rem 0.5rem;
}

.badge {
    font-size: 0.75rem;
}
</style>
@endpush