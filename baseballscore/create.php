<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $opponent = $_POST['opponent'];
    
    $query = "INSERT INTO games (date, time, location, opponent) VALUES ('$date', '$time', '$location', '$opponent')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<h1>Tambah Pertandingan</h1>

<form method="POST" action="create.php">
    <label for="date">Tanggal:</label>
    <input type="date" name="date" required><br><br>
    
    <label for="time">Waktu:</label>
    <input type="text" name="time" required><br><br>
    
    <label for="location">Lokasi:</label>
    <input type="text" name="location" required><br><br>
    
    <label for="opponent">Lawan:</label>
    <input type="text" name="opponent" required><br><br>
    
    <input type="submit" value="Tambah">
</form>
