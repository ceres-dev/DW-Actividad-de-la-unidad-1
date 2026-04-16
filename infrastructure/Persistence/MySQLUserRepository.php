<?php
class MySQLUserRepository implements UserRepository {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function findByUsername(string $username): ?User {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);

        $data = $stmt->fetch();

        if (!$data) return null;

        return new User($data['id'], $data['username'], $data['password']);
    }

    public function updatePassword(int $id, string $password): void {
        $stmt = $this->db->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->execute([$password, $id]);
    }
}