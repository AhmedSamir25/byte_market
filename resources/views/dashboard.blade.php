@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    <!-- Header -->
    <div class="card mb-6">
        <div class="p-6">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Hello, {{ Auth::user()->name ?? 'User' }}!</h1>
                    <p style="color: #666;">Welcome to your BitSok dashboard</p>
                </div>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <span style="color: #666; font-size: 14px;">{{ date('Y/m/d') }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn btn-secondary" style="padding: 8px 20px; font-size: 14px;">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <!-- Total Products -->
        <div class="card">
            <div class="p-6">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h3 style="color: #667eea; font-size: 2rem; font-weight: bold; margin-bottom: 5px;">0</h3>
                        <p style="color: #666; font-size: 14px;">Total Products</p>
                    </div>
                    <div style="width: 50px; height: 50px; background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                            <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V19H17V6H7Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="card">
            <div class="p-6">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h3 style="color: #27ae60; font-size: 2rem; font-weight: bold; margin-bottom: 5px;">0</h3>
                        <p style="color: #666; font-size: 14px;">Total Orders</p>
                    </div>
                    <div style="width: 50px; height: 50px; background: linear-gradient(45deg, #27ae60, #2ecc71); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                            <path d="M7 18C5.9 18 5 18.9 5 20S5.9 22 7 22 9 21.1 9 20 8.1 18 7 18ZM1 2V4H3L6.6 11.59L5.24 14.04C5.09 14.32 5 14.65 5 15C5 16.1 5.9 17 7 17H19V15H7.42C7.28 15 7.17 14.89 7.17 14.75L7.2 14.63L8.1 13H15.55C16.3 13 16.96 12.58 17.3 11.97L20.88 5H5.21L4.27 3H1ZM17 18C15.9 18 15 18.9 15 20S15.9 22 17 22 19 21.1 19 20 18.1 18 17 18Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="card">
            <div class="p-6">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h3 style="color: #f39c12; font-size: 2rem; font-weight: bold; margin-bottom: 5px;">0 SAR</h3>
                        <p style="color: #666; font-size: 14px;">Total Sales</p>
                    </div>
                    <div style="width: 50px; height: 50px; background: linear-gradient(45deg, #f39c12, #e67e22); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                            <path d="M11.8 10.9C9.53 10.31 8.8 9.7 8.8 8.75C8.8 7.66 9.81 6.9 11.5 6.9C13.28 6.9 13.94 7.75 14 9H16.21C16.14 7.28 15.09 5.7 13 5.19V3H10V5.16C8.06 5.58 6.5 6.84 6.5 8.77C6.5 11.08 8.41 12.23 11.2 12.9C13.7 13.5 14.2 14.38 14.2 15.31C14.2 16 13.71 17.1 11.5 17.1C9.44 17.1 8.63 16.18 8.52 15H6.32C6.44 17.19 8.08 18.42 10 18.83V21H13V18.85C14.95 18.5 16.5 17.35 16.5 15.3C16.5 12.46 14.07 11.5 11.8 10.9Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card mb-6">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <a href="#" class="btn btn-primary" style="padding: 15px; text-align: center; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                    </svg>
                    Add New Product
                </a>
                <a href="#" class="btn btn-secondary" style="padding: 15px; text-align: center; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 6L18.29 8.29L13.41 13.17L9.41 9.17L2 16.59L3.41 18L9.41 12L13.41 16L20.29 9.12L22 10.83V6H16Z"/>
                    </svg>
                    View Reports
                </a>
                <a href="#" class="btn btn-secondary" style="padding: 15px; text-align: center; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM13 17H11V15H13V17ZM13 13H11V7H13V13Z"/>
                    </svg>
                    Account Management
                </a>
                <a href="#" class="btn btn-secondary" style="padding: 15px; text-align: center; display: flex; align-items: center; justify-content: center; gap: 10px;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z"/>
                    </svg>
                    Messages
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
        <!-- Activities List -->
        <div class="card">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-4">Recent Activities</h2>
                <div style="space-y: 15px;">
                    <!-- No activities yet -->
                    <div style="text-align: center; padding: 40px 20px; color: #666;">
                        <svg width="64" height="64" fill="currentColor" viewBox="0 0 24 24" style="margin: 0 auto 20px; opacity: 0.3;">
                            <path d="M12 2L2 7L12 12L22 7L12 2ZM2 17L12 22L22 17M2 12L12 17L22 12"/>
                        </svg>
                        <p>No activities yet</p>
                        <p style="font-size: 14px; margin-top: 10px;">Start by adding your first products!</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="card">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-4">Account Information</h2>
                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="width: 80px; height: 80px; background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white; font-weight: bold;">
                        {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    <h3 style="font-weight: bold; margin-bottom: 5px;">{{ Auth::user()->name ?? 'User' }}</h3>
                    <p style="color: #666; font-size: 14px;">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                </div>

                <div style="border-top: 1px solid rgba(0,0,0,0.1); padding-top: 20px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span style="color: #666;">Registration Date:</span>
                        <span style="font-weight: 500;">{{ Auth::user()->created_at ? Auth::user()->created_at->format('Y/m/d') : date('Y/m/d') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                        <span style="color: #666;">Account Type:</span>
                        <span style="color: #667eea; font-weight: 500;">Standard</span>
                    </div>
                </div>

                <a href="#" class="btn btn-secondary w-full" style="font-size: 14px;">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Dashboard specific styles */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    /* Hover effects for stats cards */
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    /* Quick actions hover effects */
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    /* Animation for dashboard elements */
    .card {
        animation: fadeInUp 0.5s ease-out;
    }

    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }
    .card:nth-child(3) { animation-delay: 0.3s; }
    .card:nth-child(4) { animation-delay: 0.4s; }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        div[style*="display: grid; grid-template-columns: 2fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }

    @media (max-width: 480px) {
        .p-6 {
            padding: 1rem;
        }

        h1 {
            font-size: 1.5rem;
        }

        h2 {
            font-size: 1.2rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add some interactivity to the dashboard

    // Animate numbers (if you have real data later)
    const statsNumbers = document.querySelectorAll('[style*="font-size: 2rem"]');
    statsNumbers.forEach(num => {
        num.style.transition = 'transform 0.3s ease';
        num.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
        });
        num.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Add click effects to quick action buttons
    const quickActionBtns = document.querySelectorAll('.btn');
    quickActionBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 300);
        });
    });

    // Auto-refresh dashboard data (placeholder)
    // setInterval(() => {
    //     console.log('Refreshing dashboard data...');
    //     // Add your data refresh logic here
    // }, 30000); // Every 30 seconds
});
</script>
@endpush
@endsection
