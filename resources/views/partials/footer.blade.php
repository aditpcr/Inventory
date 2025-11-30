@auth
    <footer style="background: var(--background-card); border-top: 1px solid var(--border-light); padding: var(--space-8) 0; margin-top: var(--space-12);">
        <div class="container">
            <!-- Main Footer Content -->
            <div class="flex flex-col" style="gap: var(--space-6); align-items: center;">
                @if(request()->is('dashboard') || request()->is('supervisor/*') || request()->is('admin/*') || request()->is('employee/*'))
                <div class="flex flex-col" style="gap: var(--space-6); align-items: center; width: 100%;">
                    <!-- Logo and Brand -->
                    <div class="flex items-center" style="gap: var(--space-3);">
                        <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                            <i class="fas fa-utensils" style="color: var(--primary-dark); font-size: var(--text-base);"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-base font-bold text-primary">RestaurantPro</span>
                            <span class="text-xs text-secondary font-medium">Management System</span>
                        </div>
                    </div>
                    
                    <!-- User Info and Copyright -->
                    <div class="flex flex-col" style="gap: var(--space-3); align-items: center;">
                        <!-- User Role Badge -->
                        <div class="flex items-center" style="gap: var(--space-2);">
                            <span class="text-xs text-secondary">Logged in as:</span>
                            <span class="badge badge-info" style="text-transform: capitalize; font-size: var(--text-xs);">
                                <i class="fas fa-user-shield" style="margin-right: var(--space-1);"></i>
                                {{ Auth::user()->role }}
                            </span>
                        </div>
                        
                        <!-- Copyright -->
                        <div class="flex items-center" style="gap: var(--space-2); flex-wrap: wrap; justify-content: center;">
                            <span class="text-xs text-secondary">
                                <i class="fas fa-copyright" style="margin-right: var(--space-1); opacity: 0.6;"></i>
                                {{ date('Y') }} RestaurantPro
                            </span>
                            <span class="text-xs text-secondary">•</span>
                            <span class="text-xs text-secondary">All rights reserved</span>
                        </div>
                    </div>
                    
                    <!-- Divider -->
                    <div style="width: 100%; max-width: 400px; height: 1px; background: var(--border-light);"></div>
                    
                    <!-- System Status and Links -->
                    <div class="flex flex-col" style="gap: var(--space-3); align-items: center; width: 100%;">
                        <!-- System Status -->
                        <div class="flex items-center" style="gap: var(--space-3); flex-wrap: wrap; justify-content: center;">
                            <div class="flex items-center" style="gap: var(--space-2);">
                                <div style="width: 6px; height: 6px; background: #28a745; border-radius: 50%; box-shadow: 0 0 4px rgba(40, 167, 69, 0.5);"></div>
                                <span class="text-xs text-secondary font-medium">System Operational</span>
                            </div>
                            <span class="text-xs text-light">•</span>
                            <span class="text-xs text-light">v2.1.0</span>
                        </div>
                        
                        <!-- Quick Links -->
                        <div class="flex items-center" style="gap: var(--space-4); flex-wrap: wrap; justify-content: center;">
                            <a href="#" class="text-xs text-secondary nav-link" style="transition: color var(--transition-fast);">Privacy Policy</a>
                            <span class="text-xs text-light">•</span>
                            <a href="#" class="text-xs text-secondary nav-link" style="transition: color var(--transition-fast);">Terms of Service</a>
                            <span class="text-xs text-light">•</span>
                            <a href="#" class="text-xs text-secondary nav-link" style="transition: color var(--transition-fast);">Support</a>
                        </div>
                    </div>
                </div>
                @else
                <!-- Centered Content for Non-Authenticated Users -->
                <div class="text-center" style="width: 100%;">
                    <!-- Logo and Brand -->
                    <div class="flex flex-col" style="gap: var(--space-4); align-items: center;">
                        <div class="flex items-center" style="gap: var(--space-3);">
                            <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                                <i class="fas fa-utensils" style="color: var(--primary-dark); font-size: var(--text-base);"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-base font-bold text-primary">RestaurantPro</span>
                                <span class="text-xs text-secondary font-medium">Management System</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Copyright -->
                    <div class="flex flex-col" style="gap: var(--space-3); align-items: center; margin-top: var(--space-4);">
                        <div style="width: 100px; height: 1px; background: var(--border-light);"></div>
                        <div class="flex items-center" style="gap: var(--space-2); flex-wrap: wrap; justify-content: center;">
                            <span class="text-xs text-secondary">
                                <i class="fas fa-copyright" style="margin-right: var(--space-1); opacity: 0.6;"></i>
                                {{ date('Y') }} RestaurantPro
                            </span>
                            <span class="text-xs text-light">•</span>
                            <span class="text-xs text-secondary">All rights reserved</span>
                        </div>
                    </div>
                    
                    <!-- Additional Info -->
                    <div class="flex flex-col" style="gap: var(--space-2); align-items: center; margin-top: var(--space-3);">
                        <span class="text-xs text-light">Enterprise Restaurant Management Solution</span>
                        <div class="flex items-center" style="gap: var(--space-2);">
                            <span class="text-xs text-light">v2.1.0</span>
                            <span class="text-xs text-light">•</span>
                            <span class="text-xs text-light">Secure & Reliable</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </footer>
@else
    <footer style="background: var(--background-card); border-top: 1px solid var(--border-light); padding: var(--space-8) 0; margin-top: var(--space-12);">
        <div class="container">
            <!-- Centered Content for Non-Authenticated Users -->
            <div class="text-center" style="width: 100%;">
                <!-- Logo and Brand -->
                <div class="flex flex-col" style="gap: var(--space-4); align-items: center;">
                    <div class="flex items-center" style="gap: var(--space-3);">
                        <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                            <i class="fas fa-utensils" style="color: var(--primary-dark); font-size: var(--text-base);"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-base font-bold text-primary">RestaurantPro</span>
                            <span class="text-xs text-secondary font-medium">Management System</span>
                        </div>
                    </div>
                </div>
                
                <!-- Copyright -->
                <div class="flex flex-col" style="gap: var(--space-3); align-items: center; margin-top: var(--space-4);">
                    <div style="width: 100px; height: 1px; background: var(--border-light);"></div>
                    <div class="flex items-center" style="gap: var(--space-2); flex-wrap: wrap; justify-content: center;">
                        <span class="text-xs text-secondary">
                            <i class="fas fa-copyright" style="margin-right: var(--space-1); opacity: 0.6;"></i>
                            {{ date('Y') }} RestaurantPro
                        </span>
                        <span class="text-xs text-light">•</span>
                        <span class="text-xs text-secondary">All rights reserved</span>
                    </div>
                </div>
                
                <!-- Additional Info -->
                <div class="flex flex-col" style="gap: var(--space-2); align-items: center; margin-top: var(--space-3);">
                    <span class="text-xs text-light">Enterprise Restaurant Management Solution</span>
                    <div class="flex items-center" style="gap: var(--space-2);">
                        <span class="text-xs text-light">v2.1.0</span>
                        <span class="text-xs text-light">•</span>
                        <span class="text-xs text-light">Secure & Reliable</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endauth
