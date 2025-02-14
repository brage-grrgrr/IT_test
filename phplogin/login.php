<?php
session_start(); // Start en sesjon for å huske brukeren

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Koble til databasen
    $host = "172.20.128.61";
    $user = "brage";
    $pass = "drlig7i0";
    $db = "Login_side";
    
    $con = mysqli_connect($host, $user, $pass, $db);

    // Sjekk tilkobling
    if ($conn->connect_error) {
        die("Tilkoblingsfeil: " . $conn->connect_error);
    }

    // Hent data fra skjemaet
    $brukernavn = $_POST['brukernavn'];
    $passord = $_POST['passord'];

    // Sjekk om brukeren finnes i databasen
    $sql = "SELECT * FROM brukere WHERE brukernavn = '$brukernavn'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Bruker finnes, sjekk passordet
        $row = $result->fetch_assoc();
        if (password_verify($passord, $row['passord'])) {
            // Passordet er riktig, lagre brukerens info i sesjonen
            $_SESSION['bruker_id'] = $row['id'];
            $_SESSION['brukernavn'] = $row['brukernavn'];
            header("Location: welcome.php"); // Omviderer til velkomstside
            exit();
        } else {
            echo "Feil brukernavn eller passord.";
        }
    } else {
        echo "Feil brukernavn eller passord.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Logg inn</title>
</head>
<body>
    <h1>Logg inn</h1>
    <form action="login.php" method="POST">
        <input type="text" name="brukernavn" placeholder="Brukernavn" required>
        <input type="password" name="passord" placeholder="Passord" required>
        <button type="submit">Logg inn</button>
    </form>
</body>
</html>
