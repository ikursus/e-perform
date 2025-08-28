@extends('template-induk2')

@section('title', 'Digitalization')
@section('subtitle', 'Senarai data digitalisasi')

@section('page-header')
    <!-- Header content to ensure page-actions is displayed -->
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('digitalizations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Data Digitalisasi
        </a>
    </div>
@endsection

@section('content')
<style>
    .table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-top: 20px;
    }
    
    .table-header {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        padding: 25px 30px;
        border-bottom: none;
    }
    
    .table-header h3 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .table-content {
        padding: 0;
    }
    
    .table {
        margin: 0;
        border: none;
    }
    
    .table thead th {
        background: #f8fafc;
        border: none;
        border-bottom: 2px solid #e2e8f0;
        color: #475569;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 20px 25px;
    }
    
    .table tbody td {
        border: none;
        border-bottom: 1px solid #f1f5f9;
        padding: 20px 25px;
        vertical-align: middle;
        color: #334155;
        font-size: 14px;
    }
    
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
        background: #f8fafc;
        transform: translateX(5px);
    }
    
    .table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        margin-right: 5px;
    }
    
    .btn-primary {
        background: #8b5cf6;
        color: white;
    }
    
    .btn-primary:hover {
        background: #7c3aed;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
    }
    
    .btn-info {
        background: #06b6d4;
        color: white;
    }
    
    .btn-info:hover {
        background: #0891b2;
        color: white;
        text-decoration: none;
    }
    
    .btn-warning {
        background: #f59e0b;
        color: white;
    }
    
    .btn-warning:hover {
        background: #d97706;
        color: white;
        text-decoration: none;
    }
    
    .btn-danger {
        background: #ef4444;
        color: white;
    }
    
    .btn-danger:hover {
        background: #dc2626;
    }
    
    .empty-state {
        text-align: center;
        padding: 80px 40px;
        color: #64748b;
    }
    
    .empty-state i {
        font-size: 64px;
        color: #cbd5e1;
        margin-bottom: 20px;
    }
    
    .empty-state h4 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 12px;
        color: #475569;
    }
    
    .empty-state p {
        font-size: 16px;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-planning {
        background: #dbeafe;
        color: #1e40af;
    }
    
    .status-development {
        background: #fef3c7;
        color: #92400e;
    }
    
    .status-testing {
        background: #fde68a;
        color: #78350f;
    }
    
    .status-deployment {
        background: #d1fae5;
        color: #065f46;
    }
    
    .status-maintenance {
        background: #e0e7ff;
        color: #3730a3;
    }
    
    .status-completed {
        background: #dcfce7;
        color: #166534;
    }
    
    .type-badge {
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    
    .type-web {
        background: #fef2f2;
        color: #991b1b;
    }
    
    .type-mobile {
        background: #f0f9ff;
        color: #1e40af;
    }
    
    .type-desktop {
        background: #f7fee7;
        color: #365314;
    }
    
    .type-system {
        background: #fdf4ff;
        color: #86198f;
    }
    
    .type-api {
        background: #fff7ed;
        color: #9a3412;
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
    }
    
    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #8b5cf6;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 12px;
    }
    
    .year-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 4px 8px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
    }
    
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid;
    }
    
    .alert-success {
        background: #f0fdf4;
        border-color: #bbf7d0;
        color: #166534;
    }
    
    .alert-success i {
        color: #22c55e;
        margin-right: 8px;
    }
</style>

@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="table-container">
    <div class="table-header">
        <h3>
            <i class="fas fa-digital-tachograph"></i>
            Data Digitalisasi
        </h3>
    </div>
    
    <div class="table-content">
        @if($digitalizations->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Tajuk</th>
                        <th>Tahun</th>
                        <th>Jenis Pembangunan</th>
                        <th>Tempoh</th>
                        <th>Status</th>
                        <th>Pengguna</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($digitalizations as $digitalization)
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #1e293b; margin-bottom: 4px;">
                                    {{ $digitalization->title }}
                                </div>
                                <div style="font-size: 12px; color: #64748b;">
                                    ID: #{{ $digitalization->id }}
                                </div>
                            </td>
                            <td>
                                <span class="year-badge">{{ $digitalization->year }}</span>
                            </td>
                            <td>
                                @php
                                    $typeClass = match($digitalization->development_type) {
                                        'web' => 'type-web',
                                        'mobile' => 'type-mobile', 
                                        'desktop' => 'type-desktop',
                                        'system' => 'type-system',
                                        'api' => 'type-api',
                                        default => 'type-web'
                                    };
                                @endphp
                                <span class="type-badge {{ $typeClass }}">
                                    {{ ucfirst($digitalization->development_type) }}
                                </span>
                            </td>
                            <td>
                                {{ $digitalization->development_period ?: '-' }}
                            </td>
                            <td>
                                @php
                                    $statusClass = match($digitalization->development_status) {
                                        'planning' => 'status-planning',
                                        'development' => 'status-development',
                                        'testing' => 'status-testing', 
                                        'deployment' => 'status-deployment',
                                        'maintenance' => 'status-maintenance',
                                        'completed' => 'status-completed',
                                        default => 'status-planning'
                                    };
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    {{ ucfirst($digitalization->development_status) }}
                                </span>
                            </td>
                            <td>
                                @if($digitalization->user_name)
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($digitalization->user_name, 0, 1)) }}
                                        </div>
                                        <span>{{ $digitalization->user_name }}</span>
                                    </div>
                                @else
                                    <span style="color: #9ca3af; font-style: italic;">Tiada pengguna</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('digitalizations.show', $digitalization->id) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('digitalizations.edit', $digitalization->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('digitalizations.destroy', $digitalization->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Adakah anda pasti ingin memadam data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <i class="fas fa-digital-tachograph"></i>
                <h4>Tiada Data Digitalisasi</h4>
                <p>Belum ada data digitalisasi yang dimasukkan.<br>Klik butang "Tambah Data Digitalisasi" untuk memulakan.</p>
                <a href="{{ route('digitalizations.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection