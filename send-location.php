<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Simpan atau kirim lokasi ke email Anda
    // Contoh: Mengirim email
    $to = "alfinabn1211@example.com"; // Ganti dengan email Anda
    $subject = "Lokasi Pengguna";
    $message = "Latitude: " . $latitude . "\nLongitude: " . $longitude;
    $headers = "From: alfinabn1211@gmail.com"; // Ganti dengan alamat email yang valid

    if (mail($to, $subject, $message, $headers)) {
        echo "Lokasi berhasil dikirim.";
    } else {
        echo "Gagal mengirim lokasi.";
    }
} else {
    echo "Tidak ada data yang diterima.";
}
?>
