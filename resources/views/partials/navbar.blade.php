<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestaurantMS Navigation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #6366f1;
            --primary-dark: #4338ca;
            --secondary: #f8fafc;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --border-light: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: var(--text-dark);
        }

        .navbar {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: var(--shadow);
            border-bottom: 1px solid var(--border-light);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            backdrop-filter: blur(10px);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 4rem;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mobile-menu-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.5rem;
            color: var(--text-light);
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .mobile-menu-btn:hover {
            background-color: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.75rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            font-size: 1.25rem;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);
        }

        .logo-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            letter-spacing: -0.025em;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .notification-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.5rem;
            color: var(--text-light);
            background: transparent;
            border: none;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }

        .notification-btn:hover {
            background-color: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }

        .notification-badge {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background-color: #ef4444;
            border: 2px solid white;
        }

        .user-menu {
            position: relative;
        }

        .user-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
            border-radius: 0.75rem;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .user-btn:hover {
            background-color: rgba(99, 102, 241, 0.1);
        }

        .user-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
        }

        .user-name {
            font-weight: 500;
            color: var(--text-dark);
        }

        .dropdown-arrow {
            color: var(--text-light);
            font-size: 0.75rem;
            transition: transform 0.2s ease;
        }

        .user-btn[aria-expanded="true"] .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 0.5rem;
            width: 12rem;
            background: white;
            border-radius: 0.75rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-light);
            overflow: hidden;
            z-index: 50;
            opacity: 0;
            transform: translateY(-0.5rem);
            visibility: hidden;
            transition: all 0.2s ease;
        }

        .dropdown-menu.show {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.15s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f8fafc;
        }

        .dropdown-item i {
            width: 1rem;
            color: var(--text-light);
        }

        .spacer {
            height: 4rem;
        }

        @media (max-width: 768px) {
            .user-name {
                display: none;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-content">
                <!-- Left side - Logo and mobile menu button -->
                <div class="navbar-left">
                    <!-- Mobile menu button -->
                    <button id="sidebarToggle" class="mobile-menu-btn">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <!-- Logo -->
                    <a href="#" class="logo">
                        <div class="logo-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <span class="logo-text">RestaurantMS</span>
                    </a>
                </div>

                <!-- Right side - User menu -->
                <div class="navbar-right">
                    <!-- Notifications -->
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge"></span>
                    </button>

                    <!-- User profile dropdown -->
                    <div class="user-menu" x-data="{ open: false }">
                        <button 
                            class="user-btn"
                            @click="open = !open"
                            :aria-expanded="open"
                        >
                            <div class="user-avatar">
                                <span>J</span>
                            </div>
                            <span class="user-name">John Doe</span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </button>

                        <!-- Dropdown menu -->
                        <div 
                            class="dropdown-menu"
                            :class="{ 'show': open }"
                            @click.away="open = false"
                            x-cloak
                        >
                            <a 
                                href="#" 
                                class="dropdown-item"
                            >
                                <i class="fas fa-user-edit"></i>
                                Edit Profile
                            </a>
                            <form method="POST" action="#">
                                <button 
                                    type="submit"
                                    class="dropdown-item"
                                >
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Spacer for fixed navbar -->
    <div class="spacer"></div>

    <script>
        // Simple JavaScript to handle dropdown toggle (for non-Alpine users)
        document.addEventListener('DOMContentLoaded', function() {
            const userBtn = document.querySelector('.user-btn');
            const dropdownMenu = document.querySelector('.dropdown-menu');
            
            userBtn.addEventListener('click', function() {
                const isExpanded = userBtn.getAttribute('aria-expanded') === 'true';
                userBtn.setAttribute('aria-expanded', !isExpanded);
                dropdownMenu.classList.toggle('show');
            });
        });
    </script>
</body>
</html>