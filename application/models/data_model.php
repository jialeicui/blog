<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->articles_table        = 'articles';
        $this->tags_table            = 'tags';
        $this->about_table           = 'about';
        $this->tag_article_map_table = 'article_tag';
    }

    private function _get_all($table)
    {
        return $this->db->get($table)->result();
    }

    public function save_article($data)
    {
        $to_save = array();
        $article_keys = array('id', 'title', 'content', 'time', 'status');
        foreach ($data as $key => $value) {
            if (in_array($key, $article_keys)) {
                $to_save[$key] = $value;
            }
        }

        $article_id = NULL;
        if (isset($to_save['id'])) {
            $article_id = $to_save['id'];
            //如果设置了id, 则更新
            $this->db->where('id', $article_id);
            $this->db->update($this->articles_table, $to_save);

        } else {
            $this->db->insert($this->articles_table, $to_save);
            $article_id = $this->db->insert_id();
        }

        //保存或更新tags
        $this->_save_tags_of_article($article_id, $data['tags']);
        return $article_id;
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

        $qstr = sprintf('select A.id,A.title from %s as A,%s as M where A.id=M.article_id and M.tag_id=%s',
                        $this->articles_table, $this->tag_article_map_table, $tag_info->id);
        $query = $this->db->query($qstr)->result();

        return $query;
    }

    public function get_article_tags($article_id, $keys = 'name')
    {
        if (!is_array($keys)) {
            $keys = explode(',', $keys);
        }
        $query_keys = 'T.'.implode(',T.', $keys);

        $qstr = sprintf('select %s from %s as T,%s as M where T.id=M.tag_id and M.article_id=%s', 
                        $query_keys, $this->tags_table, $this->tag_article_map_table, $article_id);
        $query = $this->db->query($qstr)->result_array();
        if (count($keys) == 1) {
            $ret = array();
            foreach ($query as $iter) {
                $ret[] = $iter[ $keys[0] ];
            }
            return $ret;
        }
        return $query;
    }

    private function _save_tags_of_article($article_id, $tags)
    {
        $tags = explode(',', $tags);
        $old_tags = $this->get_article_tags($article_id, array('name', 'id'));

        $to_rm = array();

        foreach ($old_tags as $old_iter) {
            if (!in_array($old_iter['name'], $tags)) {
                $to_rm[] = $old_iter['id'];
            } else {
                unset( $tags[ array_search($old_iter['name'], $tags)] );
            }
        }

        //remove tags
        if ($to_rm) {
            $qstr = sprintf('delete from %s where tag_id in (%s) and article_id=%s', 
                            $this->tag_article_map_table, implode(',', $to_rm), $article_id);
            $this->db->query($qstr);
        }

        //add tags
        foreach ($tags as $t) {
            $query = $this->db->get_where($this->tags_table, array('name'=>$t))->result_array();
            if (count($query)== 0) {
                $this->db->insert($this->tags_table, array('name'=>$t));
                $tag_id = $this->db->insert_id();
            } else {
                $tag_id = $query[0]['id'];
            }
            $this->db->insert($this->tag_article_map_table, array('tag_id'=>$tag_id, 'article_id'=>$article_id));
        }
    }
}

/* End of file data_model.php */
/* Location: ./application/models/data_model.php */