@extends('template-induk2')

@section('title', 'Detail Internet Connection')
@section('subtitle', 'Maklumat lengkap sambungan internet')

@section('page-header')
    <!-- Header content to ensure page-actions is displayed -->
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('internet-connections.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Senarai
        </a>
        <a href="{{ route('internet-connections.edit', $internetConnection->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <form action="{{ route('internet-connections.destroy', $internetConnection->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Adakah anda pasti ingin memadam data ini?')">
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
        max-width: 900px;
        margin: 0 auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .detail-header {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
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
        border-color: #3b82f6;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
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
    
    .speed-display {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none !important;
    }
    
    .speed-display .info-label {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .speed-display .info-value {
        color: white;
        font-size: 28px;
    }
    
    .speed-display .info-description {
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
</style>

<div class="detail-container">
    <div class="detail-header">
        <h2><i class="fas fa-wifi"></i> {{ $internetConnection->telco }}</h2>
        <p>Detail Sambungan Internet</p>
    </div>
    
    <div class="detail-content">
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">
                    <i class="fas fa-building"></i> Syarikat Telco
                </div>
                <div class="info-value">{{ $internetConnection->telco }}</div>
                <div class="info-description">Penyedia perkhidmatan telekomunikasi</div>
            </div>
            
            <div class="info-card speed-display">
                <div class="info-label">
                    <i class="fas fa-tachometer-alt"></i> Kelajuan Sambungan
                </div>
                <div class="info-value">{{ $internetConnection->connection_speed }} {{ $internetConnection->measurement }}</div>
                <div class="info-description">Kelajuan maksimum sambungan internet</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">
                    <i class="fas fa-ruler"></i> Unit Pengukuran
                </div>
                <div class="info-value">{{ $internetConnection->measurement }}</div>
                <div class="info-description">
                    @if($internetConnection->measurement == 'Mbps')
                        Megabits per second
                    @elseif($internetConnection->measurement == 'Gbps')
                        Gigabits per second
                    @elseif($internetConnection->measurement == 'Kbps')
                        Kilobits per second
                    @else
                        Unit pengukuran kelajuan
                    @endif
                </div>
            </div>
            
            <div class="info-card">
                <div class="info-label">
                    <i class="fas fa-user"></i> Pengguna Bertanggungjawab
                </div>
                <div class="info-value">
                    @if($internetConnection->user_id && $internetConnection->user)
                        <span class="user-badge">
                            <i class="fas fa-user-circle"></i>
                            {{ $internetConnection->user->name }}
                        </span>
                    @else
                        <span class="user-badge no-user">
                            <i class="fas fa-user-slash"></i>
                            Tiada pengguna ditetapkan
                        </span>
                    @endif
                </div>
                <div class="info-description">Pengguna yang menguruskan data ini</div>
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
                    <span class="metadata-value">#{{ $internetConnection->id }}</span>
                </div>
                <div class="metadata-item">
                    <span class="metadata-label">Tarikh Dibuat:</span>
                    <span class="metadata-value">{{ $internetConnection->created_at->format('d/m/Y H:i:s') }}</span>
                </div>
                <div class="metadata-item">
                    <span class="metadata-label">Tarikh Kemaskini:</span>
                    <span class="metadata-value">{{ $internetConnection->updated_at->format('d/m/Y H:i:s') }}</span>
                </div>
                <div class="metadata-item">
                    <span class="metadata-label">Status:</span>
                    <span class="metadata-value">
                        <span style="color: #10b981; font-weight: 600;">
                            <i class="fas fa-check-circle"></i> Aktif
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection