<?php
    include 'koneksi.php';
    if(isset($_POST['nama_pelanggan'])){
        $nama = $_POST['nama_pelanggan'];
        $alamat = $_POST['alamat'];
        $no_telepon = $_POST['no_telepon'];

        $query = mysqli_query($koneksi, "INSERT INTO pelanggan (nama_pelanggan, alamat, no_telepon) VALUES ('$nama', '$alamat', '$no_telepon')");
        if($query) {
            echo "<script>alert('Data Berhasil Ditambahkan'); window.location='pelanggan.php'</script>";
        }else{
            echo "<script>alert('Data Gagal Ditambahkan'); window.location='pelanggan.php'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
            color: #2c3e50;
        }

        .table tr:hover {
            background-color: #f5f5f5;
            transition: background-color 0.3s ease;
        }

        .table td {
            font-size: 14px;
            color: #444;
        }

        .form_control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            font-size: 14px;
        }

        textarea.form_control {
            resize: vertical;
            min-height: 100px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            margin-right: 8px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            margin-right: 8px;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }


        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }



        .sidebar {
            background: #2c3e50;
            color: white;
            width: 250px;
            height: 100vh;
            padding: 20px 0;
        }



        .brand {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #34495e;
            margin-bottom: 20px;
        }

        .brand h2 {
            color: #ecf0f1;
        }

        .menu {
            list-style: none;
        }

        .menu-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .menu li {
            padding: 15px 25px;
            transition: all 0.3s;
        }

        .menu li:hover {
            background: #34495e;
            cursor: pointer;
        }

        .menu li.active {
            background: #3498db;
        }

        .menu li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .menu li i {
            margin-right: 15px;
            width: 20px;
        }

        .content {
            flex: 1;
            padding: 20px;
            background: rgb(236, 239, 241);

        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header h1 {

            color: rgb(0, 0, 0);
            font-size: 40px;
        }

        .header ol {
            margin-bottom: 10px;
        }


        .card {
            width: 200px;
            border-radius: 8px;
            overflow: hidden;
            color: white;
            text-align: center;

        }

        .cards-container {
            display: flex;
            gap: 20px;
            padding: 20px 0;
        }

        .card-header {
            padding: 15px;
            font-size: 18px;

        }

        .card-footer {
            padding: 10px;
            background: rgba(0, 0, 0, 0.1);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-footer a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .blue {
            background: #007bff;
        }

        .yellow {
            background: #ffc107;
        }

        .green {
            background: #28a745;
        }

        .red {
            background: #dc3545;
        }

        /* Add these responsive styles to your existing CSS */

        @media screen and (max-width: 1024px) {
            .cards-container {
                flex-wrap: wrap;
                justify-content: center;
            }

            .card {
                width: calc(50% - 20px);
                min-width: 200px;
            }
        }

        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                width: 100%;
            }

            .header h1 {
                font-size: 30px;
            }
        }

        @media screen and (max-width: 480px) {
            .card {
                width: 100%;
            }

            .cards-container {
                gap: 15px;
            }

            .header {
                padding: 15px;
            }

            .header h1 {
                font-size: 24px;
            }

            .menu li {
                padding: 10px 15px;
            }

            .brand {
                padding: 15px;
            }
        }

        /* Add this for better touch interaction on mobile */
        @media (hover: none) {
            .menu li:hover {
                background: none;
            }

            .menu li:active {
                background: #34495e;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <div class="header">
                <h1>Pelanggan</h1>
                <ol>Pelanggan</ol>
                <a href="pelanggan.php" class="btn btn-danger">Kembali</a>
            </div>
            <hr>
            <form method="post">
                <table class="table table-bordered">
                    <tr>
                        <td width="200">Nama Pelanggan</td>
                        <td>:</td>
                        <td><input class="form_control" type="text" name="nama_pelanggan"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>
                            <textarea name="alamat" rows="5" class="form_control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td>:</td>
                        <td><input class="form_control" type="number" name="no_telepon"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </td>
                    </tr>
                </table>
            </form>


        </div>
    </div>
</body>

</html>