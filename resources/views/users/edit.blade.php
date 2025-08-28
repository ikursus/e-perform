@extends('template-induk2')

@section('title', 'Edit User')
@section('subtitle', 'Kemaskini maklumat user')

@section('page-header')
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('users.index') }}" class="btn" style="background: #6b7280; color: white; text-decoration: none;">
            ← Kembali ke Senarai
        </a>
        <a href="{{ route('users.show', $user->id) }}" class="btn" style="background: #3b82f6; color: white; text-decoration: none; margin-left: 10px;">
            👁️ Lihat Detail
        </a>
    </div>
@endsection

@section('content')
<style>
    .form-container {
        max-width: 600px;
        margin: 0 auto;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
        font-size: 14px;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #ffffff;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .form-control.error {
        border-color: #ef4444;
        background-color: #fef2f2;
    }
    
    .error-message {
        color: #ef4444;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }
    
    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-submit:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        color: white;
    }
    
    .btn-cancel {
        background: #6b7280;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-cancel:hover {
        background: #4b5563;
        color: white;
    }
    
    .required {
        color: #ef4444;
    }
    
    .form-help {
        font-size: 12px;
        color: #6b7280;
        margin-top: 5px;
    }
    
    .user-info {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 25px;
    }
    
    .user-info h4 {
        margin: 0 0 10px 0;
        color: #1e293b;
        font-size: 16px;
    }
    
    .user-info p {
        margin: 5px 0;
        color: #64748b;
        font-size: 14px;
    }
    
    .password-section {
        background: #fef3c7;
        border: 1px solid #fbbf24;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 25px;
    }
    
    .password-section h5 {
        margin: 0 0 10px 0;
        color: #92400e;
        font-size: 14px;
        font-weight: 600;
    }
    
    .password-section p {
        margin: 0;
        color: #92400e;
        font-size: 12px;
    }
</style>

<div class="form-container">
    <!-- User Info Display -->
    <div class="user-info">
        <h4>📝 Kemaskini User</h4>
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Didaftar pada:</strong> {{ date('d/m/Y H:i', strtotime($user->created_at)) }}</p>
        <p><strong>Kemaskini terakhir:</strong> {{ date('d/m/Y H:i', strtotime($user->updated_at)) }}</p>
    </div>
    
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name" class="form-label">
                Nama Penuh <span class="required">*</span>
            </label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   class="form-control {{ $errors->has('name') ? 'error' : '' }}" 
                   value="{{ old('name', $user->name) }}" 
                   placeholder="Masukkan nama penuh"
                   required>
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="email" class="form-label">
                Alamat Email <span class="required">*</span>
            </label>
            <input type="email" 
                   id="email" 
                   name="email" 
                   class="form-control {{ $errors->has('email') ? 'error' : '' }}" 
                   value="{{ old('email', $user->email) }}" 
                   placeholder="contoh@email.com"
                   required>
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
            <div class="form-help">Email akan digunakan untuk log masuk ke sistem</div>
        </div>
        
        <!-- Password Section -->
        <div class="password-section">
            <h5>🔒 Kemaskini Kata Laluan</h5>
            <p>Biarkan kosong jika tidak mahu mengubah kata laluan</p>
        </div>
        
        <div class="form-group">
            <label for="password" class="form-label">
                Kata Laluan Baru
            </label>
            <input type="password" 
                   id="password" 
                   name="password" 
                   class="form-control {{ $errors->has('password') ? 'error' : '' }}" 
                   placeholder="Masukkan kata laluan baru (opsional)">
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
            <div class="form-help">Kata laluan mestilah sekurang-kurangnya 8 aksara</div>
        </div>
        
        <div class="form-group">
            <label for="password_confirmation" class="form-label">
                Sahkan Kata Laluan Baru
            </label>
            <input type="password" 
                   id="password_confirmation" 
                   name="password_confirmation" 
                   class="form-control {{ $errors->has('password_confirmation') ? 'error' : '' }}" 
                   placeholder="Masukkan semula kata laluan baru">
            @error('password_confirmation')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <a href="{{ route('users.index') }}" class="btn-cancel">
                Batal
            </a>
            <button type="submit" class="btn-submit">
                ✏️ Kemaskini User
            </button>
        </div>
    </form>
</div>

<script>
// Real-time password confirmation validation
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    
    function validatePasswordMatch() {
        if (passwordConfirmation.value && password.value !== passwordConfirmation.value) {
            passwordConfirmation.classList.add('error');
        } else {
            passwordConfirmation.classList.remove('error');
        }
    }
    
    function togglePasswordRequired() {
        if (password.value.length > 0) {
            passwordConfirmation.required = true;
        } else {
            passwordConfirmation.required = false;
            passwordConfirmation.classList.remove('error');
        }
    }
    
    password.addEventListener('input', function() {
        validatePasswordMatch();
        togglePasswordRequired();
    });
    
    passwordConfirmation.addEventListener('input', validatePasswordMatch);
});
</script>
@endsection