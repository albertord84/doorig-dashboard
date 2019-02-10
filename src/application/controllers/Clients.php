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
    }

    public function index() {

        var_dump("Thanks God!");

        $this->load->view('clients_view');
    }

}

?>

