@extends('template-induk2')

@section('title', 'Test Template')
@section('subtitle', 'Testing the new template design')

@section('page-header')
@endsection

@section('page-actions')
    <a href="#" class="btn btn-primary">Tambah Data</a>
@endsection

@section('content')
    <h2>Welcome to E-Perform Dashboard</h2>
    <p>This is a test page to showcase the new template design based on the provided image.</p>
    
    <div style="margin-top: 30px;">
        <h3>Features:</h3>
        <ul style="margin-top: 15px; padding-left: 20px;">
            <li>Custom CSS design without Bootstrap</li>
            <li>Blue gradient header with industrial theme</li>
            <li>Responsive sidebar navigation</li>
            <li>Clean and modern interface</li>
            <li>Mobile-friendly design</li>
        </ul>
    </div>
    
    <div style="margin-top: 30px; padding: 20px; background: #f8fafc; border-radius: 8px; border-left: 4px solid #3b82f6;">
        <h4 style="color: #1e40af; margin-bottom: 10px;">Template Features</h4>
        <p style="color: #64748b; margin: 0;">This template includes all the menu items shown in the original design: Dashboard, User, Productivity, Utilization, Service, Import Data, and Setting.</p>
    </div>
@endsection

@push('styles')
<style>
    /* Additional custom styles for this page */
    .content-card h2 {
        color: #1e40af;
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .content-card h3 {
        color: #374151;
        margin-bottom: 10px;
        font-weight: 500;
    }
    
    .content-card h4 {
        margin: 0;
        font-size: 18px;
    }
    
    .content-card ul li {
        margin-bottom: 8px;
        color: #4b5563;
    }
</style>
@endpush

@push('scripts')
<script>
    console.log('Template-induk2 loaded successfully!');
</script>
@endpush