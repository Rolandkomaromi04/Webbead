<?php
$servername = "localhost";
$username = "fecske";
$password = "Fecske2024&";
$dbname = "fecske";

$menu = array(
    'Főoldal' => 'index.php',
    'Gondozottak' => 'gondozottak/gondozottak.php',
    'Elérhetőség' => 'Elerhetoseg/elerhetoseg.php',
    'Regisztráció' => 'regisztralas/regisztralas.php',
);
 
if (!empty($_POST['install'])) {
    $con = mysqli_connect($servername,$username,$password,$dbname);
    if (mysqli_connect_errno()) {
        $ServerErrors[] = "Failed to connect to MySQL: " . mysqli_connect_error();
    }
} 
?>