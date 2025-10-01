<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Admin</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="container">
        <h2>Data Admin</h2>

        <div class="admin-list">
            @foreach($admins as $admin)
                <div class="admin-card">
                    <div class="admin-info">
                        <h3 class="admin-name">{{ $admin['name'] }}</h3>
                        <p class="admin-age">Umur: {{ $admin['age'] }} tahun</p>
                        
                        <div class="hobbies-section">
                            <strong>Hobi:</strong>
                            <ul class="hobbies-list">
                                @foreach($admin['hobbies'] as $hobby)
                                    <li class="hobby-item">{{ $hobby }}</li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <p class="future-goal"><strong>Cita-cita:</strong> {{ $admin['future_goal'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>