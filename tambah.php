<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Member Baru - Cybergym</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            border: 2px solid;
            border-radius: 5px;
            z-index: 9999;
        }

        .success-animation {
            color: #008000;
            font-size: 50px;
            text-align: center;
        }

        .error-animation {
            color: #ff0000;
            font-size: 50px;
            text-align: center;
        }

        .popup p {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="form-box">
        <h1>Tambah Member Baru - Cybergym</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="id_member">ID Member:</label>
            <input type="text" id="id_member" name="id_member" required><br><br>

            <label for="nama_member">Nama Member:</label>
            <input type="text" id="nama_member" name="nama_member" required><br><br>

            <label for="alamat">Alamat:</label><br>
            <textarea id="alamat" name="alamat" rows="4" cols="50" required></textarea><br><br>

            <label>Jenis Kelamin:</label><br>
            <input type="radio" id="laki-laki" name="jenis_kelamin" value="L" required>
            <label for="laki-laki">Laki-laki</label><br>
            <input type="radio" id="perempuan" name="jenis_kelamin" value="P" required>
            <label for="perempuan">Perempuan</label><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" required><br><br>

            <label for="paket_langganan">Paket Langganan:</label>
            <select id="paket_langganan" name="paket_langganan" required>
                <option value="Paket Crystal">Paket Crystal</option>
                <option value="Paket Diamond">Paket Diamond</option>
                <option value="Paket Gold">Paket Gold</option>
                <option value="Paket Silver">Paket Silver</option>
                <option value="Paket Bronze">Paket Bronze</option>
                <option value="Paket Titanium">Paket Titanium</option>
                <option value="Paket Steel">Paket Steel</option>
            </select><br><br>

            <label>Metode Bayar:</label><br>
            <input type="checkbox" id="cash" name="metode_bayar[]" value="Cash">
            <label for="cash">Cash</label><br>
            <input type="checkbox" id="transfer" name="metode_bayar[]" value="Transfer">
            <label for="transfer">Transfer</label><br>
            <input type="checkbox" id="e_wallet" name="metode_bayar[]" value="E-Wallet">
            <label for="e_wallet">E-Wallet</label><br><br>

            <label for="nama_admin">Nama Admin:</label>
            <input type="text" id="nama_admin" name="nama_admin" required><br><br>

            <button class="form-box" type="submit" value="Submit">Tambah</button>
        </form>
    </div>

    <div id="popupSuccess" class="popup">
        <div class="success-animation">&#10003;</div>
        <p>Data berhasil ditambahkan</p>
    </div>

    <div id="popupError" class="popup">
        <div class="error-animation">&#10007;</div>
        <p>Error: Gagal menambahkan data</p>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_member = $_POST["id_member"];
        $nama_member = $_POST["nama_member"];
        $alamat = $_POST["alamat"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $email = $_POST["email"];
        $nomor_telepon = $_POST["nomor_telepon"];
        $paket_langganan = $_POST["paket_langganan"];
        $metode_bayar = implode(", ", $_POST["metode_bayar"]);
        $nama_admin = $_POST["nama_admin"];

        $sql = "INSERT INTO member (id_member, nama_member, alamat, jenis_kelamin, email, nomor_telepon, paket_langganan, metode_bayar, nama_admin) 
                VALUES ('$id_member', '$nama_member', '$alamat', '$jenis_kelamin', '$email', '$nomor_telepon', '$paket_langganan', '$metode_bayar', '$nama_admin')";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    document.getElementById('popupSuccess').style.display = 'block';
                    setTimeout(function(){
                        document.getElementById('popupSuccess').style.display = 'none';
                        window.location.href = 'index.php';
                    }, 2000);
                </script>";
        } else {
            echo "<script>
                    document.getElementById('popupError').style.display = 'block';
                    setTimeout(function(){
                        document.getElementById('popupError').style.display = 'none';
                        window.location.href = 'index.php';
                    }, 2000);
                </script>";
        }
    }

        mysqli_close($conn);
    }
    ?>

</body>
</html>