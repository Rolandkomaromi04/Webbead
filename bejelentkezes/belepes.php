<?php
session_start();
if (isset($_SESSION['username'])) {
    echo '<div style="background-color: rgba(255, 0, 0, 0.5); padding: 20px; color: white; text-align: center; font-size: 24px;">Már be vagy jelentkezve!<br><br><a href="../fooldal/index.php" style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Vissza a főoldalra</a></div>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="icon.jpg">
    <title>Bejelentkezés</title>
</head>
<body>

    <div class="container">
        <h1>Bejelentkezés</h1>
        <form action="bejelentkezesell.php" method="POST">
            <label for="username">Felhasználónév:</label>
            <input type="text" id="username" name="username">
            <label for="password">Jelszó:</label>
            <input type="password" id="password" name="password">
            <input type="submit" value="Bejelentkezés">
        </form>
        <br>
        <a href="../index.php" class="my-button">Vissza a főoldalra</a>
    </div>
</body>
</html>
