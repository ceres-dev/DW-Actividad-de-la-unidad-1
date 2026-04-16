<?php

require_once __DIR__ . '/../autoload.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$repo = new MySQLSoftwareRepository();
$list = new ListSoftware($repo);
$create = new CreateSoftware($repo);
$update = new UpdateSoftware($repo);
$delete = new DeleteSoftware($repo);

$numBits = filter_input(INPUT_POST, 'numBits', FILTER_VALIDATE_INT);

if ($numBits === false) {
    die("numBits inválido");
}

// CREAR
if (isset($_POST['create'])) {
    $software = new Software(
        null,
        $_POST['nombre'],
        $_POST['proveedor'],
        $_POST['categoria'],
        $_POST['lenguajePrincipal'],
        $_POST['lenguajeSecundario'],
        (int) isset($_POST['usaBd']),
        (int) isset($_POST['requiereConexionRed']),
        $_POST['numBits'],
        $_POST['sistemaOperativo'],
        $_POST['requisitosHardware'],
        $_POST['licencia'],
        $_POST['precio'],
        $_POST['descripcion'],
        $_POST['web'],
        $_POST['correo'],
        $_POST['tamanoInstalador']
    );

    $create->execute($software);
}

// ELIMINAR
if (isset($_GET['delete'])) {
    $delete->execute($_GET['delete']);
}

// ACTUALIZAR
if (isset($_POST['update'])) {
    $software = new Software(
        $_POST['id'],
        $_POST['nombre'],
        $_POST['proveedor'],
        $_POST['categoria'],
        $_POST['lenguajePrincipal'],
        $_POST['lenguajeSecundario'],
        (int) isset($_POST['usaBd']),
        (int) isset($_POST['requiereConexionRed']),
        $_POST['numBits'],
        $_POST['sistemaOperativo'],
        $_POST['requisitosHardware'],
        $_POST['licencia'],
        $_POST['precio'],
        $_POST['descripcion'],
        $_POST['web'],
        $_POST['correo'],
        $_POST['tamanoInstalador']
    );

    $update->execute($software);
}

$softwares = $list->execute();
?>

<h2>Crear Software</h2>
<form method="POST">
    <input name="nombre" placeholder="Nombre">
    <input name="proveedor" placeholder="Proveedor">
    <input name="categoria" placeholder="Categoria">
    <input name="lenguajePrincipal" placeholder="Lenguaje Principal">
    <input name="lenguajeSecundario" placeholder="Lenguaje Secundario">
    <label><input type="checkbox" name="usaBd"> Usa BD</label>
    <label><input type="checkbox" name="requiereConexionRed"> Red</label>
    <input name="numBits" placeholder="Bits">
    <input name="sistemaOperativo" placeholder="SO">
    <input name="requisitosHardware" placeholder="requisitos Hardware">
    <input name="licencia" placeholder="Licencia">
    <input name="precio" placeholder="Precio">
    <input name="descripcion" placeholder="Descripcion">
    <input name="web" placeholder="Web">
    <input name="correo" placeholder="Correo">
    <input name="tamanoInstalador" placeholder="Tamaño">
    <button name="create">Crear</button>
</form>

<h2>Lista</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($softwares as $s): ?>
        <tr>
            <td><?= $s->id ?></td>
            <td><?= $s->nombre ?></td>
            <td>
                <a href="?delete=<?= $s->id ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>