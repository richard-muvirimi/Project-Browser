<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the frameworks
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @link: https://codeigniter4.github.io/CodeIgniter4/
 */

function assets_url($path = "")
{
    return base_url("public/assets" . DIRECTORY_SEPARATOR . $path);
}

function basedir()
{
    return basename(base_url());
}

function root_dir($path = "", $target = "")
{

    if ($target == "") {
        $target = basedir();
    }

    $paths = new \Config\Paths();

    $dir = realpath($paths->systemDirectory);

    while (basename($dir) != $target && dirname($dir)) {
        $dir = dirname($dir);
    }

    return dirname($dir) . (strlen($path) == 0 ? "" :  DIRECTORY_SEPARATOR . trim($path, "\\/"));
}

function root_url($path = "", $target = "")
{

    if ($target == "") {
        $target = basedir();
    }

    $url = base_url();

    while (basename($url) != $target && dirname($url)) {
        $url = dirname($url);
    }

    return dirname($url) . (strlen($path) == 0 ? "" :  "/" . trim($path, "\\/"));
}