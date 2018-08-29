<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * tree controller
 * ddd  xxxx
 * */

class Tree extends CI_Controller {
	//123    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tree_model');
        date_default_timezone_set("Asia/Taipei");
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('pagination');
    }
    
	public function index()
	{
        $node_array = $this->tree_model->get_node();
        
        foreach($node_array as $key => $item)
        {
            $node_array[$key]['visit'] = 0;
        }
        $treearray = array();
        $stack = array();
        array_unshift($stack,0);
        $node_array[0]['visit'] = 1;
        while(count($stack) != 0)
        {
            $s = $stack[0];
            $find = false;
            
            foreach($node_array as $t => $item)
            {
                $num = $item['id'];
                if($item['parent'] == $s && $item['visit'] != 1)
                {
                    array_unshift($stack,$num);//加入
                    $node_array[$t]['visit'] = 1;
                    array_push($treearray,$item);
                    //echo $item['title']." ";
                    $find = true;
                    break;
                }
            }
            if(!$find)
            {
                $s = array_shift($stack); //取出
            }
        }
        
        $data['treearray'] = $treearray;
        //$this->print_array($treearray);
        
        $level = $this->tree_model->get_max_level();
        while($level > 0)
        {
          $level --;
          $final_node[$level] = $this->tree_model->get_maxid_inlevel($level);
        }
        $data['final_node'] = $final_node;
        
        $this->load->view('tree',$data);
	}
	
	public function add_node($parent)
	{
	    $this->tree_model->add_node($parent);
	   redirect('tree');
	   //$node_array = $this->tree_model->get_node();
	   //echo "test".$parent;
	}
	public function delete_node($node)
	{
	    $start_node = $this->tree_model->get_node($node);
	    
	    $node_array = $this->tree_model->get_node();
        
        foreach($node_array as $key => $item)
        {
            $node_array[$key]['visit'] = 0;
        }
        $treearray = array();
        $stack = array();
        array_unshift($stack,$start_node['id']);
        
        $this->tree_model->delete_node($start_node['id']);
        
        $node_array[0]['visit'] = 1;
        while(count($stack) != 0)
        {
            $s = $stack[0];
            $find = false;
            
            foreach($node_array as $t => $item)
            {
                $num = $item['id'];
                if($item['parent'] == $s && $item['visit'] != 1)
                {
                    $this->tree_model->delete_node($num);
                    array_unshift($stack,$num);//加入
                    $node_array[$t]['visit'] = 1;
                    echo $item['title']." ";
                    $find = true;
                    break;
                }
            }
            if(!$find)
            {
                $s = array_shift($stack); //取出
            }
        }
        redirect('tree');
	}
	
	
	private function print_array($array)
	{
	    echo '<pre>';
	    print_r($array);
	    echo '</pre>';
	}
}

/* End of file admin.php */
