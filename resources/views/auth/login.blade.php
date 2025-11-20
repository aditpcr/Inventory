<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restaurant Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4a6cf7;
            --primary-dark: #3a5ae0;
            --secondary: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --gradient-start: #667eea;
            --gradient-end: #764ba2;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgZmlsbD0idXJsKCNwYXR0ZXJuKSIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIvPjwvc3ZnPg==');
            opacity: 0.3;
            z-index: -1;
        }
        
        .login-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            display: flex;
            min-height: 600px;
        }
        
        .login-illustration {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .login-illustration::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA3KSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3QgZmlsbD0idXJsKCNwYXR0ZXJuKSIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIvPjwvc3ZnPg==');
            opacity: 0.3;
            z-index: 1;
        }
        
        .illustration-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }
        
        .illustration-content h3 {
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 28px;
        }
        
        .illustration-content p {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 30px;
        }
        
        .illustration-img {
            width: 80%;
            max-width: 300px;
            margin: 0 auto 30px;
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));
        }
        
        .login-form {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo h2 {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .logo p {
            color: var(--secondary);
            font-size: 16px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
            font-size: 16px;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(74, 108, 247, 0.25);
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 42px;
            color: var(--secondary);
        }
        
        .password-toggle {
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .password-toggle:hover {
            color: var(--primary);
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .forgot-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .forgot-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(74, 108, 247, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 108, 247, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .test-accounts {
            margin-top: 30px;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
        }
        
        .test-accounts h6 {
            color: var(--dark);
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .account-role {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .account-role:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .role-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            margin-right: 8px;
        }
        
        .badge-admin {
            background-color: #dc3545;
            color: white;
        }
        
        .badge-supervisor {
            background-color: #fd7e14;
            color: white;
        }
        
        .badge-employee {
            background-color: #20c997;
            color: white;
        }
        
        .account-details {
            font-size: 14px;
            color: var(--secondary);
        }
        
        .copy-btn {
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            margin-left: 5px;
            transition: color 0.3s;
        }
        
        .copy-btn:hover {
            color: var(--primary-dark);
        }
        
        .alert {
            border-radius: 8px;
            padding: 12px 15px;
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            border-color: rgba(220, 53, 69, 0.2);
            color: var(--danger);
        }
        
        /* Responsive styles */
        @media (max-width: 992px) {
            .login-card {
                flex-direction: column;
            }
            
            .login-illustration {
                padding: 30px 20px;
            }
            
            .illustration-img {
                width: 60%;
                max-width: 200px;
            }
        }
        
        @media (max-width: 576px) {
            .login-container {
                padding: 10px;
            }
            
            .login-form {
                padding: 30px 20px;
            }
            
            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .forgot-link {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-illustration">
                <div class="illustration-content">
                    <svg class="illustration-img" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#fff" d="M200,50 C250,50 290,90 290,140 C290,190 250,230 200,230 C150,230 110,190 110,140 C110,90 150,50 200,50 Z" opacity="0.1"/>
                        <path fill="#fff" d="M200,60 C245,60 280,95 280,140 C280,185 245,220 200,220 C155,220 120,185 120,140 C120,95 155,60 200,60 Z" opacity="0.2"/>
                        <path fill="#fff" d="M200,70 C240,70 270,100 270,140 C270,180 240,210 200,210 C160,210 130,180 130,140 C130,100 160,70 200,70 Z" opacity="0.3"/>
                        <rect x="170" y="100" width="60" height="120" rx="5" fill="#fff" opacity="0.8"/>
                        <rect x="180" y="110" width="40" height="80" rx="3" fill="#4a6cf7"/>
                        <circle cx="200" cy="210" r="10" fill="#fff" opacity="0.8"/>
                        <path fill="#fff" d="M120,250 L280,250 L280,260 L120,260 Z" opacity="0.6"/>
                        <path fill="#fff" d="M130,240 L270,240 L270,250 L130,250 Z" opacity="0.4"/>
                    </svg>
                    <h3>Welcome Back!</h3>
                    <p>Sign in to access your restaurant management dashboard and streamline your operations.</p>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center">
                            <div class="mx-2">
                                <div class="bg-white rounded-circle p-3 shadow-sm d-inline-flex">
                                    <i class="fas fa-utensils text-primary fa-lg"></i>
                                </div>
                            </div>
                            <div class="mx-2">
                                <div class="bg-white rounded-circle p-3 shadow-sm d-inline-flex">
                                    <i class="fas fa-chart-bar text-primary fa-lg"></i>
                                </div>
                            </div>
                            <div class="mx-2">
                                <div class="bg-white rounded-circle p-3 shadow-sm d-inline-flex">
                                    <i class="fas fa-users text-primary fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="login-form">
                <div class="logo">
                    <h2><i class="fas fa-utensils me-2"></i>RestaurantPro</h2>
                    <p>Management System</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p class="mb-0"><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                        <i class="fas fa-envelope input-icon"></i>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                        <i class="fas fa-eye input-icon password-toggle" id="togglePassword"></i>
                    </div>

                    <div class="remember-forgot">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn btn-login w-100 mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                    </button>
                </form>

                <div class="test-accounts">
                    <h6><i class="fas fa-vial me-2"></i>Test Accounts</h6>
                    
                    <div class="account-role">
                        <span class="role-badge badge-admin">Admin</span>
                        <span class="account-details">admin@restaurant.com / password123</span>
                        <button class="copy-btn" data-email="admin@restaurant.com" data-password="password123">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    
                    <div class="account-role">
                        <span class="role-badge badge-supervisor">Supervisor</span>
                        <span class="account-details">supervisor@restaurant.com / password123</span>
                        <button class="copy-btn" data-email="supervisor@restaurant.com" data-password="password123">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                    
                    <div class="account-role">
                        <span class="role-badge badge-employee">Employee</span>
                        <span class="account-details">employee@restaurant.com / password123</span>
                        <button class="copy-btn" data-email="employee@restaurant.com" data-password="password123">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
        
        // Copy test account credentials
        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function() {
                const email = this.getAttribute('data-email');
                const password = this.getAttribute('data-password');
                
                // Copy to clipboard
                navigator.clipboard.writeText(`Email: ${email}\nPassword: ${password}`).then(() => {
                    // Show feedback
                    const originalIcon = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    
                    setTimeout(() => {
                        this.innerHTML = originalIcon;
                    }, 2000);
                });
            });
        });
        
        // Add animation to form elements on load
        document.addEventListener('DOMContentLoaded', function() {
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                group.style.opacity = '0';
                group.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    group.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    group.style.opacity = '1';
                    group.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>