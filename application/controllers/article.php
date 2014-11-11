<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->load->model('data_model');

        if(!$this->auth->is_loggedin()) {
            redirect('log/login');
        }
    }

    public function add_new()
    {
        $data['loggedin'] = $this->auth->is_loggedin();
        $data['title']    = "new";
        $data['admin']    = true;
        $this->load->view('head', $data);
        $this->load->view('content/post', $data);
        $this->load->view('foot');
    }

    public function submit()
    {
        $post = $this->input->post();
        $this->load->model('data_model');
        $this->data_model->save($post);
    }

    public function edit($id = NULL)
    {
        $query = $this->data_model->get_by_id($id);
        if (!$query) {
            die("no article");
        }

        $data['loggedin']        = $this->auth->is_loggedin();
        $data['title']           = "edit";
        $data['admin']           = true;
        $data['article_id']      = $id;
        $data['article_title']   = $query->title;
        $data['article_content'] = $query->content;

        $this->load->view('head', $data);
        $this->load->view('content/post', $data);
        $this->load->view('foot');
    }
}

/* End of file article.php */
/* Location: ./application/controllers/article.php */