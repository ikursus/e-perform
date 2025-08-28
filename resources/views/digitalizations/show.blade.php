@extends('template-induk2')

@section('title', 'Detail Digitalisasi')
@section('subtitle', 'Maklumat lengkap projek digitalisasi')

@section('page-header')
    <!-- Header content to ensure page-actions is displayed -->
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('digitalizations.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Senarai
        </a>
        <a href="{{ route('digitalizations.edit', $digitalization->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <form action="{{ route('digitalizations.destroy', $digitalization->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Adakah anda pasti ingin memadam data ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Padam
            </button>
        </form>
    </div>
@endsection

@section('content')
<style>
    .detail-container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .detail-header {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        padding: 40px;
        text-align: center;
    }
    
    .detail-header h2 {
        margin: 0 0 10px 0;
        font-size: 32px;
        font-weight: 700;
    }
    
    .detail-header p {
        margin: 0;
        font-size: 18px;
        opacity: 0.9;
    }
    
    .detail-content {
        padding: 40px;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }
    
    .info-card {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 25px;
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        border-color: #8b5cf6;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.15);
    }
    
    .info-label {
        font-size: 14px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .info-value {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 5px;
    }
    
    .info-description {
        font-size: 14px;
        color: #64748b;
        line-height: 1.5;
    }
    
    .title-display {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        border: none !important;
        grid-column: 1 / -1;
    }
    
    .title-display .info-label {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .title-display .info-value {
        color: white;
        font-size: 28px;
    }
    
    .title-display .info-description {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .year-display {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
        border: none !important;
    }
    
    .year-display .info-label {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .year-display .info-value {
        color: white;
        font-size: 32px;
    }
    
    .year-display .info-description {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .status-display {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none !important;
    }
    
    .status-display .info-label {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .status-display .info-value {
        color: white;
        font-size: 24px;
    }
    
    .status-display .info-description {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .metadata-section {
        background: #f1f5f9;
        border-radius: 12px;
        padding: 25px;
        margin-top: 30px;
    }
    
    .metadata-title {
        font-size: 18px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .metadata-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .metadata-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .metadata-item:last-child {
        border-bottom: none;
    }
    
    .metadata-label {
        font-weight: 600;
        color: #64748b;
        font-size: 14px;
    }
    
    .metadata-value {
        font-weight: 500;
        color: #1e293b;
        font-size: 14px;
    }
    
    .btn {
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        margin-right: 10px;
    }
    
    .btn-secondary {
        background: #6b7280;
        color: white;
    }
    
    .btn-secondary:hover {
        background: #4b5563;
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
    
    .user-badge {
        background: #dbeafe;
        color: #1e40af;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .no-user {
        background: #f3f4f6;
        color: #6b7280;
        font-style: italic;
    }
    
    .type-badge {
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .type-web {
        background: #fef2f2;
        color: #991b1b;
        border: 2px solid #fecaca;
    }
    
    .type-mobile {
        background: #f0f9ff;
        color: #1e40af;
        border: 2px solid #bfdbfe;
    }
    
    .type-desktop {
        background: #f7fee7;
        color: #365314;
        border: 2px solid #d9f99d;
    }
    
    .type-system {
        background: #fdf4ff;
        color: #86198f;
        border: 2px solid #f3e8ff;
    }
    
    .type-api {
        background: #fff7ed;
        color: #9a3412;
        border: 2px solid #fed7aa;
    }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .status-planning {
        background: #dbeafe;
        color: #1e40af;
        border: 2px solid #bfdbfe;
    }
    
    .status-development {
        background: #fef3c7;
        color: #92400e;
        border: 2px solid #fde68a;
    }
    
    .status-testing {
        background: #fde68a;
        color: #78350f;
        border: 2px solid #fcd34d;
    }
    
    .status-deployment {
        background: #d1fae5;
        color: #065f46;
        border: 2px solid #a7f3d0;
    }
    
    .status-maintenance {
        background: #e0e7ff;
        color: #3730a3;
        border: 2px solid #c7d2fe;
    }
    
    .status-completed {
        background: #dcfce7;
        color: #166534;
        border: 2px solid #bbf7d0;
    }
    
    .project-timeline {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
    }
    
    .timeline-title {
        font-size: 18px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .timeline-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
</style>

<div class="detail-container">
    <div class="detail-header">
        <h2><i class="fas fa-digital-tachograph"></i> {{ $digitalization->title }}</h2>
        <p>Detail Projek Digitalisasi</p>
    </div>
    
    <div class="detail-content">
        <div class="info-grid">
            <div class="info-card title-display">
                <div class="info-label">
                    <i class="fas fa-project-diagram"></i> Tajuk Projek
                </div>
                <div class="info-value">{{ $digitalization->title }}</div>
                <div class="info-description">Nama projek digitalisasi</div>
            </div>
            
            <div class="info-card year-display">
                <div class="info-label">
                    <i class="fas fa-calendar-alt"></i> Tahun Pelaksanaan
                </div>
                <div class="info-value">{{ $digitalization->year }}</div>
                <div class="info-description">Tahun projek dijalankan</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">
                    <i class="fas fa-code"></i> Jenis Pembangunan
                </div>
                <div class="info-value">
                    @php
                        $typeClass = match($digitalization->development_type) {
                            'web' => 'type-web',
                            'mobile' => 'type-mobile', 
                            'desktop' => 'type-desktop',
                            'system' => 'type-system',
                            'api' => 'type-api',
                            default => 'type-web'
                        };
                        $typeIcon = match($digitalization->development_type) {
                            'web' => 'fas fa-globe',
                            'mobile' => 'fas fa-mobile-alt',
                            'desktop' => 'fas fa-desktop',
                            'system' => 'fas fa-server',
                            'api' => 'fas fa-code',
                            default => 'fas fa-code'
                        };
                    @endphp
                    <span class="type-badge {{ $typeClass }}">
                        <i class="{{ $typeIcon }}"></i>
                        {{ ucfirst($digitalization->development_type) }}
                    </span>
                </div>
                <div class="info-description">Platform teknologi yang digunakan</div>
            </div>
            
            <div class="info-card status-display">
                <div class="info-label">
                    <i class="fas fa-tasks"></i> Status Pembangunan
                </div>
                <div class="info-value">
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
                        $statusIcon = match($digitalization->development_status) {
                            'planning' => 'fas fa-clipboard-list',
                            'development' => 'fas fa-code',
                            'testing' => 'fas fa-bug',
                            'deployment' => 'fas fa-rocket',
                            'maintenance' => 'fas fa-tools',
                            'completed' => 'fas fa-check-circle',
                            default => 'fas fa-flag'
                        };
                    @endphp
                    <span class="status-badge {{ $statusClass }}">
                        <i class="{{ $statusIcon }}"></i>
                        {{ ucfirst($digitalization->development_status) }}
                    </span>
                </div>
                <div class="info-description">Status semasa projek</div>
            </div>
        </div>
        
        @if($digitalization->development_period)
            <div class="project-timeline">
                <div class="timeline-title">
                    <i class="fas fa-clock"></i>
                    Tempoh Pembangunan
                </div>
                <div class="timeline-content">
                    <div class="info-card">
                        <div class="info-label">
                            <i class="fas fa-hourglass-half"></i> Jangka Masa
                        </div>
                        <div class="info-value">{{ $digitalization->development_period }}</div>
                        <div class="info-description">Tempoh yang ditetapkan untuk projek</div>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">
                    <i class="fas fa-user"></i> Pengguna Bertanggungjawab
                </div>
                <div class="info-value">
                    @if($digitalization->user_id && $digitalization->user)
                        <span class="user-badge">
                            <i class="fas fa-user-circle"></i>
                            {{ $digitalization->user->name }}
                        </span>
                    @else
                        <span class="user-badge no-user">
                            <i class="fas fa-user-slash"></i>
                            Tiada pengguna ditetapkan
                        </span>
                    @endif
                </div>
                <div class="info-description">Pengguna yang menguruskan projek ini</div>
            </div>
        </div>
        
        <div class="metadata-section">
            <div class="metadata-title">
                <i class="fas fa-info-circle"></i>
                Maklumat Sistem
            </div>
            <div class="metadata-grid">
                <div class="metadata-item">
                    <span class="metadata-label">ID Rekod:</span>
                    <span class="metadata-value">#{{ $digitalization->id }}</span>
                </div>
                <div class="metadata-item">
                    <span class="metadata-label">Tarikh Dibuat:</span>
                    <span class="metadata-value">{{ \Carbon\Carbon::parse($digitalization->created_at)->format('d/m/Y H:i:s') }}</span>
                </div>
                <div class="metadata-item">
                    <span class="metadata-label">Tarikh Kemaskini:</span>
                    <span class="metadata-value">{{ \Carbon\Carbon::parse($digitalization->updated_at)->format('d/m/Y H:i:s') }}</span>
                </div>
                <div class="metadata-item">
                    <span class="metadata-label">Status Projek:</span>
                    <span class="metadata-value">
                        @if($digitalization->development_status == 'completed')
                            <span style="color: #059669; font-weight: 600;">
                                <i class="fas fa-check-circle"></i> Selesai
                            </span>
                        @elseif($digitalization->development_status == 'development')
                            <span style="color: #d97706; font-weight: 600;">
                                <i class="fas fa-code"></i> Dalam Pembangunan
                            </span>
                        @else
                            <span style="color: #6366f1; font-weight: 600;">
                                <i class="fas fa-clock"></i> Dalam Proses
                            </span>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection