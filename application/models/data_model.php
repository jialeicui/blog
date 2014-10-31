<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->blog_table = 'blog';
    }

    public function save($data)
    {
        $this->db->insert($this->blog_table, $data);
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where($this->blog_table, array('id' =>$id));
        return $query->row();
    }
}

/* End of file data_model.php */
/* Location: ./application/models/data_model.php */