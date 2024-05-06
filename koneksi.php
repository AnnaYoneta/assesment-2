<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpengajuan";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if(isset($_GET['id'])) {
    // Mendapatkan ID form yang akan dihapus dari parameter URL
    $id = $_GET['id'];

    // Query untuk menghapus data dari tabel berdasarkan ID form
    $sql = "DELETE FROM tabel_pengajuan WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {

    // Query untuk mengambil data dari tabel
    $sql = "SELECT id, nama_pengajuan, judul, deskripsi, tanggal_pengajuan, status_pengajuan FROM tabel_pengajuan";
    $result = $conn->query($sql);

    // Membuat array untuk menyimpan data
    $data = array();

    // Mengambil setiap baris hasil query dan menambahkannya ke dalam array
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Mengubah array menjadi format JSON dan mencetaknya
    echo json_encode($data);
}

// Menutup koneksi
$conn->close();
?>