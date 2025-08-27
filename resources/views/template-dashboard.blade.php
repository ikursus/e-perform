@extends('template-induk')

@section('title', 'Dashboard')
@section('subtitle', 'Selamat datang di sistem E-Perform')

@section('page-header')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('page-actions')
    <button type="button" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>
        Tambah Data
    </button>
@endsection

@section('content')

<!-- Sample Chart Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="card-title mb-0">Performance Overview</h5>
            </div>
            <div class="card-body">
                <canvas id="performanceChart" width="400" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-primary bg-gradient rounded-3 p-3">
                            <i class="bi bi-people text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Total Karyawan</h6>
                        <h3 class="mb-0">245</h3>
                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i> 12% dari bulan lalu
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
                            <i class="bi bi-clipboard-check text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Evaluasi Selesai</h6>
                        <h3 class="mb-0">189</h3>
                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i> 8% dari bulan lalu
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
                            <i class="bi bi-clock text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Pending Review</h6>
                        <h3 class="mb-0">56</h3>
                        <small class="text-warning">
                            <i class="bi bi-dash"></i> Tidak ada perubahan
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
                            <i class="bi bi-graph-up text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Rata-rata Skor</h6>
                        <h3 class="mb-0">8.7</h3>
                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i> 0.3 dari bulan lalu
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Activities -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pb-0">
                <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Evaluasi Kinerja Q4 2024</h6>
                            <p class="text-muted mb-1">John Doe telah menyelesaikan evaluasi kinerja untuk periode Q4 2024</p>
                            <small class="text-muted">2 jam yang lalu</small>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-success"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Laporan Bulanan</h6>
                            <p class="text-muted mb-1">Laporan kinerja bulan Desember telah dibuat dan dikirim</p>
                            <small class="text-muted">5 jam yang lalu</small>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker bg-warning"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">Review Pending</h6>
                            <p class="text-muted mb-1">15 evaluasi menunggu review dari supervisor</p>
                            <small class="text-muted">1 hari yang lalu</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pb-0">
                <h5 class="card-title mb-0">Aksi Cepat</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <button class="btn btn-outline-primary text-start">
                        <i class="bi bi-person-plus me-2"></i>
                        Tambah Karyawan Baru
                    </button>
                    <button class="btn btn-outline-success text-start">
                        <i class="bi bi-clipboard-plus me-2"></i>
                        Buat Evaluasi Baru
                    </button>
                    <button class="btn btn-outline-info text-start">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        Generate Laporan
                    </button>
                    <button class="btn btn-outline-warning text-start">
                        <i class="bi bi-calendar-event me-2"></i>
                        Jadwalkan Review
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Performance Chart -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pb-0">
                <h5 class="card-title mb-0">Tren Kinerja 6 Bulan Terakhir</h5>
            </div>
            <div class="card-body">
                <div class="chart-placeholder bg-light rounded p-5 text-center">
                    <i class="bi bi-bar-chart fs-1 text-muted mb-3 d-block"></i>
                    <p class="text-muted mb-0">Grafik kinerja akan ditampilkan di sini</p>
                    <small class="text-muted">Integrasi dengan Chart.js atau library grafik lainnya</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 2rem;
}

.timeline-item {
    position: relative;
    padding-bottom: 1.5rem;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -1.5rem;
    top: 1.5rem;
    width: 2px;
    height: calc(100% - 0.5rem);
    background-color: #e2e8f0;
}

.timeline-marker {
    position: absolute;
    left: -1.75rem;
    top: 0.25rem;
    width: 0.75rem;
    height: 0.75rem;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.chart-placeholder {
    min-height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('performanceChart').getContext('2d');
    const performanceChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Performance Score',
                data: [65, 78, 82, 75, 88, 92],
                borderColor: 'rgb(37, 99, 235)',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }, {
                label: 'Target',
                data: [70, 75, 80, 80, 85, 90],
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                borderWidth: 2,
                borderDash: [5, 5],
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Monthly Performance Trends'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100
                }
            }
        }
    });
});
</script>
@endpush