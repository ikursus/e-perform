@extends('template-induk2')

@section('title', 'Detail User')
@section('subtitle', 'Maklumat lengkap user')

@section('page-header')
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('users.index') }}" class="btn" style="background: #6b7280; color: white; text-decoration: none;">
            ← Kembali ke Senarai
        </a>
        <a href="{{ route('users.edit', $user->id) }}" class="btn" style="background: #f59e0b; color: white; text-decoration: none; margin-left: 10px;">
            ✏️ Edit User
        </a>
    </div>
@endsection

@section('content')
<style>
    .detail-container {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .user-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        margin-bottom: 25px;
    }
    
    .user-header {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f3f4f6;
    }
    
    .user-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        font-weight: bold;
        margin-right: 20px;
        text-transform: uppercase;
    }
    
    .user-info {
        flex: 1;
    }
    
    .user-name {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 5px 0;
    }
    
    .user-email {
        font-size: 16px;
        color: #6b7280;
        margin: 0;
    }
    
    .user-status {
        display: inline-block;
        background: #10b981;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 10px;
    }
    
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }
    
    .detail-section {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 20px;
    }
    
    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #374151;
        margin: 0 0 15px 0;
        display: flex;
        align-items: center;
    }
    
    .section-title .icon {
        margin-right: 8px;
        font-size: 18px;
    }
    
    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .detail-item:last-child {
        border-bottom: none;
    }
    
    .detail-label {
        font-weight: 500;
        color: #6b7280;
        font-size: 14px;
    }
    
    .detail-value {
        font-weight: 600;
        color: #1f2937;
        font-size: 14px;
        text-align: right;
    }
    
    .actions-section {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn-action {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    
    .btn-edit:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        color: white;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .btn-delete:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
        color: white;
    }
    
    .btn-back {
        background: #6b7280;
        color: white;
    }
    
    .btn-back:hover {
        background: #4b5563;
        color: white;
    }
    
    @media (max-width: 768px) {
        .user-header {
            flex-direction: column;
            text-align: center;
        }
        
        .user-avatar {
            margin-right: 0;
            margin-bottom: 15px;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-action {
            width: 100%;
        }
    }
</style>

<div class="detail-container">
    <!-- User Card -->
    <div class="user-card">
        <div class="user-header">
            <div class="user-avatar">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div class="user-info">
                <h1 class="user-name">{{ $user->name }}</h1>
                <p class="user-email">{{ $user->email }}</p>
                <span class="user-status">✅ Aktif</span>
            </div>
        </div>
        
        <!-- Detail Grid -->
        <div class="detail-grid">
            <!-- Basic Information -->
            <div class="detail-section">
                <h3 class="section-title">
                    <span class="icon">👤</span>
                    Maklumat Asas
                </h3>
                <div class="detail-item">
                    <span class="detail-label">ID User</span>
                    <span class="detail-value">#{{ $user->id }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Nama Penuh</span>
                    <span class="detail-value">{{ $user->name }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Alamat Email</span>
                    <span class="detail-value">{{ $user->email }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Status Email</span>
                    <span class="detail-value">
                        @if($user->email_verified_at)
                            <span style="color: #10b981;">✅ Disahkan</span>
                        @else
                            <span style="color: #ef4444;">❌ Belum Disahkan</span>
                        @endif
                    </span>
                </div>
            </div>
            
            <!-- Account Information -->
            <div class="detail-section">
                <h3 class="section-title">
                    <span class="icon">📅</span>
                    Maklumat Akaun
                </h3>
                <div class="detail-item">
                    <span class="detail-label">Tarikh Daftar</span>
                    <span class="detail-value">{{ date('d/m/Y', strtotime($user->created_at)) }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Masa Daftar</span>
                    <span class="detail-value">{{ date('H:i:s', strtotime($user->created_at)) }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Kemaskini Terakhir</span>
                    <span class="detail-value">{{ date('d/m/Y H:i', strtotime($user->updated_at)) }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tempoh Akaun</span>
                    <span class="detail-value">{{ $user->created_at }}</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Actions Section -->
    <div class="actions-section">
        <h3 class="section-title" style="justify-content: center; margin-bottom: 20px;">
            <span class="icon">⚙️</span>
            Tindakan
        </h3>
        <div class="action-buttons">
            <a href="{{ route('users.index') }}" class="btn-action btn-back">
                ← Kembali ke Senarai
            </a>
            <a href="{{ route('users.edit', $user->id) }}" class="btn-action btn-edit">
                ✏️ Edit User
            </a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;" 
                  onsubmit="return confirm('Adakah anda pasti mahu memadam user {{ $user->name }}? Tindakan ini tidak boleh dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action btn-delete">
                    🗑️ Padam User
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Add some interactive features
document.addEventListener('DOMContentLoaded', function() {
    // Add click to copy functionality for email
    const emailElement = document.querySelector('.user-email');
    if (emailElement) {
        emailElement.style.cursor = 'pointer';
        emailElement.title = 'Klik untuk salin email';
        
        emailElement.addEventListener('click', function() {
            navigator.clipboard.writeText(this.textContent).then(function() {
                // Show temporary feedback
                const originalText = emailElement.textContent;
                emailElement.textContent = '📋 Email disalin!';
                emailElement.style.color = '#10b981';
                
                setTimeout(function() {
                    emailElement.textContent = originalText;
                    emailElement.style.color = '#6b7280';
                }, 2000);
            });
        });
    }
});
</script>
@endsection