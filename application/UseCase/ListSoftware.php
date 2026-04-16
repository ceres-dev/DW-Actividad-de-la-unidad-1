<?php
class ListSoftware {
    public function __construct(private SoftwareRepository $repo) {}

    public function execute() {
        return $this->repo->findAll();
    }
}