@extends('template-induk2')

@section('title', 'Edit Investor Holding')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row mb-3">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('investor-holdings.index') }}">Investor Holdings</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Edit Investor Holding</h3>
                    <div class="card-tools">
                        <a href="{{ route('investor-holdings.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('investor-holdings.update', $investor_holding) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                                    <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                        <option value="">Pilih User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ (old('user_id') ?? $investor_holding->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fund_code" class="form-label">Fund Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('fund_code') is-invalid @enderror" 
                                           id="fund_code" name="fund_code" value="{{ old('fund_code') ?? $investor_holding->fund_code }}" 
                                           placeholder="Contoh: PM1, PM2" required>
                                    @error('fund_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="fund_name" class="form-label">Fund Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('fund_name') is-invalid @enderror" 
                                           id="fund_name" name="fund_name" value="{{ old('fund_name') ?? $investor_holding->fund_name }}" 
                                           placeholder="Nama penuh dana/fund" required>
                                    @error('fund_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="transaction_date" class="form-label">Transaction Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('transaction_date') is-invalid @enderror" 
                                           id="transaction_date" name="transaction_date" 
                                           value="{{ old('transaction_date') ?? $investor_holding->transaction_date->format('Y-m-d') }}" required>
                                    @error('transaction_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="transaction_type" class="form-label">Transaction Type <span class="text-danger">*</span></label>
                                    <select class="form-select @error('transaction_type') is-invalid @enderror" 
                                            id="transaction_type" name="transaction_type" required>
                                        <option value="">Pilih Jenis Transaksi</option>
                                        @foreach($transactionTypes as $type)
                                            <option value="{{ $type }}" {{ (old('transaction_type') ?? $investor_holding->transaction_type) == $type ? 'selected' : '' }}>
                                                {{ $type }} - 
                                                @switch($type)
                                                    @case('SA')
                                                        Subscription
                                                        @break
                                                    @case('SW')
                                                        Switch
                                                        @break
                                                    @case('RD')
                                                        Redemption
                                                        @break
                                                    @case('DV')
                                                        Dividend
                                                        @break
                                                    @default
                                                        {{ $type }}
                                                @endswitch
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('transaction_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="total_investment" class="form-label">Total Investment (RM) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0" 
                                           class="form-control @error('total_investment') is-invalid @enderror" 
                                           id="total_investment" name="total_investment" 
                                           value="{{ old('total_investment') ?? $investor_holding->total_investment }}" 
                                           placeholder="0.00" required>
                                    @error('total_investment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nav" class="form-label">NAV <span class="text-danger">*</span></label>
                                    <input type="number" step="0.0001" min="0" 
                                           class="form-control @error('nav') is-invalid @enderror" 
                                           id="nav" name="nav" value="{{ old('nav') ?? $investor_holding->nav }}" 
                                           placeholder="0.0000" required>
                                    @error('nav')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="current_value" class="form-label">Current Value (RM) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0" 
                                           class="form-control @error('current_value') is-invalid @enderror" 
                                           id="current_value" name="current_value" 
                                           value="{{ old('current_value') ?? $investor_holding->current_value }}" 
                                           placeholder="0.00" required>
                                    @error('current_value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unrealized_pl_myr" class="form-label">Unrealized P&L (RM)</label>
                                    <input type="number" step="0.01" 
                                           class="form-control @error('unrealized_pl_myr') is-invalid @enderror" 
                                           id="unrealized_pl_myr" name="unrealized_pl_myr" 
                                           value="{{ old('unrealized_pl_myr') ?? $investor_holding->unrealized_pl_myr }}" 
                                           placeholder="0.00">
                                    @error('unrealized_pl_myr')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="unrealized_pl_percentage" class="form-label">Unrealized P&L (%)</label>
                                    <input type="number" step="0.01" 
                                           class="form-control @error('unrealized_pl_percentage') is-invalid @enderror" 
                                           id="unrealized_pl_percentage" name="unrealized_pl_percentage" 
                                           value="{{ old('unrealized_pl_percentage') ?? $investor_holding->unrealized_pl_percentage }}" 
                                           placeholder="0.00">
                                    @error('unrealized_pl_percentage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('investor-holdings.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Auto calculate unrealized P&L when values change
    $('#total_investment, #current_value').on('input', function() {
        var totalInvestment = parseFloat($('#total_investment').val()) || 0;
        var currentValue = parseFloat($('#current_value').val()) || 0;
        
        if (totalInvestment > 0) {
            var unrealizedPL = currentValue - totalInvestment;
            var unrealizedPercentage = (unrealizedPL / totalInvestment) * 100;
            
            $('#unrealized_pl_myr').val(unrealizedPL.toFixed(2));
            $('#unrealized_pl_percentage').val(unrealizedPercentage.toFixed(2));
        }
    });
});
</script>
@endpush
@endsection