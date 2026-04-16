<?php
class MySQLSoftwareRepository implements SoftwareRepository {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function save(Software $s): void {
        $stmt = $this->db->prepare("
            INSERT INTO software (
                nombre, proveedor, categoria, lenguajePrincipal, lenguajeSecundario,
                usaBd, requiereConexionRed, numBits, sistemaOperativo,
                requisitosHardware, licencia, precio, descripcion,
                web, correo, tamanoInstalador
            ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ");

        $stmt->execute([
            $s->nombre, $s->proveedor, $s->categoria,
            $s->lenguajePrincipal, $s->lenguajeSecundario,
            $s->usaBd, $s->requiereConexionRed,
            $s->numBits, $s->sistemaOperativo,
            $s->requisitosHardware, $s->licencia,
            $s->precio, $s->descripcion,
            $s->web, $s->correo, $s->tamanoInstalador
        ]);
    }

    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM software");
        $data = $stmt->fetchAll();

        return array_map(fn($row) => $this->map($row), $data);
    }

    public function findById(int $id): ?Software {
        $stmt = $this->db->prepare("SELECT * FROM software WHERE id=?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        return $row ? $this->map($row) : null;
    }

    public function update(Software $s): void {
        $stmt = $this->db->prepare("
            UPDATE software SET
                nombre=?, proveedor=?, categoria=?, lenguajePrincipal=?, lenguajeSecundario=?,
                usaBd=?, requiereConexionRed=?, numBits=?, sistemaOperativo=?,
                requisitosHardware=?, licencia=?, precio=?, descripcion=?,
                web=?, correo=?, tamanoInstalador=?
            WHERE id=?
        ");

        $stmt->execute([
            $s->nombre, $s->proveedor, $s->categoria,
            $s->lenguajePrincipal, $s->lenguajeSecundario,
            $s->usaBd, $s->requiereConexionRed,
            $s->numBits, $s->sistemaOperativo,
            $s->requisitosHardware, $s->licencia,
            $s->precio, $s->descripcion,
            $s->web, $s->correo, $s->tamanoInstalador,
            $s->id
        ]);
    }

    public function delete(int $id): void {
        $stmt = $this->db->prepare("DELETE FROM software WHERE id=?");
        $stmt->execute([$id]);
    }

    private function map($row): Software {
        return new Software(
            $row['id'],
            $row['nombre'],
            $row['proveedor'],
            $row['categoria'],
            $row['lenguajePrincipal'],
            $row['lenguajeSecundario'],
            (bool)$row['usaBd'],
            (bool)$row['requiereConexionRed'],
            (int)$row['numBits'],
            $row['sistemaOperativo'],
            $row['requisitosHardware'],
            $row['licencia'],
            (float)$row['precio'],
            $row['descripcion'],
            $row['web'],
            $row['correo'],
            $row['tamanoInstalador']
        );
    }
}