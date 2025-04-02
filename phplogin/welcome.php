<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['bruker_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$host = "localhost";
$user = "brage";
$pass = "drlig7i0";
$db = "Login_side";
$con = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Retrieve the user's color from the database
$color = '#FFFFFF'; // Default color
if (isset($_SESSION['bruker_id'])) {
    // Query to get the user's color
    $result = $con->query("SELECT color FROM accounts WHERE id = " . $_SESSION['bruker_id']);
    
    if ($result && $row = $result->fetch_assoc()) {
        $color = $row['color'];
    }
}

// Update the user's color if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['color'])) {
    $selectedColor = $_POST['color'];
    
    // Directly update the color in the database without prepared statements
    $query = "UPDATE accounts SET color = '$selectedColor' WHERE id = " . $_SESSION['bruker_id'];
    
    if ($con->query($query)) {
        // Update the color in the session as well
        $_SESSION['color'] = $selectedColor;
    } else {
        echo "Error updating color: " . $con->error;
    }
}

// Close the database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>rasputin</title>
    <link rel="stylesheet" href="style.css?v=1.0">
</head>
<style>
body {
    background-color: <?php echo isset($_SESSION['color']) ? $_SESSION['color'] : '#FFFFFF'; ?>;
}
</style>
<body>
    <h1>Jukse ark</h1>
    <div class="topnav">
        <button onclick="Bilder('0')" class="button">L'Hopitals regel</button>
        <button onclick="Bilder('1')" class="button">Produktregelen</button>
        <button onclick="Bilder('2')" class="button">Brøkregelen</button>
        <button onclick="Bilder('3')" class="button">Newtons metode</button>
        <button onclick="Bilder('4')" class="button">Vendepunkter</button>
        <button onclick="Bilder('5')" class="button">Krumning</button>
    </div>


    <div class="imgbox">
        <img id="myImg" src="#" width="200" height="200">
    </div>

    <div class="simplebox">
        <p>uguhgugsgdiug segd</p>
    </div>

    <!-- Form to change color -->
    <form action="welcome.php" method="POST">
        <input type="color" name="color" placeholder="color" value="<?php echo $color; ?>" required>
        <button type="submit">Registrer</button>
    </form>

    <script src="Javascript.Js"></script>
</body>
</html>