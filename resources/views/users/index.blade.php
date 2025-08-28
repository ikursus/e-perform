@extends('template-induk2')

@section('title', 'Pengurusan Users')
@section('subtitle', 'Senarai semua users dalam sistem')

@section('page-header')
    <!-- Header content to ensure page-actions is displayed -->
@endsection

@section('page-actions')
    <div style="margin-top: 15px;">
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            + Tambah User Baru
        </a>
    </div>
@endsection

@section('content')
<style>
    .users-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .users-table th,
    .users-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .users-table th {
        background: linear-gradient(135deg, #155e75 0%, #0e7490 100%);
        color: white;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .users-table tr:hover {
        background-color: #f8fafc;
    }
    
    .users-table tr:last-child td {
        border-bottom: none;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .btn-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
    }
    
    .btn-info:hover {
        background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
        transform: translateY(-1px);
        color: white;
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    
    .btn-warning:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        transform: translateY(-1px);
        color: white;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .btn-danger:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        transform: translateY(-1px);
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }
    
    .empty-state h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #475569;
    }
    
    .user-email {
        color: #64748b;
        font-size: 14px;
    }
    
    .user-date {
        color: #94a3b8;
        font-size: 13px;
    }
</style>

@if($users->count() > 0)
    <table class="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Tarikh Daftar</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td><strong>#{{ $user->id }}</strong></td>
                <td>{{ $user->name }}</td>
                <td><span class="user-email">{{ $user->email }}</span></td>
                <td><span class="user-date">{{ date('d/m/Y H:i', strtotime($user->created_at)) }}</span></td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('users.show', $user->id) }}" class="btn-sm btn-info" title="Lihat Detail">
                            👁️ Lihat
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn-sm btn-warning" title="Edit User">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;" 
                              onsubmit="return confirm('Adakah anda pasti ingin memadam user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-danger" title="Padam User">
                                🗑️ Padam
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="empty-state">
        <h3>Tiada Users Dijumpai</h3>
        <p>Belum ada users yang didaftarkan dalam sistem.</p>
        <div style="margin-top: 20px;">
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                + Tambah User Pertama
            </a>
        </div>
    </div>
@endif
@endsection