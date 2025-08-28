@extends('template-induk2')

@section('title', 'Detail Investor Holding')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row mb-3">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('investor-holdings.index') }}">Investor Holdings</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Detail Investor Holding</h3>
                    <div class="card-tools">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('investor-holdings.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <a href="{{ route('investor-holdings.edit', $investor_holding) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- User Information -->
                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fas fa-user"></i> Maklumat User</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-bold">Nama:</td>
                                            <td>{{ $investor_holding->user->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Email:</td>
                                            <td>{{ $investor_holding->user->email ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">User ID:</td>
                                            <td><span class="badge bg-info">{{ $investor_holding->user_id }}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Fund Information -->
                        <div class="col-md-6">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0"><i class="fas fa-chart-line"></i> Maklumat Fund</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-bold">Fund Name:</td>
                                            <td>{{ $investor_holding->fund_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Fund Code:</td>
                                            <td><span class="badge bg-success">{{ $investor_holding->fund_code }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">NAV:</td>
                                            <td>{{ number_format($investor_holding->nav, 4) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Transaction Information -->
                        <div class="col-md-6">
                            <div class="card border-warning">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="fas fa-exchange-alt"></i> Maklumat Transaksi</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-bold">Tarikh Transaksi:</td>
                                            <td>{{ $investor_holding->transaction_date->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Jenis Transaksi:</td>
                                            <td>
                                                <span class="badge bg-{{ $investor_holding->transaction_type == 'SA' ? 'success' : ($investor_holding->transaction_type == 'RD' ? 'danger' : 'warning') }}">
                                                    {{ $investor_holding->transaction_type }} - 
                                                    @switch($investor_holding->transaction_type)
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
                                                            {{ $investor_holding->transaction_type }}
                                                    @endswitch
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Dibuat pada:</td>
                                            <td>{{ $investor_holding->created_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Dikemaskini:</td>
                                            <td>{{ $investor_holding->updated_at->format('d/m/Y H:i:s') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Financial Information -->
                        <div class="col-md-6">
                            <div class="card border-info">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0"><i class="fas fa-money-bill-wave"></i> Maklumat Kewangan</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-bold">Jumlah Pelaburan:</td>
                                            <td class="text-primary fw-bold">RM {{ number_format($investor_holding->total_investment, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Nilai Semasa:</td>
                                            <td class="text-info fw-bold">RM {{ number_format($investor_holding->current_value, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Untung/Rugi (RM):</td>
                                            <td class="{{ $investor_holding->unrealized_pl_myr >= 0 ? 'text-success' : 'text-danger' }} fw-bold">
                                RM {{ number_format($investor_holding->unrealized_pl_myr, 2) }}
                                @if($investor_holding->unrealized_pl_myr >= 0)
                                                    <i class="fas fa-arrow-up"></i>
                                                @else
                                                    <i class="fas fa-arrow-down"></i>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Untung/Rugi (%):</td>
                                            <td class="{{ $investor_holding->unrealized_pl_percentage >= 0 ? 'text-success' : 'text-danger' }} fw-bold">
                                {{ number_format($investor_holding->unrealized_pl_percentage, 2) }}%
                                @if($investor_holding->unrealized_pl_percentage >= 0)
                                                    <i class="fas fa-arrow-up"></i>
                                                @else
                                                    <i class="fas fa-arrow-down"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Chart -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Prestasi Pelaburan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-md-3">
                                            <div class="border rounded p-3">
                                                <h6 class="text-muted">Pelaburan Awal</h6>
                                                <h4 class="text-primary">RM {{ number_format($investor_holding->total_investment, 2) }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="border rounded p-3">
                                                <h6 class="text-muted">Nilai Semasa</h6>
                                                <h4 class="text-info">RM {{ number_format($investor_holding->current_value, 2) }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="border rounded p-3">
                                                <h6 class="text-muted">Untung/Rugi</h6>
                                                <h4 class="{{ $investor_holding->unrealized_pl_myr >= 0 ? 'text-success' : 'text-danger' }}">
                                    RM {{ number_format($investor_holding->unrealized_pl_myr, 2) }}
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="border rounded p-3">
                                                <h6 class="text-muted">Peratus Pulangan</h6>
                                                <h4 class="{{ $investor_holding->unrealized_pl_percentage >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($investor_holding->unrealized_pl_percentage, 2) }}%
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Simple Progress Bar for Performance -->
                                    <div class="mt-4">
                                        <h6>Prestasi Pelaburan:</h6>
                                        @php
                                            $performancePercentage = abs($investor_holding->unrealized_pl_percentage);
                            $maxPercentage = 100; // You can adjust this based on your needs
                            $progressWidth = min(($performancePercentage / $maxPercentage) * 100, 100);
                            $progressClass = $investor_holding->unrealized_pl_percentage >= 0 ? 'bg-success' : 'bg-danger';
                                        @endphp
                                        <div class="progress" style="height: 25px;">
                                            <div class="progress-bar {{ $progressClass }}" role="progressbar" 
                                                 style="width: {{ $progressWidth }}%" 
                                                 aria-valuenow="{{ $performancePercentage }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="{{ $maxPercentage }}">
                                                {{ number_format($investor_holding->unrealized_pl_percentage, 2) }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('investor-holdings.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-list"></i> Senarai Holdings
                                </a>
                                <a href="{{ route('investor-holdings.edit', $investor_holding) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('investor-holdings.destroy', $investor_holding) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Adakah anda pasti untuk menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection