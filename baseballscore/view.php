<?php
require_once 'db_config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM games WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        echo "<h1>Detail Pertandingan</h1>";
        echo "<p><strong>Tanggal:</strong> " . $row['date'] . "</p>";
        echo "<p><strong>Waktu:</strong> " . $row['time'] . "</p>";
        echo "<p><strong>Lokasi:</strong> " . $row['location'] . "</p>";
        echo "<p><strong>Lawan:</strong> " . $row['opponent'] . "</p>";
    } else {
        echo "Pertandingan tidak ditemukan.";
    }
} else {
    echo "Pertandingan tidak ditemukan.";
}

mysqli_close($conn);
?>
