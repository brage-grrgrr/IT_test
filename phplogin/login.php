<?php
session_start(); // Start en sesjon for å huske brukeren

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Koble til databasen
    $host = "localhost";
    $user = "brage";
    $pass = "drlig7i0";
    $db = "Login_side";
    
    $con = mysqli_connect($host, $user, $pass, $db);

    // Sjekk tilkobling
    if ($con->connect_error) {
        die("Tilkoblingsfeil: " . $con->connect_error);
    }

    // Hent data fra skjemaet
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sjekk om brukeren finnes i databasen
    $sql = "SELECT * FROM accounts WHERE username = '$username'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Bruker finnes, sjekk passordet
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Passordet er riktig, lagre brukerens info i sesjonen
            $_SESSION['bruker_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: welcome.html"); // Omviderer til velkomstside
            exit();
        } else {
            echo "Feil username eller password.";
        }
    } else {
        echo "Feil username eller password.";
    }

    $con->close();
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
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="password" placeholder="password" required>
        <button type="submit">Logg inn</button>
    </form>
</body>
</html>
