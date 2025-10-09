<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --dark: #2b2d42;
            --light: #f8f9fa;
            --gray: #8d99ae;
            --border: #e9ecef;
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --sidebar-width: 260px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f7fb;
            color: var(--dark);
            line-height: 1.6;
        }
        
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            box-shadow: var(--card-shadow);
            position: fixed;
            height: 100vh;
            z-index: 100;
            transition: all 0.3s;
        }
        
        .sidebar-header {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid var(--border);
        }
        
        .brand {
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary);
        }
        
        .brand i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover, .menu-item.active {
            background-color: rgba(67, 97, 238, 0.05);
            color: var(--primary);
            border-left-color: var(--primary);
        }
        
        .menu-item i {
            width: 24px;
            margin-right: 12px;
            font-size: 1.1rem;
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .page-title h1 {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.25rem;
        }
        
        .page-title p {
            color: var(--gray);
            margin-bottom: 0;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
        }
        
        .notification-icon {
            position: relative;
            margin-right: 1.5rem;
            font-size: 1.25rem;
            color: var(--gray);
            cursor: pointer;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            cursor: pointer;
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
        }
        
        .stat-info h3 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        .stat-info p {
            color: var(--gray);
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        
        /* Charts and Content */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            border: none;
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border);
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: between;
            align-items: center;
        }
        
        .card-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .chart-container {
            height: 300px;
            position: relative;
        }
        
        /* Table Styles */
        .table th {
            border-top: none;
            font-weight: 600;
            color: var(--gray);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem 0.75rem;
        }
        
        .table td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
            border-color: var(--border);
        }
        
        .status-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .badge-success {
            background: rgba(76, 201, 240, 0.1);
            color: #4cc9f0;
        }
        
        .badge-warning {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        
        .badge-danger {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        
        .badge-info {
            background: rgba(23, 162, 184, 0.1);
            color: #17a2b8;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="brand">
                    <i class="fas fa-chart-line"></i>
                    <span>RestoManage</span>
                </div>
            </div>
            <div class="sidebar-menu">
                <a href="#" class="menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-utensils"></i>
                    <span>Menu Management</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-boxes"></i>
                    <span>Stock Overview</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-edit"></i>
                    <span>Update Stock</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-bar"></i>
                    <span>Sales Analytics</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-users"></i>
                    <span>Staff Management</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Reports</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <a href="/login" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="page-title">
                    <h1>Dashboard</h1>
                    <p>Welcome back, <strong>{{ $username }}</strong>! Here's your restaurant overview.</p>
                </div>
                <div class="user-menu">
                    <div class="notification-icon">
                        <i class="far fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    <div class="user-avatar">
                        {{ substr($username, 0, 1) }}
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(67, 97, 238, 0.1); color: var(--primary);">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-info">
                        <h3>$3,842</h3>
                        <p>Today's Sales</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(76, 201, 240, 0.1); color: var(--success);">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-info">
                        <h3>127</h3>
                        <p>Orders Today</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="stat-info">
                        <h3>42</h3>
                        <p>Menu Items</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: rgba(220, 53, 69, 0.1); color: var(--danger);">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>8</h3>
                        <p>Low Stock Items</p>
                    </div>
                </div>
            </div>

            <!-- Charts and Tables -->
            <div class="content-grid">
                <!-- Sales Chart -->
                <div class="card">
                    <div class="card-header">
                        <h3>Sales Overview</h3>
                        <select class="form-select form-select-sm w-auto">
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                            <option>Last 3 Months</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Top Selling Items -->
                <div class="card">
                    <div class="card-header">
                        <h3>Top Selling Items</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Grilled Salmon</h6>
                                    <small class="text-muted">Main Course</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">42</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Caesar Salad</h6>
                                    <small class="text-muted">Appetizer</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">38</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Chocolate Cake</h6>
                                    <small class="text-muted">Dessert</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">35</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Margherita Pizza</h6>
                                    <small class="text-muted">Main Course</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">31</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Iced Coffee</h6>
                                    <small class="text-muted">Beverage</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">28</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tables Row -->
            <div class="content-grid">
                <!-- Low Stock Alert -->
                <div class="card">
                    <div class="card-header">
                        <h3>Low Stock Alert</h3>
                        <span class="badge bg-danger">8 items</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Current Stock</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Salmon Fillet</td>
                                        <td>3</td>
                                        <td><span class="status-badge badge-danger">Critical</span></td>
                                        <td><button class="btn btn-sm btn-outline-primary">Reorder</button></td>
                                    </tr>
                                    <tr>
                                        <td>Avocado</td>
                                        <td>5</td>
                                        <td><span class="status-badge badge-warning">Low</span></td>
                                        <td><button class="btn btn-sm btn-outline-primary">Reorder</button></td>
                                    </tr>
                                    <tr>
                                        <td>Mozzarella Cheese</td>
                                        <td>4</td>
                                        <td><span class="status-badge badge-danger">Critical</span></td>
                                        <td><button class="btn btn-sm btn-outline-primary">Reorder</button></td>
                                    </tr>
                                    <tr>
                                        <td>Fresh Basil</td>
                                        <td>6</td>
                                        <td><span class="status-badge badge-warning">Low</span></td>
                                        <td><button class="btn btn-sm btn-outline-primary">Reorder</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="card">
                    <div class="card-header">
                        <h3>Recent Orders</h3>
                        <a href="#" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#ORD-7842</td>
                                        <td>John Smith</td>
                                        <td>$42.50</td>
                                        <td><span class="status-badge badge-success">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-7841</td>
                                        <td>Emma Johnson</td>
                                        <td>$68.30</td>
                                        <td><span class="status-badge badge-success">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-7840</td>
                                        <td>Michael Brown</td>
                                        <td>$35.75</td>
                                        <td><span class="status-badge badge-warning">Preparing</span></td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-7839</td>
                                        <td>Sarah Davis</td>
                                        <td>$52.20</td>
                                        <td><span class="status-badge badge-info">Pending</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Sales ($)',
                    data: [3200, 2980, 3600, 4100, 3850, 4750, 4420],
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.05)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#4361ee',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        padding: 10,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        
        // Update the username in the welcome message
        document.addEventListener('DOMContentLoaded', function() {
            const username = "{{ $username }}";
            document.querySelector('.page-title p').innerHTML = `Welcome back, <strong>${username}</strong>! Here's your restaurant overview.`;
            
            // Set user avatar initial
            document.querySelector('.user-avatar').textContent = username.charAt(0).toUpperCase();
        });
    </script>
</body>
</html>