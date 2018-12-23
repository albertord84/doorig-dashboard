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

    function save($name, $email, $password, $status_id, $node_id, $phone, $verification_code, $init_date, $last_access, $utm_source, $utm_campain, $login_token) {

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->status_id = $status_id;
        $this->node_id = $node_id;
        $this->phone = $phone;
        $this->verification_code = $verification_code;
        $this->init_date = $init_date;
        $this->last_access = $last_access;
        $this->utm_source = $utm_source;
        $this->utm_campain = $utm_campain;
        $this->login_token = $login_token;


        $this->db->insert('clients', $this);



        return $this->db->insert_id();
    }

    function remove($id) {

        $this->db->delete('clients', array('id' => $id));
    }

    function update($id, $name, $email, $password, $status_id, $node_id, $phone, $verification_code, $init_date, $last_access, $utm_source, $utm_campain, $login_token) {

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->status_id = $status_id;
        $this->node_id = $node_id;
        $this->phone = $phone;
        $this->verification_code = $verification_code;
        $this->init_date = $init_date;
        $this->last_access = $last_access;
        $this->utm_source = $utm_source;
        $this->utm_campain = $utm_campain;
        $this->login_token = $login_token;


        $this->db->update('clients', $this, array('id' => $id));
    }

    function get_by_id($id) {

        $this->db->where('id', $id);

        $query = $this->db->get('clients');



        return $query->row();
    }

    function get_all() {

        $this->db->select('*')->from('clients');

        //$this->db->order_by('<field>', '<type>'); ==> asc/desc

        $query = $this->db->get();



        return $query->result();
    }

}
?>

