<?php

require_once __DIR__ . '/../autoload.php';
session_start();

$repo = new MySQLUserRepository();
$change = new ChangePassword($repo);

if ($_POST) {
    $change->execute($_SESSION['user'], $_POST['newpass']);
    echo "Contraseña actualizada";
}
?>

<form method="POST">
    <input type="password" name="newpass" placeholder="Nueva contraseña">
    <button>Cambiar</button>
</form>