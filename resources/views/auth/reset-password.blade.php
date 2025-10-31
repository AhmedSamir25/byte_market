@extends('layouts.app')

@section('title', 'إعادة تعيين كلمة المرور')

@section('content')
<div class="w-full max-w-md mx-auto">
    <div class="card">
        <div class="p-6">
            <!-- Header -->
            <div class="text-center mb-4">
                <div style="width: 80px; height: 80px; background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center;">
                    <svg width="40" height="40" fill="white" viewBox="0 0 24 24">
                        <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1ZM12 7C13.1 7 14 7.9 14 9S13.1 11 12 11 10 10.1 10 9 10.9 7 12 7ZM18 11C18 15.05 15.82 18.67 12.46 20.73C12.33 20.8 12.17 20.8 12.04 20.73C8.18 18.67 6 15.05 6 11V6.3L12 3.19L18 6.3V11ZM12 15C10.9 15 10 14.1 10 13S10.9 11 12 11 14 11.9 14 13 13.1 15 12 15Z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold mb-2">إعادة تعيين كلمة المرور</h1>
                <p class="text-gray-600">أدخل كلمة مرور جديدة وقوية لحسابك</p>
            </div>

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

            <!-- Password Requirements Info -->
            <div class="mb-4" style="background: rgba(102, 126, 234, 0.1); padding: 15px; border-radius: 12px; border-right: 4px solid #667eea;">
                <h4 style="color: #667eea; font-size: 14px; font-weight: 600; margin-bottom: 8px;">متطلبات كلمة المرور:</h4>
                <ul style="color: #667eea; font-size: 12px; line-height: 1.6; margin: 0; padding-right: 15px;">
                    <li>• على الأقل 8 أحرف</li>
                    <li>• تحتوي على أحرف كبيرة وصغيرة</li>
                    <li>• تحتوي على رقم واحد على الأقل</li>
                    <li>• تحتوي على رمز خاص (!@#$%^&*)</li>
                </ul>
            </div>

            <!-- Reset Password Form -->
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ request()->route('token') }}">

                <!-- Email (Hidden) -->
                <input type="hidden" name="email" value="{{ request()->email }}">

                <!-- Display Email for Reference -->
                <div class="form-group">
                    <label style="color: #666; font-size: 14px;">البريد الإلكتروني</label>
                    <div style="padding: 12px 20px; background: rgba(102, 126, 234, 0.1); border-radius: 12px; color: #667eea; font-weight: 500;">
                        {{ request()->email }}
                    </div>
                </div>

                <!-- New Password Field -->
                <div class="form-group">
                    <label for="password">كلمة المرور الجديدة</label>
                    <div style="position: relative;">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control @error('password') border-red-500 @enderror"
                            required
                            autocomplete="new-password"
                            placeholder="أدخل كلمة مرور جديدة وقوية"
                            style="padding-left: 50px;"
                        />
                        <button
                            type="button"
                            id="togglePassword"
                            style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #667eea; cursor: pointer;"
                            onclick="togglePasswordVisibility('password', this)"
                        >
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5S21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12S9.24 7 12 7 17 9.24 17 12 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12S10.34 15 12 15 15 13.66 15 12 13.66 9 12 9Z"/>
                            </svg>
                        </button>
                    </div>
                    <!-- Password Strength Indicator -->
                    <div class="password-strength" id="passwordStrength">
                        <div class="password-strength-bar" id="passwordStrengthBar"></div>
                    </div>
                    <small id="passwordStrengthText" style="color: #666; font-size: 12px; margin-top: 5px; display: block;">
                        أدخل كلمة مرور لرؤية مدى قوتها
                    </small>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label for="password_confirmation">تأكيد كلمة المرور</label>
                    <div style="position: relative;">
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            class="form-control @error('password_confirmation') border-red-500 @enderror"
                            required
                            autocomplete="new-password"
                            placeholder="أعد إدخال كلمة المرور الجديدة"
                            style="padding-left: 50px;"
                        />
                        <button
                            type="button"
                            id="toggleConfirmPassword"
                            style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #667eea; cursor: pointer;"
                            onclick="togglePasswordVisibility('password_confirmation', this)"
                        >
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5S21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12S9.24 7 12 7 17 9.24 17 12 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12S10.34 15 12 15 15 13.66 15 12 13.66 9 12 9Z"/>
                            </svg>
                        </button>
                    </div>
                    <div id="passwordMatch" style="font-size: 12px; margin-top: 5px;"></div>
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-full mb-4" id="submitBtn">
                    إعادة تعيين كلمة المرور
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

            <!-- Security Notice -->
            <div class="text-center mt-4" style="border-top: 1px solid rgba(0,0,0,0.1); padding-top: 20px;">
                <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 10px; color: #667eea;">
                    <svg width="16" height="16" fill="currentColor" style="margin-left: 5px;" viewBox="0 0 24 24">
                        <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1ZM10 17L6 13L7.41 11.59L10 14.17L16.59 7.58L18 9L10 17Z"/>
                    </svg>
                    <span style="font-size: 12px; font-weight: 500;">اتصال آمن ومشفر</span>
                </div>
                <p style="color: #999; font-size: 11px; line-height: 1.4;">
                    جميع البيانات محمية بتشفير SSL. لن نشارك معلوماتك مع أي طرف ثالث.
                </p>
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
    /* Additional styles for reset password page */
    .border-red-500 {
        border-color: #e74c3c !important;
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
        width: 0%;
    }

    .strength-weak { background: #e74c3c; }
    .strength-fair { background: #f39c12; }
    .strength-good { background: #f1c40f; }
    .strength-strong { background: #27ae60; }

    /* Password match indicator */
    .password-match-success {
        color: #27ae60 !important;
    }

    .password-match-error {
        color: #e74c3c !important;
    }

    /* Show/Hide password button hover */
    button[id^="toggle"]:hover {
        color: #764ba2 !important;
        transform: translateY(-50%) scale(1.1);
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
        transform: none !important;
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

    /* Form validation styles */
    .form-control:valid {
        border-color: #27ae60;
    }

    .form-control:invalid:not(:focus):not(:placeholder-shown) {
        border-color: #e74c3c;
    }

    /* Requirements checklist animation */
    .requirement-met {
        color: #27ae60 !important;
        text-decoration: line-through;
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
            padding-left: 45px;
        }

        button[id^="toggle"] {
            left: 12px;
        }
    }

    /* Hover effects for better UX */
    .link:hover {
        transform: translateX(-2px);
    }

    /* Focus states */
    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        border-color: #667eea;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submitBtn');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const strengthBar = document.getElementById('passwordStrengthBar');
    const strengthText = document.getElementById('passwordStrengthText');
    const passwordMatch = document.getElementById('passwordMatch');

    // Add loading state to form submission
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'جاري إعادة التعيين...';

        // Re-enable button after 10 seconds in case of issues
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'إعادة تعيين كلمة المرور';
        }, 10000);
    });

    // Password strength checker
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = getPasswordStrength(password);

        updatePasswordStrength(strength);
        checkPasswordMatch();
    });

    // Password confirmation checker
    confirmPasswordInput.addEventListener('input', function() {
        checkPasswordMatch();
    });

    function getPasswordStrength(password) {
        let score = 0;
        let feedback = [];

        if (password.length >= 8) {
            score += 1;
        } else {
            feedback.push('8 أحرف على الأقل');
        }

        if (password.match(/[a-z]/)) {
            score += 1;
        } else {
            feedback.push('أحرف صغيرة');
        }

        if (password.match(/[A-Z]/)) {
            score += 1;
        } else {
            feedback.push('أحرف كبيرة');
        }

        if (password.match(/[0-9]/)) {
            score += 1;
        } else {
            feedback.push('رقم واحد');
        }

        if (password.match(/[^a-zA-Z0-9]/)) {
            score += 1;
        } else {
            feedback.push('رمز خاص');
        }

        let level, message, percentage;

        switch (score) {
            case 0:
            case 1:
                level = 'weak';
                message = 'ضعيفة جداً - تحتاج: ' + feedback.slice(0, 3).join(', ');
                percentage = 20;
                break;
            case 2:
                level = 'weak';
                message = 'ضعيفة - تحتاج: ' + feedback.slice(0, 2).join(', ');
                percentage = 40;
                break;
            case 3:
                level = 'fair';
                message = 'مقبولة - تحتاج: ' + feedback.join(', ');
                percentage = 60;
                break;
            case 4:
                level = 'good';
                message = 'جيدة - تحتاج: ' + feedback.join(', ');
                percentage = 80;
                break;
            case 5:
                level = 'strong';
                message = 'قوية جداً ✓';
                percentage = 100;
                break;
        }

        return { level, message, percentage };
    }

    function updatePasswordStrength(strength) {
        strengthBar.className = 'password-strength-bar strength-' + strength.level;
        strengthBar.style.width = strength.percentage + '%';
        strengthText.textContent = strength.message;
        strengthText.style.color = getStrengthColor(strength.level);
    }

    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (!confirmPassword) {
            passwordMatch.textContent = '';
            confirmPasswordInput.style.borderColor = '';
            return;
        }

        if (password === confirmPassword) {
            passwordMatch.textContent = 'كلمات المرور متطابقة ✓';
            passwordMatch.className = 'password-match-success';
            confirmPasswordInput.style.borderColor = '#27ae60';
        } else {
            passwordMatch.textContent = 'كلمات المرور غير متطابقة ✗';
            passwordMatch.className = 'password-match-error';
            confirmPasswordInput.style.borderColor = '#e74c3c';
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

    // Auto-focus on password input
    passwordInput.focus();

    // Add Enter key support for better UX
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !submitBtn.disabled) {
            form.submit();
        }
    });
});

// Toggle password visibility function
function togglePasswordVisibility(inputId, button) {
    const input = document.getElementById(inputId);
    const isPassword = input.type === 'password';

    input.type = isPassword ? 'text' : 'password';

    // Update button icon
    const icon = button.querySelector('svg');
    if (isPassword) {
        // Show "hide" icon
        icon.innerHTML = '<path d="M1.18 8.85C2.23 5.32 6.56 2 12 2C17.44 2 21.77 5.32 22.82 8.85L23 9L22.82 9.15C21.77 12.68 17.44 16 12 16C6.56 16 2.23 12.68 1.18 9.15L1 9L1.18 8.85ZM12 14C16.11 14 19.71 11.39 20.77 9C19.71 6.61 16.11 4 12 4C7.89 4 4.29 6.61 3.23 9C4.29 11.39 7.89 14 12 14ZM12 6C14.21 6 16 7.79 16 10S14.21 14 12 14 8 12.21 8 10 9.79 6 12 6ZM12 8C10.9 8 10 8.9 10 10S10.9 12 12 12 14 11.1 14 10 13.1 8 12 8Z"/><path d="M2 2L22 22L20.59 23.41L18.24 21.06C16.67 21.68 14.39 22 12 22C6.56 22 2.23 18.68 1.18 15.15L1 15L1.18 14.85C1.85 13.28 3.07 11.84 4.59 10.76L2 8.17L3.41 6.76L20.59 23.94L22 22.53L2 2.53Z"/>';
    } else {
        // Show "show" icon
        icon.innerHTML = '<path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5S21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12S9.24 7 12 7 17 9.24 17 12 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12S10.34 15 12 15 15 13.66 15 12 13.66 9 12 9Z"/>';
    }
}
</script>
@endpush
@endsection
