<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unified Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .role-btn {
            transition: all 0.3s ease;
        }
        .role-btn.active {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0,123,255,0.3);
        }
        .password-requirements {
            font-size: 0.875rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Login System</h3>
                        <p class="text-muted mb-0">Pilih role dan masukkan credentials</p>
                    </div>
                    <div class="card-body">
                        <!-- Success/Error Messages -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Role Selection -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Role:</label>
                            <div class="row g-2">
                                <div class="col-4">
                                    <button type="button" class="btn btn-outline-primary w-100 role-btn {{ old('role', session('role')) == 'admin' ? 'active' : '' }}" data-role="admin">
                                        Admin
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-outline-success w-100 role-btn {{ old('role', session('role')) == 'supervisor' ? 'active' : '' }}" data-role="supervisor">
                                        Supervisor
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-outline-info w-100 role-btn {{ old('role', session('role')) == 'employee' ? 'active' : '' }}" data-role="employee">
                                        Employee
                                    </button>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="/login">
                            @csrf
                            <input type="hidden" name="role" id="role" value="{{ old('role', session('role')) }}">

                            <!-- Username Field -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       id="username" 
                                       name="username" 
                                       value="{{ old('username') }}" 
                                       required
                                       placeholder="Masukkan username">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       required
                                       placeholder="Masukkan password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Role-specific Instructions -->
                            <div class="alert alert-info" id="roleInstructions">
                                @if(old('role', session('role')) == 'admin')
                                    <strong>Admin:</strong> Password minimal 3 karakter dan mengandung huruf kapital.
                                @elseif(old('role', session('role')) == 'supervisor')
                                    <strong>Supervisor:</strong> Username hanya huruf kecil, password minimal 8 karakter dengan huruf dan angka.
                                @elseif(old('role', session('role')) == 'employee')
                                    <strong>Employee:</strong> Password minimal 8 karakter.
                                @else
                                    Pilih role untuk melihat requirements.
                                @endif
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Login</button>
                        </form>

                        <!-- Demo Credentials -->
                        <div class="mt-4">
                            <div class="accordion" id="credentialsAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#credentialsCollapse">
                                            Demo Credentials
                                        </button>
                                    </h2>
                                    <div id="credentialsCollapse" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            <strong>Admin:</strong> admin123 / Admin123<br>
                                            <strong>Supervisor:</strong> adityadfn / abcdefgh123<br>
                                            <strong>Employee:</strong> 2455301159 / 2455301159
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleButtons = document.querySelectorAll('.role-btn');
            const roleInput = document.getElementById('role');
            const roleInstructions = document.getElementById('roleInstructions');
            
            // Role selection handler
            roleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const selectedRole = this.getAttribute('data-role');
                    
                    // Update active state
                    roleButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update hidden input
                    roleInput.value = selectedRole;
                    
                    // Update instructions
                    updateInstructions(selectedRole);
                });
            });
            
            function updateInstructions(role) {
                const instructions = {
                    'admin': '<strong>Admin:</strong> Password minimal 3 karakter dan mengandung huruf kapital.',
                    'supervisor': '<strong>Supervisor:</strong> Username hanya huruf kecil, password minimal 8 karakter dengan huruf dan angka.',
                    'employee': '<strong>Employee:</strong> Password minimal 8 karakter.'
                };
                
                roleInstructions.innerHTML = instructions[role] || 'Pilih role untuk melihat requirements.';
            }
            
            // Initialize with current role
            const currentRole = roleInput.value;
            if (currentRole) {
                updateInstructions(currentRole);
            }
        });
    </script>
</body>
</html>