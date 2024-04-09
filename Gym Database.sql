CREATE TABLE member (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_member VARCHAR(20) NOT NULL,
    nama_member VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    email VARCHAR(100) NOT NULL,
    nomor_telepon VARCHAR(20) NOT NULL,
    paket_langganan VARCHAR(50) NOT NULL,
    metode_bayar VARCHAR(100) NOT NULL,
    nama_admin VARCHAR(100) NOT NULL
);