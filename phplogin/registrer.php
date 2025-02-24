<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Change this to your connection info.
    $host = 'localhost';
    $user = 'brage';
    $pass = 'drlig7i0';
    $db = 'Login_side';
    // Try and connect using the info above.
    $con = mysqli_connect($host, $user, $pass, $db);
    
    // Sjekk tilkobling
    if ($con->connect_error) {
        die("Tilkoblingsfeil: " . $con->connect_error);
    }

    // Hent data fra skjemaet
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hasher passordet
    $email = $_POST['email'];

    // Sett inn bruker i databasen
    $sql = "INSERT INTO accounts (username, password, email) VALUES ('$username', '$password', '$email')";
    
    if ($con->query($sql) === TRUE) {
        echo "Bruker registrert! <a href='login.php'>Logg inn her</a>";
    } else {
        echo "Feil: " . $con->error;
    }

    $con->close();
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
        <input type="text" name="username" placeholder="usernam" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="text" name="email" placeholder="email" required>
        <button type="submit">Registrer</button>
    </form>
</body>
</html>