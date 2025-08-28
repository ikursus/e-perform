@extends('template-induk2')

@section('title', 'Detail Cyber Attack')
@section('subtitle', 'Maklumat lengkap serangan siber')

@section('page-header')
    <!-- Header content to ensure page-actions is displayed -->
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('cyber-attacks.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Senarai
        </a>
        <a href="{{ route('cyber-attacks.edit', $cyberAttack->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <form action="{{ route('cyber-attacks.destroy', $cyberAttack->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Adakah anda pasti ingin memadam data ini?')">
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
        background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
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
        border-color: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(220, 38, 38, 0.15);
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
    
    .frequency-display {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        border: none !important;
    }
    
    .frequency-display .info-label {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .frequency-display .info-value {
        color: white;
        font-size: 28px;
    }
    
    .frequency-display .info-description {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .source-display {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none !important;
    }
    
    .source-display .info-label {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .source-display .info-value {
        color: white;
        font-size: 24px;
    }
    
    .source-display .info-description {
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
    
    .security-alert {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 30px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    
    .security-alert i {
        color: #dc2626;
        font-size: 20px;
        margin-top: 2px;
    }
    
    .security-alert-content h4 {
        color: #991b1b;
        margin: 0 0 8px 0;
        font-size: 16px;
        font-weight: 600;
    }
    
    .security-alert-content p {
        color: #7f1d1d;
        margin: 0;
        font-size: 14px;
        line-height: 1.5;
    }
</style>

<div class="detail-container">
    <div class="detail-header">
        <h2><i class="fas fa-shield-alt"></i> {{ $cyberAttack->attack_source }}</h2>
        <p>Detail Serangan Siber</p>
    </div>
    
    <div class="detail-content">
        <div class="security-alert">
            <i class="fas fa-exclamation-triangle"></i>
            <div class="security-alert-content">
                <h4>Maklumat Keselamatan</h4>
                <p>Data ini mengandungi maklumat sensitif mengenai serangan siber. Pastikan maklumat ini hanya diakses oleh pihak yang berwenang.</p>
            </div>
        </div>
        
        <div class="info-grid">
            <div class="info-card frequency-display">
                <div class="info-label">
                    <i class="fas fa-chart-line"></i> Kekerapan Serangan
                </div>
                <div class="info-value">{{ $cyberAttack->attack_frequency }}</div>
                <div class="info-description">{{ $cyberAttack->measurement }}</div>
            </div>
            
            <div class="info-card source-display">
                <div class="info-label">
                    <i class="fas fa-exclamation-triangle"></i> Sumber Serangan
                </div>
                <div class="info-value">{{ $cyberAttack->attack_source }}</div>
                <div class="info-description">Jenis serangan yang dikesan</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">
                    <i class="fas fa-ruler"></i> Unit Pengukuran
                </div>
                <div class="info-value">{{ $cyberAttack->measurement }}</div>
                <div class="info-description">Unit pengukuran untuk kekerapan serangan</div>
            </div>
            
            <div class="info-card">
                <div class="info-label">
                    <i class="fas fa-user"></i> Pengguna Bertanggungjawab
                </div>
                <div class="info-value">
                    @if($cyberAttack->user_id && $cyberAttack->user)
                        <span class="user-badge">
                            <i class="fas fa-user-circle"></i>
                            {{ $cyberAttack->user->name }}
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
                    <span class="metadata-value">#{{ $cyberAttack->id }}</span>
                </div>
                <div class="metadata-item">
                    <span class="metadata-label">Tarikh Dibuat:</span>
                    <span class="metadata-value">{{ $cyberAttack->created_at->format('d/m/Y H:i:s') }}</span>
                </div>
                <div class="metadata-item">
                    <span class="metadata-label">Tarikh Kemaskini:</span>
                    <span class="metadata-value">{{ $cyberAttack->updated_at->format('d/m/Y H:i:s') }}</span>
                </div>
                <div class="metadata-item">
                    <span class="metadata-label">Status Keselamatan:</span>
                    <span class="metadata-value">
                        <span style="color: #dc2626; font-weight: 600;">
                            <i class="fas fa-exclamation-circle"></i> Perlu Perhatian
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection