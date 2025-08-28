@extends('template-induk2')

@section('title', 'Investor Holdings')

@section('page-header')
@endsection

@section('content')
    
<!-- Page Header -->
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h2 style="font-size: 28px; font-weight: 700; color: #1e293b; margin: 0;">Investor Holdings Management</h2>
    <div class="button-group" style="display: flex; gap: 10px;">
        <a href="{{ route('investor-holdings.create') }}" class="btn btn-primary">
            ➕ Tambah Baru
        </a>
        <a href="{{ route('investor-holdings.download-template') }}" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(34, 197, 94, 0.3)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">
            📥 Download Template
        </a>
        <button type="button" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white; padding: 12px 24px; border-radius: 8px; border: none; font-weight: 500; cursor: pointer; transition: all 0.3s ease;" onclick="showImportModal()" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(6, 182, 212, 0.3)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">
            📤 Import Excel/CSV
        </button>
    </div>
</div>
<!-- Filter Section -->
<div class="filter-section" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; padding: 20px; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e2e8f0;">
    <div>
        <label for="fund_code_filter" style="display: block; margin-bottom: 8px; font-weight: 500; color: #374151;">Fund Code</label>
        <select id="fund_code_filter" style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 14px; transition: border-color 0.3s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#e5e7eb'">
            <option value="">Semua Fund Code</option>
            @foreach($fundCodes as $code)
                <option value="{{ $code }}" {{ request('fund_code') == $code ? 'selected' : '' }}>{{ $code }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="transaction_type_filter" style="display: block; margin-bottom: 8px; font-weight: 500; color: #374151;">Transaction Type</label>
        <select id="transaction_type_filter" style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 14px; transition: border-color 0.3s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#e5e7eb'">
            <option value="">Semua Jenis</option>
            @foreach($transactionTypes as $type)
                <option value="{{ $type }}" {{ request('transaction_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="search" style="display: block; margin-bottom: 8px; font-weight: 500; color: #374151;">Cari</label>
        <input type="text" id="search" style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 14px; transition: border-color 0.3s ease;" placeholder="Cari fund name atau user..." value="{{ request('search') }}" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#e5e7eb'">
    </div>
    <div style="display: flex; align-items: end;">
        <button type="button" id="filterBtn" style="width: 100%; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; padding: 12px 24px; border-radius: 8px; border: none; font-weight: 500; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(59, 130, 246, 0.3)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">
            🔍 Filter
        </button>
    </div>
</div>

<!-- Table -->
<div class="table-container" style="background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e2e8f0; overflow: hidden; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 1200px;">
            <thead style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%);">
                <tr>
                    <th style="padding: 16px; color: white; font-weight: 600; text-align: left; border-bottom: 2px solid #475569; min-width: 60px;">#</th>
                    <th style="padding: 16px; color: white; font-weight: 600; text-align: left; border-bottom: 2px solid #475569; min-width: 150px;">User</th>
                    <th style="padding: 16px; color: white; font-weight: 600; text-align: left; border-bottom: 2px solid #475569; min-width: 200px;">Fund Name</th>
                    <th style="padding: 16px; color: white; font-weight: 600; text-align: left; border-bottom: 2px solid #475569; min-width: 120px;">Fund Code</th>
                    <th style="padding: 16px; color: white; font-weight: 600; text-align: left; border-bottom: 2px solid #475569; min-width: 130px;">Transaction Date</th>
                    <th style="padding: 16px; color: white; font-weight: 600; text-align: left; border-bottom: 2px solid #475569; min-width: 80px;">Type</th>
                    <th style="padding: 16px; color: white; font-weight: 600; text-align: left; border-bottom: 2px solid #475569; min-width: 140px;">Total Investment</th>
                    <th style="padding: 16px; color: white; font-weight: 600; text-align: left; border-bottom: 2px solid #475569; min-width: 100px;">NAV</th>
                    <th style="padding: 16px; color: white; font-weight: 600; text-align: left; border-bottom: 2px solid #475569; min-width: 130px;">Current Value</th>
                    <th style="padding: 16px; color: white; font-weight: 600; text-align: left; border-bottom: 2px solid #475569; min-width: 150px;">Unrealized P&L</th>
                    <th style="padding: 16px; color: white; font-weight: 600; text-align: left; border-bottom: 2px solid #475569; min-width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($holdings as $holding)
                <tr style="border-bottom: 1px solid #e5e7eb; transition: background-color 0.2s ease;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor=''">
                    <td style="padding: 16px; color: #374151;">{{ $loop->iteration + ($holdings->currentPage() - 1) * $holdings->perPage() }}</td>
                    <td style="padding: 16px; color: #374151; font-weight: 500;">{{ $holding->user->name ?? 'N/A' }}</td>
                    <td style="padding: 16px; color: #374151;">{{ $holding->fund_name }}</td>
                    <td style="padding: 16px;"><span style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">{{ $holding->fund_code }}</span></td>
                    <td style="padding: 16px; color: #374151;">{{ $holding->transaction_date->format('d/m/Y') }}</td>
                    <td style="padding: 16px;">
                        <span style="background: linear-gradient(135deg, {{ $holding->transaction_type == 'SA' ? '#22c55e 0%, #16a34a 100%' : ($holding->transaction_type == 'RD' ? '#ef4444 0%, #dc2626 100%' : '#f59e0b 0%, #d97706 100%') }}); color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                            {{ $holding->transaction_type }}
                        </span>
                    </td>
                    <td style="padding: 16px; color: #374151; font-weight: 500;">RM {{ number_format($holding->total_investment, 2) }}</td>
                    <td style="padding: 16px; color: #374151;">{{ number_format($holding->nav, 4) }}</td>
                    <td style="padding: 16px; color: #374151; font-weight: 500;">RM {{ number_format($holding->current_value, 2) }}</td>
                    <td style="padding: 16px;">
                        <span style="color: {{ $holding->unrealized_pl_myr >= 0 ? '#22c55e' : '#ef4444' }}; font-weight: 600;">
                            RM {{ number_format($holding->unrealized_pl_myr, 2) }}
                            ({{ number_format($holding->unrealized_pl_percentage, 2) }}%)
                        </span>
                    </td>
                    <td style="padding: 16px;">
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('investor-holdings.show', $holding) }}" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white; padding: 8px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; transition: all 0.3s ease;" title="View" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(6, 182, 212, 0.3)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">👁️</a>
                            <a href="{{ route('investor-holdings.edit', $holding) }}" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 8px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; transition: all 0.3s ease;" title="Edit" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(245, 158, 11, 0.3)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">✏️</a>
                            <form action="{{ route('investor-holdings.destroy', $holding) }}" method="POST" style="display: inline;" onsubmit="return confirm('Adakah anda pasti untuk menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; padding: 8px 12px; border-radius: 6px; border: none; cursor: pointer; font-size: 12px; transition: all 0.3s ease;" title="Delete" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(239, 68, 68, 0.3)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" style="padding: 60px 20px; text-align: center; color: #6b7280;">
                        <div style="font-size: 48px; margin-bottom: 20px;">📦</div>
                        <p style="font-size: 18px; margin-bottom: 20px; color: #6b7280;">Tiada data investor holdings dijumpai.</p>
                        <a href="{{ route('investor-holdings.create') }}" class="btn btn-primary">Tambah Data Pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
@if($holdings->hasPages())
<div style="display: flex; justify-content: center; margin-top: 30px;">
    <div style="background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e2e8f0; padding: 20px;">
        {{ $holdings->appends(request()->query())->links() }}
    </div>
</div>
@endif

<!-- Import Modal -->
<div id="importModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center;" onclick="if(event.target === this) this.style.display='none'">
    <div class="modal-content" style="background: white; border-radius: 12px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto;">
        <form action="{{ route('investor-holdings.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="padding: 24px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; font-size: 20px; font-weight: 600; color: #1e293b;">Import Excel/CSV</h3>
                <button type="button" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #6b7280; padding: 0; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: all 0.2s ease;" onclick="document.getElementById('importModal').style.display='none'" onmouseover="this.style.backgroundColor='#f3f4f6'" onmouseout="this.style.backgroundColor='transparent'">&times;</button>
            </div>
            <div style="padding: 24px;">
                <div style="margin-bottom: 20px;">
                    <label for="file" style="display: block; margin-bottom: 8px; font-weight: 500; color: #374151;">Pilih File Excel/CSV</label>
                    <input type="file" id="file" name="file" accept=".xlsx,.xls,.csv" required style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 14px; transition: border-color 0.3s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#e5e7eb'">
                    <div style="margin-top: 8px; font-size: 12px; color: #6b7280;">
                        Format yang disokong: .xlsx, .xls, .csv<br>
                        <a href="{{ route('investor-holdings.download-template') }}" target="_blank" style="color: #3b82f6; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Download template di sini</a>
                    </div>
                </div>
                <div style="margin-bottom: 20px;">
                    <label for="user_id" style="display: block; margin-bottom: 8px; font-weight: 500; color: #374151;">Assign ke User (Opsional)</label>
                    <select id="user_id" name="user_id" style="width: 100%; padding: 12px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 14px; transition: border-color 0.3s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#e5e7eb'">
                        <option value="">Gunakan user default</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="padding: 20px 24px; border-top: 1px solid #e5e7eb; display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" style="background: #f3f4f6; color: #374151; padding: 12px 24px; border-radius: 8px; border: none; font-weight: 500; cursor: pointer; transition: all 0.3s ease;" onclick="document.getElementById('importModal').style.display='none'" onmouseover="this.style.backgroundColor='#e5e7eb'" onmouseout="this.style.backgroundColor='#f3f4f6'">Batal</button>
                <button type="submit" onclick="return validateImportForm()" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; padding: 12px 24px; border-radius: 8px; border: none; font-weight: 500; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.3)'">
                    📤 Import
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<style>
/* Responsive Table Styles */
@media (max-width: 1024px) {
    .page-header {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .page-header .button-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .filter-section {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 768px) {
    .page-header h2 {
        font-size: 24px;
        text-align: center;
    }
    
    .filter-section {
        grid-template-columns: 1fr;
    }
    
    .table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .table-container table {
        min-width: 800px;
    }
    
    /* Hide less important columns on mobile */
    .table-container th:nth-child(5),
    .table-container td:nth-child(5),
    .table-container th:nth-child(8),
    .table-container td:nth-child(8),
    .table-container th:nth-child(9),
    .table-container td:nth-child(9) {
        display: none;
    }
}

@media (max-width: 480px) {
    .page-header .button-group {
        flex-direction: column;
    }
    
    .page-header .button-group a,
    .page-header .button-group button {
        text-align: center;
        justify-content: center;
    }
    
    /* Show only essential columns on very small screens */
    .table-container th:nth-child(7),
    .table-container td:nth-child(7),
    .table-container th:nth-child(10),
    .table-container td:nth-child(10) {
        display: none;
    }
    
    .modal-content {
        margin: 10px;
        max-width: calc(100% - 20px);
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Filter functionality
    $('#filterBtn').click(function() {
        var url = new URL(window.location.href);
        var params = new URLSearchParams(url.search);
        
        // Update parameters
        var fundCode = $('#fund_code_filter').val();
        var transactionType = $('#transaction_type_filter').val();
        var search = $('#search').val();
        
        if (fundCode) {
            params.set('fund_code', fundCode);
        } else {
            params.delete('fund_code');
        }
        
        if (transactionType) {
            params.set('transaction_type', transactionType);
        } else {
            params.delete('transaction_type');
        }
        
        if (search) {
            params.set('search', search);
        } else {
            params.delete('search');
        }
        
        // Reset to first page
        params.delete('page');
        
        // Redirect with new parameters
        url.search = params.toString();
        window.location.href = url.toString();
    });
    
    // Enter key support for search
    $('#search').keypress(function(e) {
        if (e.which == 13) {
            $('#filterBtn').click();
        }
    });
    
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s ease';
            setTimeout(function() {
                alert.style.display = 'none';
            }, 500);
        });
    }, 5000);
    
    // Close modal when clicking outside
    const importModal = document.getElementById('importModal');
    if (importModal) {
        importModal.addEventListener('click', function(e) {
            if (e.target === this) {
                hideImportModal();
            }
        });
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideImportModal();
        }
    });
});

// Confirm delete
function confirmDelete(id) {
    if (confirm('Adakah anda pasti untuk memadam data ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}

// Show import modal
function showImportModal() {
    const modal = document.getElementById('importModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

// Hide import modal
function hideImportModal() {
    const modal = document.getElementById('importModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Validate import form
function validateImportForm() {
    const fileInput = document.getElementById('file');
    
    if (!fileInput.files || fileInput.files.length === 0) {
        alert('Sila pilih file untuk import!');
        fileInput.focus();
        return false;
    }
    
    const file = fileInput.files[0];
    const allowedExtensions = ['.xlsx', '.xls', '.csv'];
    const fileName = file.name.toLowerCase();
    const isValidExtension = allowedExtensions.some(ext => fileName.endsWith(ext));
    
    if (!isValidExtension) {
        alert('Format file tidak sah! Sila pilih file dengan format .xlsx, .xls, atau .csv');
        fileInput.focus();
        return false;
    }
    
    // Check file size (max 10MB)
    const maxSize = 10 * 1024 * 1024; // 10MB in bytes
    if (file.size > maxSize) {
        alert('Saiz file terlalu besar! Maksimum 10MB dibenarkan.');
        fileInput.focus();
        return false;
    }
    
    return true;
}
</script>
@endpush