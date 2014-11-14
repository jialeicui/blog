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
        if (isset($data['id'])) {
            //如果设置了id, 则更新
            $this->db->where('id', $data['id']);
            $this->db->update($this->blog_table, $data); 
        } else {
            $this->db->insert($this->blog_table, $data);
        }
    }

    public function get_by_id($id, $all_status = false)
    {
        $condition = array('id' =>$id);
        if (!$all_status) {
            $condition['status'] = 'show';
        }
        $query = $this->db->get_where($this->blog_table, $condition);
        return $query->row();
    }

    public function get_all_article($all_status = false)
    {
        if ($all_status) {
            return $this->_get_all($this->blog_table);
        } else {
            return $this->db->get_where($this->blog_table, array('status'=>'show'))->result();
        }
    }

    public function get_about()
    {
        return $this->_get_all($this->about_table);
    }

    public function update_field($id, $key, $value)
    {
        return $this->db->update($this->blog_table, array($key => $value), array('id' => $id));
    }
}

/* End of file data_model.php */
/* Location: ./application/models/data_model.php */