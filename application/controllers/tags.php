<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
    }

    /**
     * 入口,显示所有的tag
     */
    public function index()
    {
        $this->load->library('auth');
        $query = $this->data_model->get_tags();
        foreach ($query as &$one) {
            $one->count = count($this->data_model->get_article_by_tag_name($one->name));
        }
        
        $data['tags']     = $query;
        $data['title']    = 'Tags';
        $data['loggedin'] = $this->auth->is_loggedin();

        $this->load->view('head', $data);
        $this->load->view('content/tags', $data, FALSE);
        $this->load->view('foot');
    }

    /**
     * 显示标记tag的所有文章
     * @param string tag 要显示的tag
     */
    public function show($tag)
    {
        $tag   = urldecode($tag);
        $query = $this->data_model->get_article_by_tag_name($tag);

        $data['articles'] = $query;
        $data['title']    = sprintf('Tag:%s', $tag);

        $this->load->view('head', $data);
        $this->load->view('content/list', $data, FALSE);
        $this->load->view('foot');
    }

    /**
     * 删除tag,需要管理员权限
     * @param  string $tag 要删除的tag
     */
    public function remove($tag = NULL)
    {
        if ($tag) {
            //验证是否有权限
            $this->load->library('auth');
            if(!$this->auth->is_loggedin()) {
                redirect('log/login');
            }
            $tag = urldecode($tag);
            $this->data_model->remove_tag($tag);
            redirect(get_class($this));
        }
    }
}

/* End of file tags.php */
/* Location: ./application/controllers/tags.php */
