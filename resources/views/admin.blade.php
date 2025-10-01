<!DOCTYPE html>
<html>
<head>
    <title>Data Admin</title>
</head>
<body>
    <h2>Data Admin</h2>

    <ul>
        @foreach($admins as $admin)
            <li>
                <strong>{{ $admin['name'] }}</strong><br>
                Umur: {{ $admin['age'] }} tahun <br>
                Hobi: 
                <ul>
                    @foreach($admin['hobbies'] as $hobby)
                        <li>{{ $hobby }}</li>
                    @endforeach
                </ul>
                Cita-cita: {{ $admin['future_goal'] }}
            </li>
            <hr>
        @endforeach
    </ul>
</body>
</html>
