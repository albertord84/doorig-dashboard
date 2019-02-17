<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**

 * @category CodeIgniter-Model: clients_modules_Model

 * 

 * @access public

 * @todo <description>

 * 

 */
class Clients_modules_model extends CI_Model {

    public $client_id;

    function construct() {

        parent::construct();
    }

    function set_client_id($client_id) {
        $this->client_id = $client_id;
    }

    function save($client_id, $module_id, $active = NULL, $init_date = NULL, $end_date = NULL, $login_token = NULL) {

        $this->client_id = $client_id;
        $this->module_id = $module_id;
        $this->active = $active;
        $this->init_date = $init_date ? $init_date : time();
        $this->end_date = $end_date;
        $this->login_token = $login_token;


        try {
            $this->db->insert('clients_modules', $this);
        } catch (\Error $e) {
            if ($this->db->error()['code'] != 0) {
                throw new \Db_Exception($this->db->error(), $e);
            } else {
                throw $e;
            }
        }


        return $this->db->insert_id();
    }

    function remove($id) {

        $this->db->delete('clients_modules', array('id' => $id));
    }

    function update($id, $client_id, $module_id, $active = NULL, $init_date = NULL, $end_date = NULL, $login_token = NULL) {

        if ($client_id)
            $this->client_id = $client_id;
        if ($module_id)
            $this->module_id = $module_id;
        if ($active)
            $this->active = $active;
        if ($init_date)
            $this->init_date = $init_date;
        if ($end_date)
            $this->end_date = $end_date;
        if ($login_token)
            $this->login_token = $login_token;

        try {
            $this->db->update('clients_modules', $this, array('id' => $id));
        } catch (\Error $e) {
            if ($this->db->error()['code'] != 0) {
                throw new \Db_Exception($this->db->error(), $e);
            } else {
                throw $e;
            }
        }
    }

    function get_by_id($id) {

        $this->db->where('id', $id);

        $query = $this->db->get('clients_modules');



        return $query->row();
    }

    function get_by_module_id($module_id) {

        $this->db->where('client_id', $this->client_id);
        $this->db->where('module_id', $module_id);
        
        //$this->db->join('modules', "modules.id = clients_modules.module_id");

        $query = $this->db->get('clients_modules');



        return $query->last_row();
    }

    function get_all($active = NULL) {

        if ($active !== NULL) {
            $this->db->where('active', $active);
        }

        $this->db->where('client_id', $this->client_id);

        $this->db->select('*')->from('clients_modules');

        //$this->db->order_by('<field>', '<type>'); ==> asc/desc

        $query = $this->db->get();



        return $query->result();
    }

}
?>

