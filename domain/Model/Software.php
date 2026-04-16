<?php
class Software {
    public function __construct(
        public ?int $id,
        public string $nombre,
        public string $proveedor,
        public string $categoria,
        public string $lenguajePrincipal,
        public string $lenguajeSecundario,
        public bool $usaBd,
        public bool $requiereConexionRed,
        public int $numBits,
        public string $sistemaOperativo,
        public string $requisitosHardware,
        public string $licencia,
        public float $precio,
        public string $descripcion,
        public string $web,
        public string $correo,
        public string $tamanoInstalador
    ) {}
}