<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $opponent = $_POST['opponent'];
    
    $query = "UPDATE games SET date='$date', time='$time', location='$location', opponent='$opponent' WHERE id='$id'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM games WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $date = $row['date'];
        $time = $row['time'];
        $location = $row['location'];
        $opponent = $row['opponent'];
    } else {
        echo "Pertandingan tidak ditemukan.";
        exit();
    }
}

mysqli_close($conn);
?>

<h1>Edit Pertandingan</h1>

<form method="POST" action="edit.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    
    <label for="date">Tanggal:</label>
    <input type="date" name="date" value="<?php echo $date; ?>" required><br><br>
    
    <label for="time">Waktu:</label>
    <input type="text" name="time" value="<?php echo $time; ?>" required><br><br>
    
    <label for="location">Lokasi:</label>
    <input type="text" name="location" value="<?php echo $location; ?>" required><br><br>
    
    <label for="opponent">Lawan:</label>
    <input type="text" name="opponent" value="<?php echo $opponent; ?>" required><br><br>
    
    <input type="submit" value="Simpan">
</form>
