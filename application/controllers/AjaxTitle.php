<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AjaxTitle extends CI_Controller {

    public function index() {

        $url = filter_input(INPUT_GET, 'l');

        $this->benchmark->mark('start');

        $html = file_get_contents($this->_prepareUrl($url));

        $this->benchmark->mark('end');

        echo json_encode(array(
            'title' => $this->_getTitle($html),
            'time' => round($this->benchmark->elapsed_time('start', 'end'), 2)
        ));
    }

    private function _prepareUrl($url) {
        return str_replace(" ", '%20', $url);
    }

    private function _getTitle($html) {
        $start = strpos($html, '<title>') + strlen('<title>');
        $end = strpos($html, '</title>');

        if ($start && $end) {
            return substr($html, $start, $end - $start);
        } else {
            return 'No Title';
        }
    }

}
