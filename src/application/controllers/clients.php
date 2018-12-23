<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**

 * Desarrollo del controlador: clientsController

 *

 * @author Grupo Nobel, Desarrolladores: Daniel M. Garcia Fernandez - Onel Rosello Reyes

 */
class Clients extends CI_Controller {

    function __construct() {

        parent::__construct();



        $this->load->helper('url');

        $this->load->helper('form');

        $this->load->helper('html');

        $this->load->model('clients_model', 'clients');

        $this->load->database();
    }

    public function index() {



        $this->load->view('clients_view');
    }

    public function combogrid() {



        $items = $this->clients->all();

        $result = array();

        $result["rows"] = $items;

        echo json_encode($result);
    }

    public function ajaxgrid() {



        $pages = $_POST['page'];

        $rows = $_POST['rows'];

        $offset = ($pages - 1) * $rows;

        $items = $this->clients->collection($rows, $offset);

        $result = array();

        $result["rows"] = $items;

        $result["total"] = $this->db->count_all('clients');



        echo json_encode($result);
    }

    public function load() {

        $items = $this->clients->load($this->uri->segment(3));



        echo json_encode($items);
    }

    public function save() {

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $status_id = $this->input->post('status_id');
        $node_id = $this->input->post('node_id');
        $phone = $this->input->post('phone');
        $verification_code = $this->input->post('verification_code');
        $init_date = $this->input->post('init_date');
        $last_access = $this->input->post('last_access');
        $utm_source = $this->input->post('utm_source');
        $utm_campain = $this->input->post('utm_campain');
        $login_token = $this->input->post('login_token');


        $this->clients->save($name, $email, $password, $status_id, $node_id, $phone, $verification_code, $init_date, $last_access, $utm_source, $utm_campain, $login_token);
    }

    public function update() {

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $status_id = $this->input->post('status_id');
        $node_id = $this->input->post('node_id');
        $phone = $this->input->post('phone');
        $verification_code = $this->input->post('verification_code');
        $init_date = $this->input->post('init_date');
        $last_access = $this->input->post('last_access');
        $utm_source = $this->input->post('utm_source');
        $utm_campain = $this->input->post('utm_campain');
        $login_token = $this->input->post('login_token');


        $id = $this->uri->segment(3);

        $this->clients->update($id, $name, $email, $password, $status_id, $node_id, $phone, $verification_code, $init_date, $last_access, $utm_source, $utm_campain, $login_token);
    }

    public function delete() {



        $this->clients->delete($this->uri->segment(3));
    }

}
?>

