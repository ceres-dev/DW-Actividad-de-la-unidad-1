<?php
class CreateSoftware {
    public function __construct(private SoftwareRepository $repo) {}

    public function execute($data) {
        $this->repo->save($data);
    }
}