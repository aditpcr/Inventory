<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restaurant Management System</title>
    
    <!-- Davis Design System CSS -->
    <link rel="stylesheet" href="{{ asset('css/davis-design-system.css') }}">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background: var(--primary-dark);
            background-image: 
                radial-gradient(circle at 1px 1px, rgba(255, 255, 255, 0.15) 1px, transparent 0);
            background-size: 20px 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--space-4);
        }
        
        .login-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .login-card {
            background: var(--background-card);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            display: flex;
            min-height: 600px;
        }
        
        .login-illustration {
            flex: 1;
            background: var(--accent-color);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: var(--space-8);
            color: var(--primary-dark);
            position: relative;
            overflow: hidden;
        }
        
        .illustration-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }
        
        .illustration-content h3 {
            font-weight: var(--font-weight-bold);
            margin-bottom: var(--space-4);
            font-size: var(--text-2xl);
        }
        
        .illustration-content p {
            font-size: var(--text-base);
            opacity: 0.9;
            margin-bottom: var(--space-6);
        }
        
        .illustration-img {
            width: 80%;
            max-width: 300px;
            margin: 0 auto var(--space-6);
            filter: drop-shadow(0 10px 20px rgba(0,0,0,0.2));
        }
        
        .login-form {
            flex: 1;
            padding: var(--space-10) var(--space-8);
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: var(--background-card);
        }
        
        .logo {
            text-align: center;
            margin-bottom: var(--space-6);
        }
        
        .logo h2 {
            color: var(--accent-color);
            font-weight: var(--font-weight-bold);
            margin-bottom: var(--space-1);
            font-size: var(--text-2xl);
        }
        
        .logo p {
            color: var(--text-secondary);
            font-size: var(--text-base);
        }
        
        .form-group {
            margin-bottom: var(--space-4);
            position: relative;
        }
        
        .form-label {
            font-weight: var(--font-weight-medium);
            margin-bottom: var(--space-2);
            color: var(--text-primary);
            display: block;
        }
        
        .form-control {
            padding: var(--space-3) var(--space-4);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-light);
            transition: all var(--transition-fast);
            font-size: var(--text-base);
            width: 100%;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(58, 134, 255, 0.1);
        }
        
        .input-icon {
            position: absolute;
            right: var(--space-4);
            top: 42px;
            color: var(--text-secondary);
            cursor: pointer;
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--space-4);
        }
        
        .forgot-link {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: var(--font-weight-medium);
            transition: color var(--transition-fast);
            font-size: var(--text-sm);
        }
        
        .forgot-link:hover {
            color: var(--text-primary);
        }
        
        .test-accounts {
            margin-top: var(--space-6);
            background-color: var(--background-light);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-md);
            padding: var(--space-4);
        }
        
        .test-accounts h6 {
            color: var(--text-primary);
            margin-bottom: var(--space-4);
            font-weight: var(--font-weight-medium);
            font-size: var(--text-sm);
        }
        
        .account-role {
            margin-bottom: var(--space-2);
            padding-bottom: var(--space-2);
            border-bottom: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }
        
        .account-role:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .role-badge {
            display: inline-block;
            padding: var(--space-1) var(--space-2);
            border-radius: var(--radius-base);
            font-size: var(--text-xs);
            font-weight: var(--font-weight-medium);
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
            font-size: var(--text-sm);
            color: var(--text-secondary);
            flex: 1;
        }
        
        .copy-btn {
            background: none;
            border: none;
            color: var(--accent-color);
            cursor: pointer;
            transition: color var(--transition-fast);
            padding: var(--space-1);
        }
        
        .copy-btn:hover {
            color: var(--text-primary);
        }
        
        .alert {
            border-radius: var(--radius-md);
            padding: var(--space-3) var(--space-4);
            margin-bottom: var(--space-4);
            border: 1px solid;
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            border-color: rgba(220, 53, 69, 0.3);
            color: #dc3545;
        }
        
        @media (max-width: 992px) {
            .login-card {
                flex-direction: column;
            }
            
            .login-illustration {
                padding: var(--space-6) var(--space-4);
            }
            
            .illustration-img {
                width: 60%;
                max-width: 200px;
            }
        }
        
        @media (max-width: 576px) {
            .login-container {
                padding: var(--space-2);
            }
            
            .login-form {
                padding: var(--space-6) var(--space-4);
            }
            
            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .forgot-link {
                margin-top: var(--space-2);
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
                        <rect x="180" y="110" width="40" height="80" rx="3" fill="#1a1a1a"/>
                        <circle cx="200" cy="210" r="10" fill="#fff" opacity="0.8"/>
                        <path fill="#fff" d="M120,250 L280,250 L280,260 L120,260 Z" opacity="0.6"/>
                        <path fill="#fff" d="M130,240 L270,240 L270,250 L130,250 Z" opacity="0.4"/>
                    </svg>
                    <h3>Welcome Back!</h3>
                    <p>Sign in to access your restaurant management dashboard and streamline your operations.</p>
                    <div style="margin-top: var(--space-4);">
                        <div class="flex justify-center" style="gap: var(--space-4);">
                        <div style="width: 48px; height: 48px; background: rgba(0, 0, 0, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-utensils" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                        </div>
                        <div style="width: 48px; height: 48px; background: rgba(0, 0, 0, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-chart-bar" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                        </div>
                        <div style="width: 48px; height: 48px; background: rgba(0, 0, 0, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-users" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="login-form">
                <div class="logo">
                    <h2><i class="fas fa-utensils" style="margin-right: var(--space-2);"></i>RestaurantPro</h2>
                    <p>Management System</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p style="margin: 0;"><i class="fas fa-exclamation-circle" style="margin-right: var(--space-2);"></i>{{ $error }}</p>
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
                        <div style="display: flex; align-items: center; gap: var(--space-2);">
                            <input type="checkbox" id="remember" name="remember" style="width: 16px; height: 16px; cursor: pointer;">
                            <label for="remember" style="font-size: var(--text-sm); color: var(--text-primary); cursor: pointer;">
                                Remember me
                            </label>
                        </div>
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary w-full" style="margin-bottom: var(--space-4);">
                        <i class="fas fa-sign-in-alt" style="margin-right: var(--space-2);"></i>Sign In
                    </button>
                </form>

                <div class="test-accounts">
                    <h6><i class="fas fa-vial" style="margin-right: var(--space-2);"></i>Test Accounts</h6>
                    
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
