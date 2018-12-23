<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**

 * @category CodeIgniter-Model: nodes_Model

 * 

 * @access public

 * @todo <description>

 * 

 */
class Nodes_model extends CI_Model {

    function construct() {

        parent::construct();
    }

    function save($name, $description, $ip, $url) {

        $this->name = $name;
        $this->description = $description;
        $this->ip = $ip;
        $this->url = $url;


        $this->db->insert('nodes', $this);



        return $this->db->insert_id();
    }

    function remove($id) {

        $this->db->delete('nodes', array('id' => $id));
    }

    function update($id, $name, $description, $ip, $url) {

        $this->name = $name;
        $this->description = $description;
        $this->ip = $ip;
        $this->url = $url;


        $this->db->update('nodes', $this, array('id' => $id));
    }

    function get_by_id($id) {

        $this->db->where('id', $id);

        $query = $this->db->get('nodes');



        return $query->row();
    }

    function get_all() {

        $this->db->select('*')->from('nodes');

        //$this->db->order_by('<field>', '<type>'); ==> asc/desc

        $query = $this->db->get();



        return $query->result();
    }

}
?>

