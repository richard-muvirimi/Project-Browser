<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * http://example.com/index.php/welcome
     * - or -
     * http://example.com/index.php/welcome/index
     * - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data = array();
        $data['table'] = $this->prepareData();

        $this->load->view('projects', $data);
    }

    public function __construct()
    {
        parent::__construct();

        // load Models
        $this->load->model('Projects_Model');

        // load helpers
        $this->load->helper('url');
        $this->load->helper('directory');

        // load libraries
        $this->load->library('table');
    }

    public function prepareData()
    {
        /**
         *
         * @var Projects_Model $projects
         */
        $projects = $this->Projects_Model;

        $this->table->set_heading('#', 'Project', 'Title', 'Render Time');

        $dirs = $projects->getDirs();

        //sort directories
        sort($dirs, SORT_STRING | SORT_FLAG_CASE);

        $count = count($dirs);
        for ($i = 0; $i < $count; $i++) {

            $numberCell = array('data' => $i + 1, 'class' => 'number');
            $projectCell = array('data' => $projects->getAnchor($dirs[$i]), 'class' => 'project');
            $titleCell = array('data' => '...', 'class' => 'title');
            $timeCell = array('data' => '...', 'class' => 'time');

            $this->table->add_row($numberCell, $projectCell, $titleCell, $timeCell);
        }

        return $this->table->generate();
    }

}
