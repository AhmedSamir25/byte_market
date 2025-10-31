@extends('layouts.app')

@section('title', 'Create New Account')

@section('content')
<div class="w-full max-w-md mx-auto" dir="ltr" style="text-align: left;">
    <div class="card">
        <div class="p-6">
            <!-- Header -->
            <div class="text-center mb-4">
                <h1 class="text-2xl font-bold mb-2">Join Us</h1>
                <p class="text-gray-600">Create your new account in Byte Market</p>
            </div>

            <!-- Display Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Display Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        class="form-control @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        placeholder="Enter your full name"
                    />
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-control @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}"
                        required
                        placeholder="Enter your email address"
                    />
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control @error('password') border-red-500 @enderror"
                        required
                        placeholder="Enter a strong password"
                    />
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <small style="color: #666; font-size: 12px; margin-top: 5px; display: block;">
                        Must contain at least 8 characters
                    </small>
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        required
                        placeholder="Re-enter your password"
                    />
                </div>

                <!-- Terms and Conditions -->
                <div class="form-group">
                    <label style="display: flex; align-items: flex-start; font-weight: normal; line-height: 1.4;">
                        <input type="checkbox" name="terms" required style="margin-right: 8px; margin-top: 2px; flex-shrink: 0;">
                        <span>
                            I agree to the
                            <a href="#" class="link">Terms & Conditions</a>
                            and
                            <a href="#" class="link">Privacy Policy</a>
                        </span>
                    </label>
                </div>

                <!-- Newsletter Subscription -->
                <div class="form-group">
                    <label style="display: flex; align-items: center; font-weight: normal;">
                        <input type="checkbox" name="newsletter" {{ old('newsletter') ? 'checked' : '' }} style="margin-right: 8px;">
                        I want to receive newsletters and special offers
                    </label>
                </div>

                <!-- Register Button -->
                <button type="submit" class="btn btn-primary w-full mb-4">
                    Create Account
                </button>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-4" style="border-top: 1px solid rgba(0,0,0,0.1); padding-top: 20px;">
                <p style="color: #666; margin-bottom: 10px;">Already have an account?</p>
                <a href="{{ route('login') }}" class="btn btn-secondary w-full">
                    Log In
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-4">
        <p style="color: rgba(255,255,255,0.7); font-size: 14px;">
            © {{ date('Y') }} Byte Market. All rights reserved.
        </p>
    </div>
</div>

@push('styles')
<style>
    .border-red-500 {
        border-color: #e74c3c !important;
    }

    input[type="checkbox"] {
        accent-color: #667eea;
        transform: scale(1.1);
    }

    /* Password strength indicator */
    .password-strength {
        height: 4px;
        background: #e0e0e0;
        border-radius: 2px;
        margin-top: 8px;
        overflow: hidden;
    }

    .password-strength-bar {
        height: 100%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }

    .strength-weak { background: #e74c3c; width: 25%; }
    .strength-fair { background: #f39c12; width: 50%; }
    .strength-good { background: #f1c40f; width: 75%; }
    .strength-strong { background: #27ae60; width: 100%; }

    /* Animation for form appearance */
    .card {
        animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Loading state for button */
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Social buttons hover effects */
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Responsive improvements */
    @media (max-width: 480px) {
        .p-6 {
            padding: 1.5rem 1rem;
        }

        h1 {
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 20px;
        }
    }

    /* Form validation styles */
    .form-control:valid {
        border-color: #27ae60;
    }

    .form-control:invalid:not(:focus):not(:placeholder-shown) {
        border-color: #e74c3c;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Creating account...';
    });

    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');

    const strengthIndicator = document.createElement('div');
    strengthIndicator.className = 'password-strength';
    const strengthBar = document.createElement('div');
    strengthBar.className = 'password-strength-bar';
    strengthIndicator.appendChild(strengthBar);
    passwordInput.parentNode.insertBefore(strengthIndicator, passwordInput.nextSibling);

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = getPasswordStrength(password);

        strengthBar.className = 'password-strength-bar strength-' + strength.level;

        const smallText = this.parentNode.querySelector('small');
        if (smallText) {
            smallText.textContent = strength.message;
            smallText.style.color = getStrengthColor(strength.level);
        }
    });

    confirmPasswordInput.addEventListener('input', function() {
        const password = passwordInput.value;
        const confirmPassword = this.value;

        if (confirmPassword && password !== confirmPassword) {
            this.style.borderColor = '#e74c3c';
        } else if (confirmPassword) {
            this.style.borderColor = '#27ae60';
        }
    });

    const errorInput = document.querySelector('.border-red-500');
    if (errorInput) {
        errorInput.focus();
    }

    function getPasswordStrength(password) {
        let score = 0;

        if (password.length >= 8) score += 1;
        if (password.match(/[a-z]/)) score += 1;
        if (password.match(/[A-Z]/)) score += 1;
        if (password.match(/[0-9]/)) score += 1;
        if (password.match(/[^a-zA-Z0-9]/)) score += 1;

        switch (score) {
            case 0:
            case 1:
                return { level: 'weak', message: 'Weak password' };
            case 2:
                return { level: 'fair', message: 'Fair password' };
            case 3:
                return { level: 'good', message: 'Good password' };
            case 4:
            case 5:
                return { level: 'strong', message: 'Strong password' };
        }
    }

    function getStrengthColor(level) {
        switch (level) {
            case 'weak': return '#e74c3c';
            case 'fair': return '#f39c12';
            case 'good': return '#f1c40f';
            case 'strong': return '#27ae60';
            default: return '#666';
        }
    }
});
</script>
@endpush
@endsection
