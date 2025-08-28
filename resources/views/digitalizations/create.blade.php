@extends('template-induk2')

@section('title', 'Tambah Data Digitalisasi')
@section('subtitle', 'Masukkan maklumat digitalisasi baharu')

@section('page-header')
    <!-- Header content to ensure page-actions is displayed -->
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('digitalizations.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Senarai
        </a>
    </div>
@endsection

@section('content')
<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .form-header {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
        padding: 30px;
        text-align: center;
    }
    
    .form-header h3 {
        margin: 0 0 8px 0;
        font-size: 28px;
        font-weight: 700;
    }
    
    .form-header p {
        margin: 0;
        font-size: 16px;
        opacity: 0.9;
    }
    
    .form-content {
        padding: 40px;
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
    
    .required {
        color: #ef4444;
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
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }
    
    .form-control:hover {
        border-color: #d1d5db;
    }
    
    .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #ffffff;
        cursor: pointer;
    }
    
    .form-select:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }
    
    .form-select:hover {
        border-color: #d1d5db;
    }
    
    .form-text {
        font-size: 12px;
        color: #6b7280;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .btn {
        padding: 12px 24px;
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
    
    .btn-primary {
        background: #8b5cf6;
        color: white;
    }
    
    .btn-primary:hover {
        background: #7c3aed;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
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
    
    .form-actions {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid #f3f4f6;
        text-align: center;
    }
    
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        border: 1px solid;
    }
    
    .alert-danger {
        background: #fef2f2;
        border-color: #fecaca;
        color: #991b1b;
    }
    
    .alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }
    
    .alert-danger li {
        margin-bottom: 5px;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .form-content {
            padding: 25px;
        }
    }
    
    .input-icon {
        position: relative;
    }
    
    .input-icon i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 14px;
    }
    
    .input-icon .form-control {
        padding-left: 40px;
    }
    
    .input-icon .form-select {
        padding-left: 40px;
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h3><i class="fas fa-digital-tachograph"></i> Tambah Data Digitalisasi</h3>
        <p>Masukkan maklumat projek digitalisasi baharu</p>
    </div>
    
    <div class="form-content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong><i class="fas fa-exclamation-triangle"></i> Terdapat ralat dalam borang:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('digitalizations.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="title" class="form-label">
                    <i class="fas fa-heading"></i> Tajuk Projek <span class="required">*</span>
                </label>
                <div class="input-icon">
                    <i class="fas fa-project-diagram"></i>
                    <input type="text" 
                           class="form-control" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}" 
                           placeholder="Masukkan tajuk projek digitalisasi"
                           required>
                </div>
                <div class="form-text">
                    <i class="fas fa-info-circle"></i>
                    Nama projek atau inisiatif digitalisasi
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="year" class="form-label">
                        <i class="fas fa-calendar-alt"></i> Tahun <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-calendar"></i>
                        <input type="number" 
                               class="form-control" 
                               id="year" 
                               name="year" 
                               value="{{ old('year', date('Y')) }}" 
                               min="1900" 
                               max="{{ date('Y') + 10 }}"
                               placeholder="{{ date('Y') }}"
                               required>
                    </div>
                    <div class="form-text">
                        <i class="fas fa-info-circle"></i>
                        Tahun pelaksanaan projek
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="development_type" class="form-label">
                        <i class="fas fa-code"></i> Jenis Pembangunan <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-cogs"></i>
                        <select class="form-select" id="development_type" name="development_type" required>
                            <option value="">Pilih jenis pembangunan</option>
                            @foreach($developmentTypes as $key => $value)
                                <option value="{{ $key }}" {{ old('development_type') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-text">
                        <i class="fas fa-info-circle"></i>
                        Platform atau teknologi yang digunakan
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="development_period" class="form-label">
                    <i class="fas fa-clock"></i> Tempoh Pembangunan
                </label>
                <div class="input-icon">
                    <i class="fas fa-hourglass-half"></i>
                    <input type="text" 
                           class="form-control" 
                           id="development_period" 
                           name="development_period" 
                           value="{{ old('development_period') }}" 
                           placeholder="Contoh: 6 bulan, Q1 2024, Januari - Mac 2024">
                </div>
                <div class="form-text">
                    <i class="fas fa-info-circle"></i>
                    Jangka masa pembangunan projek (pilihan)
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="development_status" class="form-label">
                        <i class="fas fa-tasks"></i> Status Pembangunan <span class="required">*</span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-flag"></i>
                        <select class="form-select" id="development_status" name="development_status" required>
                            <option value="">Pilih status pembangunan</option>
                            @foreach($developmentStatuses as $key => $value)
                                <option value="{{ $key }}" {{ old('development_status') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-text">
                        <i class="fas fa-info-circle"></i>
                        Status semasa projek
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="user_id" class="form-label">
                        <i class="fas fa-user"></i> Pengguna Bertanggungjawab
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-user-circle"></i>
                        <select class="form-select" id="user_id" name="user_id">
                            <option value="">Pilih pengguna (pilihan)</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-text">
                        <i class="fas fa-info-circle"></i>
                        Pengguna yang menguruskan projek ini
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
                <a href="{{ route('digitalizations.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection