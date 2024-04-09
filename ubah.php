<?php include "koneksi.php"; ?>
<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM member WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan";
        exit();
    }
} else {
    echo "ID tidak ditemukan";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Member - Cybergym</title>
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
        <h1>Ubah Data Member - Cybergym</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $row['id']; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="id_member">ID Member:</label>
            <input type="text" id="id_member" name="id_member" value="<?php echo $row['id_member']; ?>" required><br><br>

            <label for="nama_member">Nama Member:</label>
            <input type="text" id="nama_member" name="nama_member" value="<?php echo $row['nama_member']; ?>" required><br><br>

            <label for="alamat">Alamat:</label><br>
            <textarea id="alamat" name="alamat" rows="4" cols="50" required><?php echo $row['alamat']; ?></textarea><br><br>

            <label>Jenis Kelamin:</label><br>
            <input type="radio" id="laki-laki" name="jenis_kelamin" value="L" <?php if($row['jenis_kelamin'] == 'L') echo 'checked'; ?> required>
            <label for="laki-laki">Laki-laki</label><br>
            <input type="radio" id="perempuan" name="jenis_kelamin" value="P" <?php if($row['jenis_kelamin'] == 'P') echo 'checked'; ?> required>
            <label for="perempuan">Perempuan</label><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" value="<?php echo $row['nomor_telepon']; ?>" required><br><br>

            <label for="paket_langganan">Paket Langganan:</label>
            <select id="paket_langganan" name="paket_langganan" required>
                <option value="Paket Crystal" <?php if($row['paket_langganan'] == 'Paket Crystal') echo 'selected'; ?>>Paket Crystal</option>
                <option value="Paket Diamond" <?php if($row['paket_langganan'] == 'Paket Diamond') echo 'selected'; ?>>Paket Diamond</option>
                <option value="Paket Gold" <?php if($row['paket_langganan'] == 'Paket Gold') echo 'selected'; ?>>Paket Gold</option>
                <option value="Paket Silver" <?php if($row['paket_langganan'] == 'Paket Silver') echo 'selected'; ?>>Paket Silver</option>
                <option value="Paket Bronze" <?php if($row['paket_langganan'] == 'Paket Bronze') echo 'selected'; ?>>Paket Bronze</option>
                <option value="Paket Titanium" <?php if($row['paket_langganan'] == 'Paket Titanium') echo 'selected'; ?>>Paket Titanium</option>
                <option value="Paket Steel" <?php if($row['paket_langganan'] == 'Paket Steel') echo 'selected'; ?>>Paket Steel</option>
            </select><br><br>

            <label>Metode Bayar:</label><br>
            <input type="checkbox" id="cash" name="metode_bayar[]" value="Cash" <?php if(in_array('Cash', explode(', ', $row['metode_bayar']))) echo 'checked'; ?>>
            <label for="cash">Cash</label><br>
            <input type="checkbox" id="transfer" name="metode_bayar[]" value="Transfer" <?php if(in_array('Transfer', explode(', ', $row['metode_bayar']))) echo 'checked'; ?>>
            <label for="transfer">Transfer</label><br>
            <input type="checkbox" id="e_wallet" name="metode_bayar[]" value="E-Wallet" <?php if(in_array('E-Wallet', explode(', ', $row['metode_bayar']))) echo 'checked'; ?>>
            <label for="e_wallet">E-Wallet</label><br><br>

            <label for="nama_admin">Nama Admin:</label>
            <input type="text" id="nama_admin" name="nama_admin" value="<?php echo $row['nama_admin']; ?>" required><br><br>

            <button class="form-box" type="submit" value="Submit">Ubah</button>
        </form>
    </div>

    <div id="popupSuccess" class="popup">
        <div class="success-animation">&#10003;</div>
        <p>Data berhasil diubah</p>
    </div>

    <div id="popupError" class="popup">
        <div class="error-animation">&#10007;</div>
        <p>Error: Gagal mengubah data</p>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $id_member = $_POST["id_member"];
        $nama_member = $_POST["nama_member"];
        $alamat = $_POST["alamat"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $email = $_POST["email"];
        $nomor_telepon = $_POST["nomor_telepon"];
        $paket_langganan = $_POST["paket_langganan"];
        $metode_bayar = implode(", ", $_POST["metode_bayar"]);
        $nama_admin = $_POST["nama_admin"];

        $sql = "UPDATE member SET id_member='$id_member', nama_member='$nama_member', alamat='$alamat', jenis_kelamin='$jenis_kelamin', 
                email='$email', nomor_telepon='$nomor_telepon', paket_langganan='$paket_langganan', metode_bayar='$metode_bayar', 
                nama_admin='$nama_admin' WHERE id=$id";

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