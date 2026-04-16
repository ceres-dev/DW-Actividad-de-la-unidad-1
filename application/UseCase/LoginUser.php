<?php
class LoginUser {
    public function __construct(private UserRepository $repo) {}
    public function execute($username, $password): ?User {
        $user = $this->repo->findByUsername($username);

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return null;
    }
}