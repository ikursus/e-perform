@extends('template-induk2')

@section('title', 'Pengurusan Cyber Attacks')
@section('subtitle', 'Senarai data serangan siber')

@section('page-header')
    <!-- Header content to ensure page-actions is displayed -->
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('cyber-attacks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Cyber Attack Baru
        </a>
        <a href="{{ route('service.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Service
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
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        color: white;
        padding: 25px 30px;
        border-bottom: 3px solid #991b1b;
    }
    
    .table-header h3 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .table-header p {
        margin: 8px 0 0 0;
        opacity: 0.9;
        font-size: 16px;
    }
    
    .table-content {
        padding: 0;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    
    .data-table th {
        background: #f8fafc;
        color: #374151;
        font-weight: 600;
        padding: 18px 20px;
        text-align: left;
        border-bottom: 2px solid #e5e7eb;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .data-table td {
        padding: 18px 20px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        font-size: 15px;
    }
    
    .data-table tr:hover {
        background: #f8fafc;
    }
    
    .data-table tr:last-child td {
        border-bottom: none;
    }
    
    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        margin-right: 8px;
    }
    
    .btn-primary {
        background: #3b82f6;
        color: white;
    }
    
    .btn-primary:hover {
        background: #2563eb;
        color: white;
        text-decoration: none;
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
        padding: 60px 30px;
        color: #6b7280;
    }
    
    .empty-state i {
        font-size: 64px;
        margin-bottom: 20px;
        color: #d1d5db;
    }
    
    .empty-state h4 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #374151;
    }
    
    .empty-state p {
        font-size: 16px;
        margin-bottom: 25px;
        line-height: 1.6;
    }
    
    .user-badge {
        background: #dbeafe;
        color: #1e40af;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .no-user {
        background: #f3f4f6;
        color: #6b7280;
        font-style: italic;
    }
    
    .frequency-badge {
        background: #fef3c7;
        color: #92400e;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }
    
    .source-badge {
        background: #fee2e2;
        color: #991b1b;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }
    
    .stats-row {
        background: #f8fafc;
        padding: 20px 30px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .stats-item {
        text-align: center;
    }
    
    .stats-number {
        font-size: 24px;
        font-weight: 700;
        color: #dc2626;
        display: block;
    }
    
    .stats-label {
        font-size: 12px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<div class="table-container">
    <div class="table-header">
        <h3>
            <i class="fas fa-shield-alt"></i>
            Data Serangan Siber
        </h3>
        <p>Pengurusan dan pemantauan data serangan siber</p>
    </div>
    
    @if($cyberAttacks->count() > 0)
        <div class="stats-row">
            <div class="stats-item">
                <span class="stats-number">{{ $cyberAttacks->count() }}</span>
                <span class="stats-label">Jumlah Rekod</span>
            </div>
            <div class="stats-item">
                <span class="stats-number">{{ $cyberAttacks->where('user_id', '!=', null)->count() }}</span>
                <span class="stats-label">Ada Pengguna</span>
            </div>
            <div class="stats-item">
                <span class="stats-number">{{ $cyberAttacks->groupBy('attack_source')->count() }}</span>
                <span class="stats-label">Sumber Berbeza</span>
            </div>
        </div>
        
        <div class="table-content">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kekerapan Serangan</th>
                        <th>Pengukuran</th>
                        <th>Sumber Serangan</th>
                        <th>Pengguna</th>
                        <th>Tarikh Dibuat</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cyberAttacks as $attack)
                        <tr>
                            <td><strong>#{{ $attack->id }}</strong></td>
                            <td>
                                <span class="frequency-badge">
                                    <i class="fas fa-chart-line"></i>
                                    {{ $attack->attack_frequency }}
                                </span>
                            </td>
                            <td>{{ $attack->measurement }}</td>
                            <td>
                                <span class="source-badge">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $attack->attack_source }}
                                </span>
                            </td>
                            <td>
                                @if($attack->user_name)
                                    <span class="user-badge">
                                        <i class="fas fa-user"></i>
                                        {{ $attack->user_name }}
                                    </span>
                                @else
                                    <span class="user-badge no-user">
                                        <i class="fas fa-user-slash"></i>
                                        Tiada
                                    </span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($attack->created_at)->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('cyber-attacks.show', $attack->id) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <a href="{{ route('cyber-attacks.edit', $attack->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('cyber-attacks.destroy', $attack->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Adakah anda pasti ingin memadam data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Padam
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-shield-alt"></i>
            <h4>Tiada Data Serangan Siber</h4>
            <p>Belum ada data serangan siber yang direkodkan dalam sistem.<br>Klik butang di atas untuk menambah data baru.</p>
            <a href="{{ route('cyber-attacks.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data Pertama
            </a>
        </div>
    @endif
</div>
@endsection