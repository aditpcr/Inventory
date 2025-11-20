<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestaurantMS Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #818cf8;
            --secondary: #6b7280;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f8fafc;
            --dark: #1e293b;
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f0f4ff 0%, #e6f0ff 100%);
            min-height: 100vh;
            padding-top: 80px;
            color: var(--dark);
        }
        
        .header {
            background: var(--glass-bg);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--glass-border);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }
        
        .header.scrolled {
            box-shadow: var(--shadow-lg);
            background: rgba(255, 255, 255, 0.95);
        }
        
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .logo-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 12px;
        }
        
        .logo-link:hover {
            background: rgba(79, 70, 229, 0.05);
            transform: translateY(-1px);
        }
        
        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }
        
        .logo-link:hover .logo-icon {
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
        }
        
        .logo-text {
            display: flex;
            flex-direction: column;
        }
        
        .logo-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            line-height: 1.2;
        }
        
        .logo-subtitle {
            font-size: 0.75rem;
            color: var(--secondary);
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .nav-section {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .nav-item {
            position: relative;
        }
        
        .nav-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            background: transparent;
            border: none;
            border-radius: 10px;
            color: var(--dark);
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .nav-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }
        
        .nav-button:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        
        .nav-button:hover::before {
            opacity: 1;
        }
        
        .nav-button i {
            font-size: 0.9rem;
            transition: transform 0.3s ease;
        }
        
        .nav-button:hover i {
            transform: scale(1.1);
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            margin-top: 0.5rem;
            background: var(--glass-bg);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            box-shadow: var(--shadow-xl);
            min-width: 220px;
            padding: 0.5rem;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
        
        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--dark);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .dropdown-item:hover {
            background: rgba(79, 70, 229, 0.08);
            color: var(--primary);
            transform: translateX(5px);
        }
        
        .dropdown-item i {
            width: 18px;
            text-align: center;
            color: var(--secondary);
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover i {
            color: var(--primary);
        }
        
        .user-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .notification-button {
            position: relative;
            background: transparent;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .notification-button:hover {
            background: rgba(79, 70, 229, 0.08);
            color: var(--primary);
            transform: translateY(-2px);
        }
        
        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 8px;
            height: 8px;
            background: var(--danger);
            border-radius: 50%;
            border: 2px solid white;
        }
        
        .user-menu {
            position: relative;
        }
        
        .user-button {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: transparent;
            border: none;
            padding: 0.5rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .user-button:hover {
            background: rgba(79, 70, 229, 0.08);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: var(--shadow-md);
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
        }
        
        .user-name {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }
        
        .user-role {
            font-size: 0.75rem;
            color: var(--secondary);
            text-transform: capitalize;
        }
        
        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background: var(--glass-bg);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            box-shadow: var(--shadow-xl);
            width: 280px;
            padding: 1rem;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
        
        .user-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 0.5rem;
        }
        
        .profile-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .profile-info {
            flex: 1;
        }
        
        .profile-name {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }
        
        .profile-email {
            font-size: 0.8rem;
            color: var(--secondary);
            margin-bottom: 0.5rem;
        }
        
        .profile-role {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        
        .dropdown-actions {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .action-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            color: var(--dark);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .action-item:hover {
            background: rgba(79, 70, 229, 0.08);
            color: var(--primary);
        }
        
        .action-item i {
            width: 18px;
            text-align: center;
            color: var(--secondary);
        }
        
        .action-item:hover i {
            color: var(--primary);
        }
        
        .logout-button {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: transparent;
            border: none;
            color: var(--danger);
            text-align: left;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
        }
        
        .logout-button:hover {
            background: rgba(239, 68, 68, 0.08);
        }
        
        .mobile-menu-button {
            display: none;
            background: transparent;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            align-items: center;
            justify-content: center;
            color: var(--dark);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .mobile-menu-button:hover {
            background: rgba(79, 70, 229, 0.08);
            color: var(--primary);
        }
        
        .mobile-menu {
            display: none;
            background: var(--glass-bg);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-top: 1px solid var(--glass-border);
            padding: 1rem 1.5rem;
        }
        
        .mobile-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .mobile-nav-section {
            margin-bottom: 1rem;
        }
        
        .mobile-nav-title {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            padding-left: 1rem;
        }
        
        .mobile-nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--dark);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .mobile-nav-item:hover, .mobile-nav-item.active {
            background: rgba(79, 70, 229, 0.08);
            color: var(--primary);
        }
        
        .mobile-nav-item i {
            width: 18px;
            text-align: center;
        }
        
        @media (max-width: 1024px) {
            .nav-menu {
                display: none;
            }
            
            .mobile-menu-button {
                display: flex;
            }
        }
        
        @media (max-width: 640px) {
            .header-container {
                padding: 0.75rem 1rem;
            }
            
            .user-info {
                display: none;
            }
            
            .logo-text {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header" id="header">
        <div class="header-container">
            <!-- Left Section: Logo -->
            <div class="logo-section">
                <a href="{{ route('dashboard') }}" class="logo-link">
                    <div class="logo-icon">
                        <i class="fas fa-utensils text-white"></i>
                    </div>
                    <div class="logo-text">
                        <div class="logo-title">RestaurantMS</div>
                        <div class="logo-subtitle">Management System</div>
                    </div>
                </a>
            </div>

            <!-- Middle Section: Navigation -->
            <div class="nav-section">
                <!-- Desktop Navigation Menu -->
                <nav class="nav-menu">
                    <!-- Admin Management (Only for Admin) -->
                    @if($role === 'admin')
                    <div class="nav-item">
                        <button class="nav-button" id="adminMenuButton">
                            <i class="fas fa-users-cog"></i>
                            <span>Admin</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu" id="adminMenu">
                            <a href="{{ route('admin.users.index') }}" class="dropdown-item">
                                <i class="fas fa-user-cog"></i>
                                <span>User Management</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Inventory Management (Only for Supervisor) -->
                    @if($role === 'supervisor')
                    <div class="nav-item">
                        <button class="nav-button" id="inventoryMenuButton">
                            <i class="fas fa-boxes"></i>
                            <span>Inventory</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu" id="inventoryMenu">
                            <a href="{{ route('supervisor.ingredients.index') }}" class="dropdown-item">
                                <i class="fas fa-box"></i>
                                <span>Ingredients</span>
                            </a>
                            <a href="{{ route('supervisor.menu-items.index') }}" class="dropdown-item">
                                <i class="fas fa-utensils"></i>
                                <span>Menu Items</span>
                            </a>
                            <a href="{{ route('supervisor.recipes.index') }}" class="dropdown-item">
                                <i class="fas fa-book"></i>
                                <span>Recipes</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Operations (Only for Employee) -->
                    @if($role === 'employee')
                    <div class="nav-item">
                        <button class="nav-button" id="operationsMenuButton">
                            <i class="fas fa-cash-register"></i>
                            <span>Operations</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu" id="operationsMenu">
                            <a href="{{ route('employee.pos') }}" class="dropdown-item">
                                <i class="fas fa-credit-card"></i>
                                <span>POS System</span>
                            </a>
                            <a href="{{ route('employee.orders.index') }}" class="dropdown-item">
                                <i class="fas fa-list-alt"></i>
                                <span>Order History</span>
                            </a>
                        </div>
                    </div>
                    @endif
                </nav>

                <!-- Right Section: User Menu -->
                <div class="user-section">
                    <!-- Notifications -->
                    <button class="notification-button">
                        <i class="fas fa-bell"></i>
                        <div class="notification-badge"></div>
                    </button>

                    <!-- User Profile -->
                    <div class="user-menu">
                        <button class="user-button" id="userMenuButton">
                            <div class="user-info">
                                <div class="user-name">{{ auth()->user()->name }}</div>
                                <div class="user-role">{{ auth()->user()->role }}</div>
                            </div>
                            <div class="user-avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="user-dropdown" id="userDropdown">
                            <div class="user-profile">
                                <div class="profile-avatar">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="profile-info">
                                    <div class="profile-name">{{ auth()->user()->name }}</div>
                                    <div class="profile-email">{{ auth()->user()->email }}</div>
                                    <div class="profile-role">{{ auth()->user()->role }}</div>
                                </div>
                            </div>
                            <div class="dropdown-actions">
                                <a href="{{ route('profile.edit') }}" class="action-item">
                                    <i class="fas fa-user-edit"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="logout-button">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button class="mobile-menu-button" id="mobileMenuButton">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div class="mobile-menu" id="mobileMenu">
            <nav class="mobile-nav">
                <!-- Admin Management (Only for Admin) -->
                @if($role === 'admin')
                <div class="mobile-nav-section">
                    <div class="mobile-nav-title">Admin Management</div>
                    <a href="{{ route('admin.users.index') }}" class="mobile-nav-item">
                        <i class="fas fa-user-cog"></i>
                        <span>User Management</span>
                    </a>
                </div>
                @endif

                <!-- Inventory Management (Only for Supervisor) -->
                @if($role === 'supervisor')
                <div class="mobile-nav-section">
                    <div class="mobile-nav-title">Inventory Management</div>
                    <a href="{{ route('supervisor.ingredients.index') }}" class="mobile-nav-item">
                        <i class="fas fa-box"></i>
                        <span>Ingredients</span>
                    </a>
                    <a href="{{ route('supervisor.menu-items.index') }}" class="mobile-nav-item">
                        <i class="fas fa-utensils"></i>
                        <span>Menu Items</span>
                    </a>
                    <a href="{{ route('supervisor.recipes.index') }}" class="mobile-nav-item">
                        <i class="fas fa-book"></i>
                        <span>Recipes</span>
                    </a>
                </div>
                @endif

                <!-- Operations (Only for Employee) -->
                @if($role === 'employee')
                <div class="mobile-nav-section">
                    <div class="mobile-nav-title">Operations</div>
                    <a href="{{ route('employee.pos') }}" class="mobile-nav-item">
                        <i class="fas fa-cash-register"></i>
                        <span>POS System</span>
                    </a>
                    <a href="{{ route('employee.orders.index') }}" class="mobile-nav-item">
                        <i class="fas fa-list-alt"></i>
                        <span>Order History</span>
                    </a>
                </div>
                @endif

                <!-- Profile Settings -->
                <div class="mobile-nav-section">
                    <div class="mobile-nav-title">Account</div>
                    <a href="{{ route('profile.edit') }}" class="mobile-nav-item">
                        <i class="fas fa-user-edit"></i>
                        <span>Edit Profile</span>
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <script>
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Dropdown menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle dropdown menus
            const dropdownButtons = document.querySelectorAll('.nav-button');
            dropdownButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = this.nextElementSibling;
                    
                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        if (menu !== dropdown) {
                            menu.classList.remove('show');
                        }
                    });
                    
                    // Toggle current dropdown
                    if (dropdown) {
                        dropdown.classList.toggle('show');
                    }
                });
            });

            // User menu toggle
            const userMenuButton = document.getElementById('userMenuButton');
            const userDropdown = document.getElementById('userDropdown');
            
            if (userMenuButton && userDropdown) {
                userMenuButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('show');
                });
            }

            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const mobileMenu = document.getElementById('mobileMenu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.style.display = mobileMenu.style.display === 'block' ? 'none' : 'block';
                    
                    // Toggle icon
                    const icon = mobileMenuButton.querySelector('i');
                    if (mobileMenu.style.display === 'block') {
                        icon.className = 'fas fa-times';
                    } else {
                        icon.className = 'fas fa-bars';
                    }
                });
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    menu.classList.remove('show');
                });
                
                if (userDropdown) {
                    userDropdown.classList.remove('show');
                }
            });

            // Prevent dropdown close when clicking inside dropdown
            document.querySelectorAll('.dropdown-menu, .user-dropdown').forEach(menu => {
                menu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });
    </script>
</body>
</html>