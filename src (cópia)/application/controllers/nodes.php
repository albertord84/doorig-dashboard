<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**

 * Desarrollo del controlador: nodesController

 *

 * @author Grupo Nobel, Desarrolladores: Daniel M. Garcia Fernandez - Onel Rosello Reyes

 */
class Nodes extends CI_Controller {

    function __construct() {

        parent::__construct();



        $this->load->helper('url');

        $this->load->helper('form');

        $this->load->helper('html');

        $this->load->model('nodes_model', 'nodes');

        $this->load->database();
    }

    public function index() {



        $this->load->view('nodes_view');
    }

    public function combogrid() {



        $items = $this->nodes->all();

        $result = array();

        $result["rows"] = $items;

        echo json_encode($result);
    }

    public function ajaxgrid() {



        $pages = $_POST['page'];

        $rows = $_POST['rows'];

        $offset = ($pages - 1) * $rows;

        $items = $this->nodes->collection($rows, $offset);

        $result = array();

        $result["rows"] = $items;

        $result["total"] = $this->db->count_all('nodes');



        echo json_encode($result);
    }

    public function load() {

        $items = $this->nodes->load($this->uri->segment(3));



        echo json_encode($items);
    }

    public function save() {

        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $ip = $this->input->post('ip');
        $url = $this->input->post('url');


        $this->nodes->save($name, $description, $ip, $url);
    }

    public function update() {

        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $ip = $this->input->post('ip');
        $url = $this->input->post('url');


        $id = $this->uri->segment(3);

        $this->nodes->update($id, $name, $description, $ip, $url);
    }

    public function delete() {



        $this->nodes->delete($this->uri->segment(3));
    }

}
?>

