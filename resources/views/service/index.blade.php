@extends('template-induk2')

@section('title', 'Service Management')
@section('subtitle', 'Pilih jenis service yang ingin diuruskan')

@section('page-header')
    <!-- Header content to ensure page-actions is displayed -->
@endsection

@section('content')
<style>
    .service-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }
    
    .service-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }
    
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        text-decoration: none;
        color: inherit;
    }
    
    .service-card.primary:hover {
        border-color: #007bff;
    }
    
    .service-card.danger:hover {
        border-color: #dc3545;
    }
    
    .service-card.success:hover {
        border-color: #28a745;
    }
    
    .service-icon {
        font-size: 48px;
        margin-bottom: 20px;
        display: block;
    }
    
    .service-icon.primary {
        color: #007bff;
    }
    
    .service-icon.danger {
        color: #dc3545;
    }
    
    .service-icon.success {
        color: #28a745;
    }
    
    .service-name {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2d3748;
    }
    
    .service-description {
        font-size: 16px;
        color: #718096;
        line-height: 1.5;
        margin-bottom: 20px;
    }
    
    .service-arrow {
        font-size: 20px;
        color: #a0aec0;
        transition: all 0.3s ease;
    }
    
    .service-card:hover .service-arrow {
        transform: translateX(5px);
        color: #4a5568;
    }
    
    .page-intro {
        text-align: center;
        margin-bottom: 40px;
        padding: 30px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
    }
    
    .page-intro h2 {
        font-size: 28px;
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .page-intro p {
        font-size: 18px;
        opacity: 0.9;
        margin: 0;
    }
</style>

<div class="page-intro">
    <h2>Service Management System</h2>
    <p>Pilih kategori service yang ingin anda uruskan untuk mula memasukkan dan menguruskan data</p>
</div>

<div class="service-grid">
    @foreach($services as $service)
        <a href="{{ route($service['route']) }}" class="service-card {{ $service['color'] }}">
            <i class="{{ $service['icon'] }} service-icon {{ $service['color'] }}"></i>
            <div class="service-name">{{ $service['name'] }}</div>
            <div class="service-description">{{ $service['description'] }}</div>
            <i class="fas fa-arrow-right service-arrow"></i>
        </a>
    @endforeach
</div>

<div style="margin-top: 40px; text-align: center; padding: 20px; background: #f8f9fa; border-radius: 8px;">
    <p style="margin: 0; color: #6c757d; font-size: 14px;">
        <i class="fas fa-info-circle"></i> 
        Setiap kategori mempunyai borang input yang berbeza berdasarkan keperluan data masing-masing
    </p>
</div>
@endsection