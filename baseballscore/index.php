<!DOCTYPE html>
<html>
<head>
    <title>Scorebook Baseball</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
    require_once 'db_config.php';

    $query = "SELECT * FROM games";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<h1>Scorebook Baseball</h1>";
        echo "<h2>Daftar Pertandingan</h2>";
        
        echo "<table>";
        echo "<tr><th>Tanggal</th><th>Waktu</th><th>Lokasi</th><th>Lawan</th></tr>";
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['time'] . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . $row['opponent'] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<h1>Scorebook Baseball</h1>";
        echo "<h2>Daftar Pertandingan</h2>";
        echo "Belum ada pertandingan yang dicatat.";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
