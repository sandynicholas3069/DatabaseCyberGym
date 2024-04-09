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
    <title>Hapus Data Member - Cybergym</title>
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
        <h1>Hapus Data Member - Cybergym</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $row['id']; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="id_member">ID Member:</label>
            <input type="text" id="id_member" name="id_member" value="<?php echo $row['id_member']; ?>" readonly><br><br>

            <label for="nama_member">Nama Member:</label>
            <input type="text" id="nama_member" name="nama_member" value="<?php echo $row['nama_member']; ?>" readonly><br><br>

            <label for="alamat">Alamat:</label><br>
            <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" readonly><br><br>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <input type="text" id="jenis_kelamin" name="jenis_kelamin" value="<?php echo ($row['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?>" readonly><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" readonly><br><br>

            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" value="<?php echo $row['nomor_telepon']; ?>" readonly><br><br>

            <label for="paket_langganan">Paket Langganan:</label>
            <input type="text" id="paket_langganan" name="paket_langganan" value="<?php echo $row['paket_langganan']; ?>" readonly><br><br>

            <label for="metode_bayar">Metode Bayar:</label>
            <input type="text" id="metode_bayar" name="metode_bayar" value="<?php echo $row['metode_bayar']; ?>" readonly><br><br>

            <label for="nama_admin">Nama Admin:</label>
            <input type="text" id="nama_admin" name="nama_admin" value="<?php echo $row['nama_admin']; ?>" readonly><br><br>

            <button class="form-box" type="submit" value="Submit">Hapus</button>
        </form>
    </div>

    <div id="popupSuccess" class="popup">
        <div class="success-animation">&#10003;</div>
        <p>Data berhasil dihapus</p>
    </div>

    <div id="popupError" class="popup">
        <div class="error-animation">&#10007;</div>
        <p>Error: Gagal menghapus data</p>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];

        $sql = "DELETE FROM member WHERE id=$id";

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
    ?>

</body>
</html>