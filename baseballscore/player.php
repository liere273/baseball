<?php
require_once 'db_config.php';

// Fungsi untuk menambahkan pemain baru
function addPlayer($name, $position, $team_id) {
    global $conn;
    
    $query = "INSERT INTO players (name, position, team_id) VALUES ('$name', '$position', '$team_id')";
    
    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}

// Fungsi untuk mengedit informasi pemain
function editPlayer($player_id, $name, $position, $team_id) {
    global $conn;
    
    $query = "UPDATE players SET name='$name', position='$position', team_id='$team_id' WHERE id='$player_id'";
    
    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}

// Fungsi untuk menghapus pemain
function deletePlayer($player_id) {
    global $conn;
    
    $query = "DELETE FROM players WHERE id='$player_id'";
    
    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}

// Mendapatkan daftar pemain dari basis data
function getPlayers() {
    global $conn;
    
    $query = "SELECT * FROM players";
    $result = mysqli_query($conn, $query);
    
    $players = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $players[] = $row;
    }
    
    return $players;
}

// Mendapatkan informasi pemain berdasarkan ID
function getPlayerById($player_id) {
    global $conn;
    
    $query = "SELECT * FROM players WHERE id='$player_id'";
    $result = mysqli_query($conn, $query);
    
    $player = mysqli_fetch_assoc($result);
    
    return $player;
}

// Mendapatkan daftar tim dari basis data
function getTeams() {
    global $conn;
    
    $query = "SELECT * FROM teams";
    $result = mysqli_query($conn, $query);
    
    $teams = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $teams[] = $row;
    }
    
    return $teams;
}

// Proses pengiriman form untuk menambah atau mengedit pemain
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addPlayer'])) {
        $name = $_POST['name'];
        $position = $_POST['position'];
        $team_id = $_POST['team_id'];
        
        addPlayer($name, $position, $team_id);
        
        header("Location: players.php");
        exit();
    } elseif (isset($_POST['editPlayer'])) {
        $player_id = $_POST['player_id'];
        $name = $_POST['name'];
        $position = $_POST['position'];
        $team_id = $_POST['team_id'];
        
        editPlayer($player_id, $name, $position, $team_id);
        
        header("Location: players.php");
        exit();
    }
}

// Proses pengiriman form untuk menghapus pemain
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deletePlayer'])) {
    $player_id = $_POST['player_id'];
    
    deletePlayer($player_id);
    
    header("Location: players.php");
    exit();
}

// Mendapatkan daftar pemain
$players = getPlayers();

// Mendapatkan daftar tim
$teams = getTeams();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Scorebook Baseball - Manajemen Pemain</title>
</head>
<body>
    <h1>Scorebook Baseball</h1>
    <h2>Manajemen Pemain</h2>

    <!-- Form untuk menambah pemain -->
    <h3>Tambah Pemain</h3>
    <form method="POST" action="players.php">
        <input type="text" name="name" placeholder="Nama Pemain" required>
        <input type="text" name="position" placeholder="Posisi" required>
        <select name="team_id" required>
            <option value="">Pilih Tim</option>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team['id']; ?>"><?php echo $team['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="addPlayer" value="Tambah Pemain">
    </form>

    <!-- Daftar Pemain -->
    <h3>Daftar Pemain</h3>
    <table>
        <tr>
            <th>Nama</th>
            <th>Posisi</th>
            <th>Tim</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($players as $player): ?>
            <tr>
                <td><?php echo $player['name']; ?></td>
                <td><?php echo $player['position']; ?></td>
                <td><?php echo $player['team_id']; ?></td>
                <td>
                    <form method="POST" action="players.php">
                        <input type="hidden" name="player_id" value="<?php echo $player['id']; ?>">
                        <input type="submit" name="deletePlayer" value="Hapus">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
