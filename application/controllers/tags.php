<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
    }
    public function index($tag = NULL)
    {
        if ($tag) {
            return $this->_article_with_tag($tag);
        }
        $query = $this->data_model->get_tags();
        $data['tags'] = $query;
        $this->load->view('head', $data);
        $this->load->view('content/tags', $data, FALSE);
        $this->load->view('foot');
    }

    public function _add()
    {
        $post = $this->input->post('tag');
        echo '<pre>';print_r($post);echo '</pre>';
    }

    public function show($tag)
    {
        $query = $this->data_model->get_article_by_tag_name($tag);
    }
}

/* End of file tags.php */
/* Location: ./application/controllers/tags.php */
