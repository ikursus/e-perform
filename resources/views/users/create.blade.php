@extends('template-induk2')

@section('title', 'Tambah User Baru')
@section('subtitle', 'Daftar user baru dalam sistem')

@section('page-header')
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('users.index') }}" class="btn" style="background: #6b7280; color: white; text-decoration: none;">
            ← Kembali ke Senarai
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
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
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
</style>

<div class="form-container">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name" class="form-label">
                Nama Penuh <span class="required">*</span>
            </label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   class="form-control {{ $errors->has('name') ? 'error' : '' }}" 
                   value="{{ old('name') }}" 
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
                   value="{{ old('email') }}" 
                   placeholder="contoh@email.com"
                   required>
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
            <div class="form-help">Email akan digunakan untuk log masuk ke sistem</div>
        </div>
        
        <div class="form-group">
            <label for="password" class="form-label">
                Kata Laluan <span class="required">*</span>
            </label>
            <input type="password" 
                   id="password" 
                   name="password" 
                   class="form-control {{ $errors->has('password') ? 'error' : '' }}" 
                   placeholder="Masukkan kata laluan"
                   required>
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
            <div class="form-help">Kata laluan mestilah sekurang-kurangnya 8 aksara</div>
        </div>
        
        <div class="form-group">
            <label for="password_confirmation" class="form-label">
                Sahkan Kata Laluan <span class="required">*</span>
            </label>
            <input type="password" 
                   id="password_confirmation" 
                   name="password_confirmation" 
                   class="form-control {{ $errors->has('password_confirmation') ? 'error' : '' }}" 
                   placeholder="Masukkan semula kata laluan"
                   required>
            @error('password_confirmation')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <a href="{{ route('users.index') }}" class="btn-cancel">
                Batal
            </a>
            <button type="submit" class="btn-submit">
                💾 Simpan User
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
    
    password.addEventListener('input', validatePasswordMatch);
    passwordConfirmation.addEventListener('input', validatePasswordMatch);
});
</script>
@endsection