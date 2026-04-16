<?php
class DeleteSoftware {
    public function __construct(private SoftwareRepository $repo) {}

    public function execute(int $id) {
        $this->repo->delete($id);
    }
}