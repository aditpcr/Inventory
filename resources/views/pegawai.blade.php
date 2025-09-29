<!DOCTYPE html>
<html>
<head>
    <title>Data Pegawai</title>
</head>
<body>
    <h2>Data Pegawai</h2>
    <p>Nama: {{ $name }}</p>
    <p>Umur: {{ $my_age }} tahun</p>


    <p>Hobi:</p>
    <ul>
        @foreach($hobbies as $hobby)
            <li>{{ $hobby }}</li>
        @endforeach
    </ul>


    <p>Tanggal Harus Wisuda: {{ $tgl_harus_wisuda }}</p>
    <p>Sisa Hari Menuju Wisuda: {{ $time_to_study_left }} hari</p>
    <p>Semester Saat Ini: {{ $current_semester }}</p>
    <p>Info Semester: {{ $semester_info }}</p>
    <p>Cita-cita: {{ $future_goal }}</p>
</body>
</html>


