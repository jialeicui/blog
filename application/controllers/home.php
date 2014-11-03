<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
    }

    public function index($id = NULL)
    {
        $query = $this->data_model->get_all_article();
        $data['articles'] = $query;
        $data['title'] = '列表';
        $this->load->view('head', $data);
        $this->load->view('content/list', $data, FALSE);
        $this->load->view('foot');        
    }

    public function article($id = NULL)
    {
        $query = $this->data_model->get_by_id($id);
        if (!$query) {
            echo "no article";
            return;
        }

        $data['title'] = $query->title;
        $data['content'] = $query->content;
        $this->load->view('head', $data);
        $this->load->view('content/article', $data, FALSE);
        $this->load->view('foot');
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */