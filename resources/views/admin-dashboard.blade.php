<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Manajemen Stok</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #FFFBEA;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #FFD54F;
            color: #333;
            text-align: center;
            padding: 1.5rem;
            font-size: 1.8rem;
            font-weight: 700;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .container {
            margin: 40px auto;
            width: 80%;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            padding: 30px;
        }

        h2 {
            color: #F4B400;
            margin-bottom: 20px;
        }

        .menu {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 25px;
        }

        .card {
            background: #FFF7D1;
            border-radius: 12px;
            width: 220px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }

        .card:hover {
            background: #FFE97F;
            transform: translateY(-5px);
        }

        .card h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .logout-btn {
            display: block;
            margin: 40px auto 0;
            padding: 10px 25px;
            background-color: #FF6F61;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background-color: #ff8a80;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <header>🍋 Dashboard Admin - Manajemen Stok Bahan Makanan</header>

    <div class="container">
        <h2>Selamat datang, Admin 👋</h2>
        <p>Kelola stok bahan makanan dengan mudah melalui menu di bawah ini.</p>

        <div class="menu">
            <div class="card">
                <h3>📦 Data Stok</h3>
                <p>Lihat dan perbarui stok bahan makanan yang tersedia.</p>
            </div>
            <div class="card">
                <h3>➕ Tambah Bahan</h3>
                <p>Tambahkan bahan makanan baru ke dalam sistem.</p>
            </div>
            <div class="card">
                <h3>📉 Laporan Stok</h3>
                <p>Lihat laporan keluar dan masuk bahan makanan.</p>
            </div>
        </div>

        <a href="#" class="logout-btn">Logout</a>
    </div>
</body>
</html>