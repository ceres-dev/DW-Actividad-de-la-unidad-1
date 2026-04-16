<?php
interface SoftwareRepository {
    public function save(Software $software): void;
    public function findAll(): array;
    public function findById(int $id): ?Software;
    public function update(Software $software): void;
    public function delete(int $id): void;
}