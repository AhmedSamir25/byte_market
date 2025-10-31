@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="w-full max-w-md mx-auto" style="direction: ltr; text-align: left;">
    <div class="card">
        <div class="p-6">
            <!-- Header -->
            <div class="text-center mb-4">
                <h1 class="text-2xl font-bold mb-2">Welcome Back</h1>
                <p class="text-gray-600">Log in to access your account</p>
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

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

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
                        autofocus
                        placeholder="Enter your email"
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
                        placeholder="Enter your password"
                    />
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-group">
                    <label style="display: flex; align-items: center; font-weight: normal;">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} style="margin-right: 8px;">
                        Remember Me
                    </label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-primary w-full mb-4">
                    Login
                </button>

                <!-- Forgot Password Link -->
                <div class="text-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link">
                            Forgot your password?
                        </a>
                    @endif
                </div>
            </form>

            <!-- Register Link -->
            <div class="text-center mt-4" style="border-top: 1px solid rgba(0,0,0,0.1); padding-top: 20px;">
                <p style="color: #666; margin-bottom: 10px;">Don't have an account?</p>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-secondary w-full">
                        Create a New Account
                    </a>
                @endif
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
    /* Additional styles for login page */
    .border-red-500 {
        border-color: #e74c3c !important;
    }

    input[type="checkbox"] {
        accent-color: #667eea;
        transform: scale(1.2);
    }

    /* Floating label effect */
    .form-group {
        position: relative;
    }

    .form-control:focus + .floating-label,
    .form-control:not(:placeholder-shown) + .floating-label {
        transform: translateY(-25px) scale(0.8);
        color: #667eea;
    }

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

    /* Responsive improvements */
    @media (max-width: 480px) {
        .p-6 {
            padding: 1.5rem 1rem;
        }

        h1 {
            font-size: 1.8rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state to form submission
    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Logging in...';
    });

    // Auto-focus on first input with error
    const errorInput = document.querySelector('.border-red-500');
    if (errorInput) {
        errorInput.focus();
    }
});
</script>
@endpush
@endsection
