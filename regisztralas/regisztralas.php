<?php
session_start();
require_once '../config.php';

// Ellenőrizzük, hogy a felhasználó már be van-e jelentkezve
if (isset($_SESSION['username'])) {
    echo '
    <div style="background-color: rgba(255, 0, 0, 0.5); padding: 20px; color: white; text-align: center; font-size: 24px;">
        Már be vagy regisztrálva!<br><br>
        <a href="../fooldal/index.php" style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Vissza a főoldalra</a>
    </div>';
    exit();
}

// Regisztrációs űrlap elküldése
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ellenőrizzük, hogy a felhasználónév és az e-mail egyediek legyenek
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Ha a felhasználónév vagy az e-mail már foglalt, hibaüzenet
        echo "A felhasználónév vagy az e-mail már foglalt.";
        exit();
    }

    // Jelszó hashelése
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Felhasználó létrehozása az adatbázisban
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    
    if ($stmt->execute()) {
        // Sikeres regisztráció után irányítás a bejelentkezési oldalra
        header("Location: ../bejelentkezes/belepes.php");
        exit();
    } else {
        echo "Hiba történt a regisztráció során.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>

    <div class="content">
        <h1>Regisztráció</h1>
        <form action="../regisztralas/regisztralas.php" method="post">
            <label for="username">Felhasználónév:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">E-mail cím:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Jelszó:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="register">Regisztráció</button>
        </form>
    </div>
</body>
</html>
