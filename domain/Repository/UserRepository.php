<?php
interface UserRepository {
    public function findByUsername(string $username): ?User;
    public function updatePassword(int $id, string $password): void;
}