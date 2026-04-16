<?php
class ChangePassword {
    public function __construct(private UserRepository $repo) {}

    public function execute($userId, $newPassword) {
        $hash = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->repo->updatePassword($userId, $hash);
    }
}