<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**

 * @category CodeIgniter-Model: clients_Model

 * 

 * @access public

 * @todo <description>

 * 

 */
class Clients_model extends CI_Model {

    function construct() {

        parent::construct();
    }

    function save($id, $pay_id = NULL, $login_token = NULL) {

        $this->id = $id;
        $this->pay_id = $pay_id;
        $this->login_token = $login_token;


        $this->db->insert('clients', $this);



        return $this->db->insert_id();
    }

    function remove($id) {

        $this->db->delete('clients', array('id' => $id));
    }

    function update($id, $pay_id = NULL, $login_token = NULL) {

        if ($pay_id)
            $this->pay_id = $pay_id;
        if ($login_token)
            $this->login_token = $login_token;


        $this->db->update('clients', $this, array('id' => $id));
    }

    function get_by_id($id) {

        $this->db->where('id', $id);

        $query = $this->db->get('clients');



        return $query->row();
    }

    function get_by_login_token(string $login_token) {

        $this->db->where('login_token', $login_token);

        $query = $this->db->get('clients');

        return $query->last_row();
    }

    function get_by_doorig_client_id(int $client_id) {

        $this->db->where('doorig_id', $client_id);

        $query = $this->db->get('clients');

        return $query->last_row();
    }
    
    function get_all() {

        $this->db->select('*')->from('clients');

        //$this->db->order_by('<field>', '<type>'); ==> asc/desc

        $query = $this->db->get();



        return $query->result();
    }

}
?>

