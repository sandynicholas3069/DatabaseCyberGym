<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Member Gym - Cybergym</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: black;
            color: white;
        }
        h1, p {
            text-align: center;
        }
        .logo{
            display: block;
            margin: 0 auto 20px;
        }
        .button-box {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        .button-blue {
            background-color: blue;
            color: white;
        }
        .button-yellow {
            background-color: yellow;
            color: black;
        }
        .button-red {
            background-color: red;
            color: white;
        }
        .button-container {
            display: inline-block;
        }
        .button-container button {
            margin-right: 0;
        }
    </style>
</head>
<body>
    <img src="Cybergym.png" alt="Logo Gym" class="logo">
    <h1>Data Member Gym - Cybergym</h1>
    <p>TAMPILAN DATABASE PELANGGAN CYBERGYM</p>
    <button class="button-box button-blue" onclick="location.href='tambah.php';">Tambahkan Member</button>
    <br><br>
    <table border="1">
        <tr>
            <th>ID Member</th>
            <th>Nama Member</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
            <th>Nomor Telepon</th>
            <th>Paket Langganan</th>
            <th>Metode Bayar</th>
            <th>Nama Admin</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM member";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['id_member']."</td>";
                echo "<td>".$row['nama_member']."</td>";
                echo "<td>".$row['alamat']."</td>";
                echo "<td>".$row['jenis_kelamin']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['nomor_telepon']."</td>";
                echo "<td>".$row['paket_langganan']."</td>";
                echo "<td>".$row['metode_bayar']."</td>";
                echo "<td>".$row['nama_admin']."</td>";
                echo "<td class='button-container'>
                        <button class='button-box button-yellow' onclick=\"location.href='ubah.php?id=".$row['id']."';\">Ubah</button>
                        <button class='button-box button-red' onclick=\"location.href='hapus.php?id=".$row['id']."';\">Hapus</button>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>Tidak ada data</td></tr>";
        }
        ?>
    </table>
</body>
</html>