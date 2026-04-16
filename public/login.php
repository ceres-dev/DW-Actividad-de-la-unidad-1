<?php
session_start();

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../infrastructure/Database.php';
require_once __DIR__ . '/../domain/Model/User.php';
require_once __DIR__ . '/../domain/Repository/UserRepository.php';
require_once __DIR__ . '/../infrastructure/Persistence/MySQLUserRepository.php';
require_once __DIR__ . '/../application/UseCase/LoginUser.php';

$repo = new MySQLUserRepository();
$login = new LoginUser($repo);

if ($_POST) {
    $user = $login->execute($_POST['user'], $_POST['pass']);

    if ($user) {
        $_SESSION['user'] = $user->id;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Login incorrecto";
    }
}

?>

<form method="POST">
    <input name="user" placeholder="Usuario">
    <input type="password" name="pass" placeholder="Contraseña">
    <button>Login</button>
</form>

