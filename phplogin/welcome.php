<?php
session_start();


if (!isset($_SESSION['bruker_id'])) {
    header("Location: login.php");
    exit();
}
echo "Color stored in session: " . $_SESSION['color']; // Debugging output
$color = isset($_SESSION['color']) ? $_SESSION['color'] : '#FFFFFF';

?>



<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>rasputin</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
body {
    background-color: <?php echo htmlspecialchars($color); ?>;
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
    <script src="Javascript.Js"></script>
</body>
</html>