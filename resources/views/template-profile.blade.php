@extends('template-induk')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Profile Header -->
            <div class="d-flex align-items-center mb-4">
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                    <i class="bi bi-person-fill text-white fs-4"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">Update Profile</h4>
                    <p class="text-muted mb-0">Manage your personal information and account settings</p>
                </div>
            </div>

            <form method="POST" action="" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <!-- Personal Information Section -->
                <div class="mb-4">
                    <h6 class="text-primary fw-bold mb-3">
                        <i class="bi bi-person-badge me-2"></i>Personal Information
                    </h6>
                    
                    <div class="row g-3">
                        <!-- Name Field -->
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">
                                <i class="bi bi-person me-1"></i>Full Name
                            </label>
                            <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name', auth()->user()->name ?? '') }}" 
                                   required autocomplete="name" placeholder="Enter your full name">
                            @error('name')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold">
                                <i class="bi bi-telephone me-1"></i>Phone Number
                            </label>
                            <input id="phone" type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                   name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" 
                                   required autocomplete="tel" placeholder="Enter your phone number">
                            @error('phone')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="col-12">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope me-1"></i>Email Address
                            </label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email', auth()->user()->email ?? '') }}" 
                                   required autocomplete="email" placeholder="Enter your email address">
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Security Section -->
                <div class="mb-4">
                    <h6 class="text-primary fw-bold mb-3">
                        <i class="bi bi-shield-lock me-2"></i>Security Settings
                    </h6>
                    
                    <div class="alert alert-info d-flex align-items-center mb-3">
                        <i class="bi bi-info-circle me-2"></i>
                        <small>Leave password fields blank if you don't want to change your current password</small>
                    </div>

                    <div class="row g-3">
                        <!-- New Password -->
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold">
                                <i class="bi bi-lock me-1"></i>New Password
                            </label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       name="password" autocomplete="new-password" placeholder="Enter new password">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                    <i class="bi bi-eye" id="password-icon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6">
                            <label for="password-confirm" class="form-label fw-semibold">
                                <i class="bi bi-lock-fill me-1"></i>Confirm Password
                            </label>
                            <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control form-control-lg" 
                                       name="password_confirmation" autocomplete="new-password" placeholder="Confirm new password">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password-confirm')">
                                    <i class="bi bi-eye" id="password-confirm-icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-3 justify-content-end">
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4" onclick="window.history.back()">
                        <i class="bi bi-arrow-left me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="bi bi-check-circle me-2"></i>Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        field.type = 'password';
        icon.className = 'bi bi-eye';
    }
}

// Bootstrap form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
@endsection
