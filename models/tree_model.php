<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tree_model extends CI_Model {
    
    public function __construct()
    {
        $this->tree_db = $this->load->database('tree',true);
    }
    
    public function get_node($id = false)
    {
        if($id != false){
            $this->tree_db->where('id', $id);
            $query = $this->tree_db->get('node');
            return $query->row_array();
        }
        $query = $this->tree_db->get('node');
        return $query->result_array();
    }
    
    public function add_node($parent)
    {
        $maxid = $this->get_node_maxid();
        $level = $this->get_node_level($parent);
        $level ++;
        $maxid ++;
        $data = array(
            'id' => $maxid,
            'title' => 'node'.$maxid,
            'parent' => $parent,
            'level' => $level
        );
    
        return $this->tree_db->insert('node', $data);
    }
    
    public function delete_node($id)
    {
        
        $this->tree_db->where('id', $id);
        $this->tree_db->delete('node');
    }
    
    public function get_node_maxid()
    {
        $this->tree_db->select_max('id');
        $query = $this->tree_db->get('node');
        $maxid = $query->row_array();
        return $maxid['id'];
    }
    
    public function get_maxid_inlevel($level)
    {
        $this->tree_db->select_max('id');
        $this->tree_db->where('level',$level);
        $query = $this->tree_db->get('node');
        $maxid = $query->row_array();
        return $maxid['id'];
    }
    
    public function get_max_level()
    {
        $this->tree_db->select_max('level');
        $query = $this->tree_db->get('node');
        $maxid = $query->row_array();
        return $maxid['level'];
    }
    
    public function get_node_level($id)
    {
        $this->tree_db->select('level');
        $this->tree_db->where('id',$id);
        $query = $this->tree_db->get('node');
        $node = $query->row_array();
        return $node['level'];
    }
}



/* End of file sunny_model.php */