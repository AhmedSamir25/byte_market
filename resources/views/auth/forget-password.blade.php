@extends('layouts.app')

@section('title', 'نسيت كلمة المرور')

@section('content')
<div class="w-full max-w-md mx-auto">
    <div class="card">
        <div class="p-6">
            <!-- Header -->
            <div class="text-center mb-4">
                <div style="width: 80px; height: 80px; background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                    <svg width="40" height="40" fill="white" viewBox="0 0 24 24">
                        <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.1 3.89 23 5 23H11V21H5V3H13V9H21Z"/>
                        <path d="M18 11C16.34 11 15 12.34 15 14S16.34 17 18 17 21 15.66 21 14 19.66 11 18 11ZM18 15.5C17.17 15.5 16.5 14.83 16.5 14S17.17 12.5 18 12.5 19.5 13.17 19.5 14 18.83 15.5 18 15.5Z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold mb-2">نسيت كلمة المرور؟</h1>
                <p class="text-gray-600">لا تقلق، سنرسل لك رابط إعادة تعيين كلمة المرور</p>
            </div>

            <!-- Display Success Message -->
            @if (session('status'))
                <div class="alert alert-success">
                    <div style="display: flex; align-items: center;">
                        <svg width="20" height="20" fill="currentColor" style="margin-left: 10px;" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <!-- Display Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <div style="display: flex; align-items: center;">
                        <svg width="20" height="20" fill="currentColor" style="margin-left: 10px;" viewBox="0 0 24 24">
                            <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                        </svg>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Instructions -->
            <div class="mb-4" style="background: rgba(102, 126, 234, 0.1); padding: 15px; border-radius: 12px; border-right: 4px solid #667eea;">
                <p style="color: #667eea; font-size: 14px; margin: 0; line-height: 1.6;">
                    أدخل عنوان بريدك الإلكتروني وسنرسل لك رابطاً لإعادة تعيين كلمة المرور الخاصة بك.
                </p>
            </div>

            <!-- Forgot Password Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <div style="position: relative;">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="form-control @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="أدخل بريدك الإلكتروني"
                            style="padding-right: 50px;"
                        />
                        <div style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #667eea;">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-full mb-4" id="submitBtn">
                    إرسال رابط إعادة التعيين
                </button>
            </form>

            <!-- Back to Login -->
            <div class="text-center">
                <a href="{{ route('login') }}" class="link" style="display: inline-flex; align-items: center;">
                    <svg width="16" height="16" fill="currentColor" style="margin-left: 5px;" viewBox="0 0 24 24">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.42-1.41L7.83 13H20v-2z"/>
                    </svg>
                    العودة لتسجيل الدخول
                </a>
            </div>

            <!-- Help Section -->
            <div class="text-center mt-4" style="border-top: 1px solid rgba(0,0,0,0.1); padding-top: 20px;">
                <p style="color: #666; margin-bottom: 10px; font-size: 14px;">تواجه مشكلة؟</p>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <a href="#" class="link" style="font-size: 14px;">اتصل بالدعم</a>
                    <a href="#" class="link" style="font-size: 14px;">مركز المساعدة</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="text-center mt-4">
        <p style="color: rgba(255,255,255,0.7); font-size: 14px;">
            © {{ date('Y') }} سوق البايت. جميع الحقوق محفوظة.
        </p>
    </div>
</div>

@push('styles')
<style>
    /* Additional styles for forgot password page */
    .border-red-500 {
        border-color: #e74c3c !important;
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

    /* Email icon animation */
    .form-control:focus + div svg {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: translateY(-50%) scale(1);
        }
        50% {
            transform: translateY(-50%) scale(1.1);
        }
        100% {
            transform: translateY(-50%) scale(1);
        }
    }

    /* Success message animation */
    .alert-success {
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive improvements */
    @media (max-width: 480px) {
        .p-6 {
            padding: 1.5rem 1rem;
        }

        h1 {
            font-size: 1.8rem;
        }

        .form-control {
            padding-right: 45px;
        }
    }

    /* Form validation styles */
    .form-control:valid {
        border-color: #27ae60;
    }

    .form-control:invalid:not(:focus):not(:placeholder-shown) {
        border-color: #e74c3c;
    }

    /* Hover effects for links */
    .link:hover {
        transform: translateX(-2px);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state to form submission
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'جاري الإرسال...';

        // Re-enable button after 5 seconds in case of network issues
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'إرسال رابط إعادة التعيين';
        }, 5000);
    });

    // Auto-focus on email input
    const emailInput = document.getElementById('email');
    emailInput.focus();

    // Email validation with live feedback
    emailInput.addEventListener('input', function() {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email && !emailRegex.test(email)) {
            this.style.borderColor = '#f39c12';
        } else if (email && emailRegex.test(email)) {
            this.style.borderColor = '#27ae60';
        } else {
            this.style.borderColor = '';
        }
    });

    // Show success message animation if present
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.animation = 'pulse 1s ease-in-out';
        }, 1000);
    }
});
</script>
@endpush
@endsection
