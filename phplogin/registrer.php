<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Change this to your connection info.
    $host = '172.20.128.61';
    $user = 'brage';
    $pass = 'drlig7i0';
    $db = 'Login_side';
    // Try and connect using the info above.
    $con = mysqli_connect($host, $user, $pass, $db);
    
    // Sjekk tilkobling
    if ($conn->connect_error) {
        die("Tilkoblingsfeil: " . $conn->connect_error);
    }

    // Hent data fra skjemaet
    $brukernavn = $_POST['brukernavn'];
    $passord = password_hash($_POST['passord'], PASSWORD_DEFAULT); // Hasher passordet

    // Sett inn bruker i databasen
    $sql = "INSERT INTO brukere (brukernavn, passord) VALUES ('$brukernavn', '$passord')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Bruker registrert! <a href='login.php'>Logg inn her</a>";
    } else {
        echo "Feil: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Registrering</title>
</head>
<body>
    <h1>Registrer deg</h1>
    <form action="registrer.php" method="POST">
        <input type="text" name="brukernavn" placeholder="Brukernavn" required>
        <input type="password" name="passord" placeholder="Passord" required>
        <button type="submit">Registrer</button>
    </form>
</body>
</html>