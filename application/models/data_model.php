<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->articles_table = 'articles';
        $this->tags_table     = 'tags';
        $this->about_table    = 'about';
        $this->tag_article_map_table = 'article_tag';
    }

    private function _get_all($table)
    {
        return $this->db->get($table)->result();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $id = $data['id'];
            //如果设置了id, 则更新
            $this->db->where('id', $id);
            $this->db->update($this->articles_table, $data);
            return $id;
        } else {
            $this->db->insert($this->articles_table, $data);
            return $this->db->insert_id();
        }
    }

    public function get_by_id($id, $all_status = false)
    {
        $condition = array('id' =>$id);
        if (!$all_status) {
            $condition['status'] = 'show';
        }
        $query = $this->db->get_where($this->articles_table, $condition);
        return $query->row();
    }

    public function get_all_article($all_status = false)
    {
        if ($all_status) {
            return $this->_get_all($this->articles_table);
        } else {
            return $this->db->get_where($this->articles_table, array('status'=>'show'))->result();
        }
    }

    public function get_about()
    {
        return $this->_get_all($this->about_table);
    }

    public function update_field($id, $key, $value)
    {
        return $this->db->update($this->articles_table, array($key => $value), array('id' => $id));
    }

    public function get_tags()
    {
        return $this->_get_all($this->tags_table);
    }

    public function get_article_by_tag_name($tag)
    {
        $ret = array();
        $tag_info = $this->db->get_where($this->tags_table, array('name'=>$tag))->row();
        if (!$tag_info) {
            return $ret;
        }

        $query = $this->db->query('select A.id,A.title from '.$this->articles_table.' as A,'.$this->tag_article_map_table.' as M where A.id=M.article_id and M.tag_id='.$tag_info->id)->result_array();

        return $query;
    }
}

/* End of file data_model.php */
/* Location: ./application/models/data_model.php */