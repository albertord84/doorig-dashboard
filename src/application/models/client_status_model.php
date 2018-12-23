<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**

 * @category CodeIgniter-Model: client_status_Model

 * 

 * @access public

 * @todo <description>

 * 

 */
class Client_status_model extends CI_Model {

    function construct() {

        parent::construct();
    }

    function save($name, $description) {

        $this->name = $name;
        $this->description = $description;


        $this->db->insert('client_status', $this);



        return $this->db->insert_id();
    }

    function remove($id) {

        $this->db->delete('client_status', array('id' => $id));
    }

    function update($id, $name, $description) {

        $this->name = $name;
        $this->description = $description;


        $this->db->update('client_status', $this, array('id' => $id));
    }

    function get_by_id($id) {

        $this->db->where('id', $id);

        $query = $this->db->get('client_status');



        return $query->row();
    }

    function get_all() {

        $this->db->select('*')->from('client_status');

        //$this->db->order_by('<field>', '<type>'); ==> asc/desc

        $query = $this->db->get();



        return $query->result();
    }

}
?>

