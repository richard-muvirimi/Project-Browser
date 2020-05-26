<?php

class Projects_Model extends \CI_Model {

    public function getDirs() {
        $dirs = array_filter(directory_map("../", 1), array(
            $this,
            'filterDirs'
        ));

        return array_values($dirs);
    }

    function filterDirs($filename) {
        return is_dir(dirname(FCPATH) . DIRECTORY_SEPARATOR . $filename) && basename($filename) != basename(FCPATH);
    }

    public function getRawName($path) {
        return basename($path);
    }

    public function getAnchor($path) {
        return anchor($this->getUrl($path), $this->getProperName($path));
    }

    public function getProperName($path) {
        return ucfirst($this->getRawName($path));
    }

    public function getUrl($path) {
        return base_url("/") . "../" . $this->getRawName($path);
    }

}
