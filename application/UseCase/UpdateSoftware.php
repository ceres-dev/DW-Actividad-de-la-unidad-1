<?php
class UpdateSoftware {
    public function __construct(private SoftwareRepository $repo) {}

    public function execute(Software $software) {
        $this->repo->update($software);
    }
}