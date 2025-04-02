<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $host = 'localhost';
    $user = 'brage';
    $pass = 'drlig7i0';
    $db = 'Login_side';

    $con = mysqli_connect($host, $user, $pass, $db);
    
    // Sjekk tilkobling
    if ($con->connect_error) {
        die("Tilkoblingsfeil: " . $con->connect_error);
    }

    // Hent data fra skjemaet
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hasher passordet
    $email = $_POST['email'];

    // skjeker om emailen finnes fra før av i databasen
    $usernameverifisiering = "SELECT * FROM accounts WHERE username = '$username'";
    $result = $con->query($usernameverifisiering);
    
    
    if ($result->num_rows > 0) {
        echo "Det finnes allerede en bruker med dette navnet" . $con->error;
    } else {
        // hvis det fungerer så vil den nye brukeren bli insertet inn i databasen
        $sql = "INSERT INTO accounts (username, password, email) VALUES ('$username', '$password', '$email')";
    }
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