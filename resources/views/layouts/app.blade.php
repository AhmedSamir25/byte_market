<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Byte Market') }} - @yield('title', 'سوق البايت')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cairo:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Basic RTL styles */
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                direction: rtl;
                text-align: right;
                line-height: 1.6;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            .card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: 20px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.18);
                overflow: hidden;
                transition: all 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
            }

            .btn {
                display: inline-block;
                padding: 12px 30px;
                border: none;
                border-radius: 25px;
                font-size: 16px;
                font-weight: 600;
                text-decoration: none;
                text-align: center;
                cursor: pointer;
                transition: all 0.3s ease;
                outline: none;
            }

            .btn-primary {
                background: linear-gradient(45deg, #667eea, #764ba2);
                color: white;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            }

            .btn-secondary {
                background: transparent;
                color: #667eea;
                border: 2px solid #667eea;
            }

            .btn-secondary:hover {
                background: #667eea;
                color: white;
            }

            .form-control {
                width: 100%;
                padding: 15px 20px;
                border: 2px solid rgba(102, 126, 234, 0.1);
                border-radius: 15px;
                font-size: 16px;
                background: rgba(255, 255, 255, 0.9);
                transition: all 0.3s ease;
                outline: none;
            }

            .form-control:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }

            .form-group {
                margin-bottom: 25px;
            }

            .form-group label {
                display: block;
                margin-bottom: 8px;
                font-weight: 600;
                color: #333;
            }

            .text-center {
                text-align: center;
            }

            .text-danger {
                color: #e74c3c;
                font-size: 14px;
                margin-top: 5px;
            }

            .alert {
                padding: 15px 20px;
                border-radius: 15px;
                margin-bottom: 20px;
                border: none;
            }

            .alert-danger {
                background: rgba(231, 76, 60, 0.1);
                color: #e74c3c;
                border-left: 4px solid #e74c3c;
            }

            .alert-success {
                background: rgba(46, 204, 113, 0.1);
                color: #27ae60;
                border-left: 4px solid #27ae60;
            }

            .mt-4 { margin-top: 1.5rem; }
            .mb-4 { margin-bottom: 1.5rem; }
            .p-4 { padding: 1.5rem; }
            .p-6 { padding: 2rem; }

            .flex {
                display: flex;
            }

            .items-center {
                align-items: center;
            }

            .justify-center {
                justify-content: center;
            }

            .min-h-screen {
                min-height: 100vh;
            }

            .w-full {
                width: 100%;
            }

            .max-w-md {
                max-width: 28rem;
            }

            .mx-auto {
                margin-left: auto;
                margin-right: auto;
            }

            h1, h2, h3, h4, h5, h6 {
                color: #2c3e50;
                margin-bottom: 1rem;
            }

            h1 {
                font-size: 2.5rem;
                font-weight: 700;
            }

            h2 {
                font-size: 2rem;
                font-weight: 600;
            }

            .link {
                color: #667eea;
                text-decoration: none;
                font-weight: 500;
                transition: color 0.3s ease;
            }

            .link:hover {
                color: #764ba2;
                text-decoration: underline;
            }

            @media (max-width: 768px) {
                .container {
                    padding: 0 15px;
                }

                .card {
                    margin: 20px 10px;
                    border-radius: 15px;
                }

                h1 {
                    font-size: 2rem;
                }

                h2 {
                    font-size: 1.5rem;
                }
            }
        </style>
    @endif

    @stack('styles')
</head>
<body>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="container">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
