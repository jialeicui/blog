<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->blog_table = 'blog';
        $this->about_table = 'about';
    }

    private function _get_all($table)
    {
        return $this->db->get($table)->result();
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

    public function get_all_article()
    {
        return $this->_get_all($this->blog_table);
    }

    public function get_about()
    {
        return $this->_get_all($this->about_table);
    }
}

/* End of file data_model.php */
/* Location: ./application/models/data_model.php */