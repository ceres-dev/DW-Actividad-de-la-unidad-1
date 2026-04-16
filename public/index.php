<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

echo "<h1>Panel</h1>";
echo "<a href='software.php'>Gestionar Software</a><br>";
echo "<a href='dashboard.php'>Cambiar contraseña</a>";