@extends('template-induk2')

@section('title', 'Edit Internet Connection')
@section('subtitle', 'Kemaskini data sambungan internet')

@section('page-header')
    <!-- Header content to ensure page-actions is displayed -->
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('internet-connections.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Senarai
        </a>
        <a href="{{ route('internet-connections.show', $internetConnection->id) }}" class="btn btn-info">
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
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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
        background: #3b82f6;
        color: white;
    }
    
    .btn-primary:hover {
        background: #2563eb;
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
        background: #dbeafe;
        color: #1e40af;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        margin-bottom: 20px;
        display: inline-block;
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h2><i class="fas fa-edit"></i> Edit Data Internet Connection</h2>
        <p>Kemaskini maklumat sambungan internet</p>
        <div class="info-badge">
            <i class="fas fa-info-circle"></i> ID: {{ $internetConnection->id }} | Dibuat: {{ $internetConnection->created_at->format('d/m/Y H:i') }}
        </div>
    </div>
    
    <form action="{{ route('internet-connections.update', $internetConnection->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="telco" class="form-label required">Telco</label>
            <input type="text" 
                   id="telco" 
                   name="telco" 
                   class="form-control {{ $errors->has('telco') ? 'error' : '' }}" 
                   value="{{ old('telco', $internetConnection->telco) }}"
                   placeholder="Contoh: Telekom Malaysia, Maxis, Celcom"
                   required>
            <div class="form-help">Nama syarikat telekomunikasi yang menyediakan sambungan</div>
            @error('telco')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="connection_speed" class="form-label required">Kelajuan Sambungan</label>
            <input type="text" 
                   id="connection_speed" 
                   name="connection_speed" 
                   class="form-control {{ $errors->has('connection_speed') ? 'error' : '' }}" 
                   value="{{ old('connection_speed', $internetConnection->connection_speed) }}"
                   placeholder="Contoh: 100, 500, 1000"
                   required>
            <div class="form-help">Kelajuan sambungan internet (tanpa unit)</div>
            @error('connection_speed')
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
                <option value="Mbps" {{ old('measurement', $internetConnection->measurement) == 'Mbps' ? 'selected' : '' }}>Mbps (Megabits per second)</option>
                <option value="Gbps" {{ old('measurement', $internetConnection->measurement) == 'Gbps' ? 'selected' : '' }}>Gbps (Gigabits per second)</option>
                <option value="Kbps" {{ old('measurement', $internetConnection->measurement) == 'Kbps' ? 'selected' : '' }}>Kbps (Kilobits per second)</option>
            </select>
            <div class="form-help">Unit pengukuran untuk kelajuan sambungan</div>
            @error('measurement')
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
                    <option value="{{ $user->id }}" {{ old('user_id', $internetConnection->user_id) == $user->id ? 'selected' : '' }}>
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
            <a href="{{ route('internet-connections.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Kemaskini Data
            </button>
        </div>
    </form>
</div>
@endsection