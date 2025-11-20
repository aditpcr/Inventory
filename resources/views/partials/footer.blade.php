<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --primary-light: #3b82f6;
        --secondary: #64748b;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --light: #f8fafc;
        --dark: #0f172a;
        --glass-bg: rgba(255, 255, 255, 0.85);
        --glass-border: rgba(255, 255, 255, 0.2);
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
        --gradient-primary: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    }
    
    /* Footer specific styles */
    .footer {
        background: var(--glass-bg);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border-top: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.05);
    }
    
    .footer-gradient {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.03) 0%, rgba(29, 78, 216, 0.03) 100%);
    }
    
    .footer-logo {
        background: var(--gradient-primary);
        box-shadow: var(--shadow-md);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .footer-logo:hover {
        transform: scale(1.05) rotate(5deg);
        box-shadow: var(--shadow-lg);
    }
    
    .role-badge {
        background: var(--gradient-primary);
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
    }
    
    .role-badge:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }
    
    .footer-text {
        color: var(--secondary);
        transition: color 0.3s ease;
    }
    
    .footer-text:hover {
        color: var(--dark);
    }
    
    .footer-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, rgba(100, 116, 139, 0.2) 50%, transparent 100%);
    }
    
    /* Animation for footer appearance */
    @keyframes slideUpFooter {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .footer-animate {
        animation: slideUpFooter 0.6s ease-out;
    }
</style>

@auth
    <footer class="footer transition-all duration-300 footer-animate">
            <div class="footer-gradient py-8 px-6 sm:px-8 lg:px-12">
                <div class="max-w-7xl mx-auto">
                    <!-- Main Footer Content -->
                    <div class="flex flex-col lg:flex-row justify-between items-center space-y-6 lg:space-y-0">
                        <!-- Logo and Brand -->
                        <div class="flex items-center space-x-4 group cursor-pointer">
                            <div class="footer-logo w-12 h-12 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-utensils text-white text-lg"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-gray-900 tracking-tight">RestaurantMS</span>
                                <span class="text-xs text-gray-500 font-medium mt-1">Management System</span>
                            </div>
                        </div>
                        
                        <!-- User Info and Copyright -->
                        <div class="flex flex-col md:flex-row items-center space-y-3 md:space-y-0 md:space-x-8">
                            <!-- User Role Badge -->
                            <div class="flex items-center space-x-3">
                                <span class="text-sm text-gray-600 font-medium">Logged in as:</span>
                                <span class="role-badge px-4 py-2 rounded-full text-white text-sm font-semibold capitalize">
                                    <i class="fas fa-user-shield mr-2"></i>
                                    {{ Auth::user()->role }}
                                </span>
                            </div>
                            
                            <!-- Copyright with decorative separator -->
                            <div class="hidden md:block h-6 w-px bg-gray-300/60"></div>
                            
                            <div class="flex items-center space-x-2">
                                <span class="footer-text text-sm font-medium">
                                    <i class="fas fa-copyright mr-1 opacity-70"></i>
                                    {{ date('Y') }} RestaurantMS
                                </span>
                                <span class="footer-text text-sm font-medium">All rights reserved</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Secondary Footer Content -->
                    <div class="footer-divider my-6"></div>
                    
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <!-- System Status -->
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                <span class="text-xs text-gray-600 font-medium">System Operational</span>
                            </div>
                            <div class="hidden sm:flex items-center space-x-4 text-xs text-gray-500">
                                <span>v2.1.0</span>
                                <span>•</span>
                                <span>Last updated: {{ now()->format('M j, Y') }}</span>
                            </div>
                        </div>
                        
                        <!-- Quick Links -->
                        <div class="flex items-center space-x-6">
                            <a href="#" class="footer-text text-xs font-medium hover:text-gray-900 transition-colors duration-200">
                                Privacy Policy
                            </a>
                            <a href="#" class="footer-text text-xs font-medium hover:text-gray-900 transition-colors duration-200">
                                Terms of Service
                            </a>
                            <a href="#" class="footer-text text-xs font-medium hover:text-gray-900 transition-colors duration-200">
                                Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    @else
        <footer class="footer footer-animate">
            <div class="footer-gradient py-8 px-6 sm:px-8 lg:px-12">
                <div class="max-w-7xl mx-auto">
                    <!-- Centered Content for Non-Authenticated Users -->
                    <div class="text-center space-y-6">
                        <!-- Logo and Brand -->
                        <div class="flex flex-col items-center space-y-4">
                            <div class="flex items-center space-x-4 group cursor-pointer">
                                <div class="footer-logo w-12 h-12 rounded-2xl flex items-center justify-center">
                                    <i class="fas fa-utensils text-white text-lg"></i>
                                </div>
                                <div class="flex flex-col text-left">
                                    <span class="text-lg font-bold text-gray-900 tracking-tight">RestaurantMS</span>
                                    <span class="text-xs text-gray-500 font-medium mt-1">Management System</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Copyright -->
                        <div class="flex flex-col items-center space-y-3">
                            <div class="footer-divider w-32 mx-auto"></div>
                            <div class="flex items-center space-x-2">
                                <span class="footer-text text-sm font-medium">
                                    <i class="fas fa-copyright mr-1 opacity-70"></i>
                                    {{ date('Y') }} RestaurantMS
                                </span>
                                <span class="footer-text text-sm font-medium">All rights reserved</span>
                            </div>
                        </div>
                        
                        <!-- Additional Info -->
                        <div class="flex flex-col sm:flex-row justify-center items-center space-y-2 sm:space-y-0 sm:space-x-6 text-xs text-gray-500">
                            <span>Enterprise Restaurant Management Solution</span>
                            <span class="hidden sm:block">•</span>
                            <span>v2.1.0</span>
                            <span class="hidden sm:block">•</span>
                            <span>Secure & Reliable</span>
                        </div>
                    </div>
                </div>
            </div>
    </footer>
@endauth

<script>
    // Footer interaction effects
    document.addEventListener('DOMContentLoaded', function() {
        const footer = document.querySelector('footer');
        
        // Add scroll-based animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });
        
        if (footer) {
            footer.style.opacity = '0';
            footer.style.transform = 'translateY(20px)';
            footer.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(footer);
        }
        
        // Add hover effects to interactive elements
        const interactiveElements = document.querySelectorAll('.footer-logo, .role-badge, .footer-text');
        interactiveElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            });
        });
    });
</script>