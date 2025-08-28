@extends('template-induk2')

@section('title', 'Edit Cyber Attack')
@section('subtitle', 'Kemaskini data serangan siber')

@section('page-header')
    <!-- Header content to ensure page-actions is displayed -->
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('cyber-attacks.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Senarai
        </a>
        <a href="{{ route('cyber-attacks.show', $cyberAttack->id) }}" class="btn btn-info">
            <i class="fas fa-eye"></i> Lihat Detail
        </a>
    </div>
@endsection

@section('content')
<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
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
    
    .form-label.required::after {
        content: ' *';
        color: #ef4444;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #ffffff;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }
    
    .form-control.error {
        border-color: #ef4444;
    }
    
    .form-help {
        font-size: 12px;
        color: #6b7280;
        margin-top: 4px;
    }
    
    .error-message {
        color: #ef4444;
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }
    
    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: #dc2626;
        color: white;
    }
    
    .btn-primary:hover {
        background: #b91c1c;
        transform: translateY(-1px);
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
    
    .btn-info {
        background: #06b6d4;
        color: white;
    }
    
    .btn-info:hover {
        background: #0891b2;
        color: white;
        text-decoration: none;
    }
    
    .form-header {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f3f4f6;
    }
    
    .form-header h2 {
        color: #1f2937;
        margin-bottom: 10px;
        font-size: 28px;
    }
    
    .form-header p {
        color: #6b7280;
        font-size: 16px;
        margin: 0;
    }
    
    .info-badge {
        background: #fef2f2;
        color: #991b1b;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        margin-bottom: 20px;
        display: inline-block;
    }
    
    .security-notice {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 30px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    
    .security-notice i {
        color: #dc2626;
        font-size: 20px;
        margin-top: 2px;
    }
    
    .security-notice-content h4 {
        color: #991b1b;
        margin: 0 0 8px 0;
        font-size: 16px;
        font-weight: 600;
    }
    
    .security-notice-content p {
        color: #7f1d1d;
        margin: 0;
        font-size: 14px;
        line-height: 1.5;
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-edit"></i> Edit Data Serangan Siber</h2>
        <p>Kemaskini maklumat serangan siber</p>
        <div class="info-badge">
            <i class="fas fa-info-circle"></i> ID: {{ $cyberAttack->id }} | Dibuat: {{ \Carbon\Carbon::parse($cyberAttack->created_at)->format('d/m/Y H:i') }}
        </div>
    </div>
    
    <div class="security-notice">
        <i class="fas fa-exclamation-triangle"></i>
        <div class="security-notice-content">
            <h4>Maklumat Keselamatan</h4>
            <p>Data serangan siber adalah maklumat sensitif. Pastikan semua perubahan yang dibuat adalah tepat dan sahih untuk tujuan analisis keselamatan.</p>
        </div>
    </div>
    
    <form action="{{ route('cyber-attacks.update', $cyberAttack->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="attack_frequency" class="form-label required">Kekerapan Serangan</label>
            <input type="text" 
                   id="attack_frequency" 
                   name="attack_frequency" 
                   class="form-control {{ $errors->has('attack_frequency') ? 'error' : '' }}" 
                   value="{{ old('attack_frequency', $cyberAttack->attack_frequency) }}"
                   placeholder="Contoh: Harian, Mingguan, Bulanan, 5 kali sehari"
                   required>
            <div class="form-help">Kekerapan atau frekuensi serangan yang berlaku</div>
            @error('attack_frequency')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="measurement" class="form-label required">Unit Pengukuran</label>
            <select id="measurement" 
                    name="measurement" 
                    class="form-control {{ $errors->has('measurement') ? 'error' : '' }}" 
                    required>
                <option value="">Pilih unit pengukuran</option>
                <option value="Per Hari" {{ old('measurement', $cyberAttack->measurement) == 'Per Hari' ? 'selected' : '' }}>Per Hari</option>
                <option value="Per Minggu" {{ old('measurement', $cyberAttack->measurement) == 'Per Minggu' ? 'selected' : '' }}>Per Minggu</option>
                <option value="Per Bulan" {{ old('measurement', $cyberAttack->measurement) == 'Per Bulan' ? 'selected' : '' }}>Per Bulan</option>
                <option value="Per Tahun" {{ old('measurement', $cyberAttack->measurement) == 'Per Tahun' ? 'selected' : '' }}>Per Tahun</option>
                <option value="Per Jam" {{ old('measurement', $cyberAttack->measurement) == 'Per Jam' ? 'selected' : '' }}>Per Jam</option>
                <option value="Per Minit" {{ old('measurement', $cyberAttack->measurement) == 'Per Minit' ? 'selected' : '' }}>Per Minit</option>
                <option value="Sekali" {{ old('measurement', $cyberAttack->measurement) == 'Sekali' ? 'selected' : '' }}>Sekali Sahaja</option>
                <option value="Berterusan" {{ old('measurement', $cyberAttack->measurement) == 'Berterusan' ? 'selected' : '' }}>Berterusan</option>
            </select>
            <div class="form-help">Unit pengukuran untuk kekerapan serangan</div>
            @error('measurement')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="attack_source" class="form-label required">Sumber Serangan</label>
            <input type="text" 
                   id="attack_source" 
                   name="attack_source" 
                   class="form-control {{ $errors->has('attack_source') ? 'error' : '' }}" 
                   value="{{ old('attack_source', $cyberAttack->attack_source) }}"
                   placeholder="Contoh: Malware, Phishing, DDoS, Ransomware, Social Engineering"
                   required>
            <div class="form-help">Jenis atau sumber serangan siber yang dikesan</div>
            @error('attack_source')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="user_id" class="form-label">Pengguna (Pilihan)</label>
            <select id="user_id" 
                    name="user_id" 
                    class="form-control {{ $errors->has('user_id') ? 'error' : '' }}">
                <option value="">Pilih pengguna (pilihan)</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $cyberAttack->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <div class="form-help">Pengguna yang bertanggungjawab untuk data ini (tidak wajib)</div>
            @error('user_id')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <a href="{{ route('cyber-attacks.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Kemaskini Data
            </button>
        </div>
    </form>
</div>
@endsection