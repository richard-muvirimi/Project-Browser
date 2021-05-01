<?php

namespace App\Controllers;

class Install extends BaseController
{

    public function __construct()
    {
        helper('filesystem');
    }

    public function index()
    {

        //copy htacess file
        $source = root_dir(basename(base_url()) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "install" . DIRECTORY_SEPARATOR . "index.php");
        $destination = root_dir(DIRECTORY_SEPARATOR . "index.php");

        if (file_exists($destination) && strtolower($this->request->getGet("force")) != "true") {
            echo "We are already good to go. Add a get varaible 'force=true'  to force reinstall.";
        } else {
            if (write_file($destination, file_get_contents($source))) {
                echo "Success, you are good to go";
            } else {
                //try copy
                try {
                    copy($source, $destination);
                    echo "Success, you are good to go";
                } catch (\Exception $e) {
                    echo "Failed to write file. you may manually copy the 'index.php' file from public/install";
                }
            }
        }
    }
}