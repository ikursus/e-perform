@extends('template-induk2')

@section('title', 'Internet Connections')
@section('subtitle', 'Pengurusan data sambungan internet dan kelajuan')

@section('page-header')
    <!-- Header content to ensure page-actions is displayed -->
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('service.index') }}" class="btn btn-secondary" style="margin-right: 10px;">
            <i class="fas fa-arrow-left"></i> Kembali ke Service
        </a>
        <a href="{{ route('internet-connections.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Data Baru
        </a>
    </div>
@endsection

@section('content')
<style>
    .connections-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .connections-table th,
    .connections-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .connections-table th {
        background: linear-gradient(135deg, #155e75 0%, #0e7490 100%);
        color: white;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .connections-table tr:hover {
        background-color: #f8fafc;
    }
    
    .connections-table tr:last-child td {
        border-bottom: none;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    
    .btn-action {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.2s ease;
    }
    
    .btn-view {
        background: #17a2b8;
        color: white;
    }
    
    .btn-view:hover {
        background: #138496;
        color: white;
        text-decoration: none;
    }
    
    .btn-edit {
        background: #ffc107;
        color: #212529;
    }
    
    .btn-edit:hover {
        background: #e0a800;
        color: #212529;
        text-decoration: none;
    }
    
    .btn-delete {
        background: #dc3545;
        color: white;
    }
    
    .btn-delete:hover {
        background: #c82333;
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #718096;
    }
    
    .empty-state i {
        font-size: 64px;
        margin-bottom: 20px;
        color: #cbd5e0;
    }
    
    .empty-state h3 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #4a5568;
    }
    
    .empty-state p {
        font-size: 16px;
        margin-bottom: 30px;
    }
    
    .speed-badge {
        background: #e3f2fd;
        color: #1976d2;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .telco-badge {
        background: #f3e5f5;
        color: #7b1fa2;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }
</style>

@if($connections->count() > 0)
    <div class="table-responsive">
        <table class="connections-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Telco</th>
                    <th>Kelajuan Sambungan</th>
                    <th>Pengukuran</th>
                    <th>Pengguna</th>
                    <th>Tarikh Dibuat</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($connections as $connection)
                    <tr>
                        <td><strong>#{{ $connection->id }}</strong></td>
                        <td>
                            <span class="telco-badge">{{ $connection->telco }}</span>
                        </td>
                        <td>
                            <span class="speed-badge">{{ $connection->connection_speed }}</span>
                        </td>
                        <td>{{ $connection->measurement }}</td>
                        <td>
                            @if($connection->user_name)
                                <i class="fas fa-user"></i> {{ $connection->user_name }}
                            @else
                                <span style="color: #9ca3af;">Tiada pengguna</span>
                            @endif
                        </td>
                        <td>
                            <i class="fas fa-calendar"></i> 
                            {{ \Carbon\Carbon::parse($connection->created_at)->format('d/m/Y H:i') }}
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('internet-connections.show', $connection->id) }}" class="btn-action btn-view">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <a href="{{ route('internet-connections.edit', $connection->id) }}" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('internet-connections.destroy', $connection->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Adakah anda pasti ingin memadam data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i> Padam
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="empty-state">
        <i class="fas fa-wifi"></i>
        <h3>Tiada Data Sambungan Internet</h3>
        <p>Belum ada data sambungan internet yang dimasukkan dalam sistem.</p>
        <a href="{{ route('internet-connections.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Data Pertama
        </a>
    </div>
@endif
@endsection