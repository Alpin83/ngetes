<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Ganti dengan alamat email Anda
    $to = "alfinabn1211@example.com"; 
    $subject = "Lokasi Pengguna";
    $message = "Latitude: " . $latitude . "\nLongitude: " . $longitude;
    $headers = "From: your_email@example.com"; // Ganti dengan alamat email yang valid

    // Mengirim email
    if (mail($to, $subject, $message, $headers)) {
        echo "Lokasi berhasil dikirim ke email.";
    } else {
        echo "Gagal mengirim lokasi.";
    }

    // Menyimpan lokasi ke GitHub
    saveToGitHub($latitude, $longitude);
} else {
    echo "Tidak ada data yang diterima.";
}

function saveToGitHub($latitude, $longitude) {
    $url = 'https://api.github.com/repos/Alpin83/ngetes/contents/locations.json'; // Ganti dengan URL yang sesuai
    $data = json_encode(['message' => 'Add location', 'content' => base64_encode(json_encode(['latitude' => $latitude, 'longitude' => $longitude]))]);

    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\n" .
                         "Authorization: token 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\r\n" . // Ganti dengan token GitHub Anda
                         "User -Agent: PHP\r\n",
            'method'  => 'PUT',
            'content' => $data,
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
        echo "Gagal menyimpan lokasi ke GitHub.";
    } else {
        echo "Lokasi berhasil disimpan ke GitHub.";
    }
}
?>
