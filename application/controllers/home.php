<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
    }

    public function index($id = NULL)
    {
        $query = $this->data_model->get_all_article($this->_is_logged_in());

        $data['articles'] = $query;
        $data['title'] = 'Home';
        $this->_add_log_info($data);
        $this->load->view('head', $data);
        $this->load->view('content/list', $data, FALSE);
        $this->load->view('foot');
    }

    public function article($id = NULL)
    {
        $query = $this->data_model->get_by_id($id);
        if (!$query) {
            die("no article");
        }

        $data['article_id'] = $id;
        $data['title'] = $query->title;
        $data['content'] = $this->_get_content($query->title, $query->content);
        $this->_add_log_info($data);
        $this->load->view('head', $data);
        $this->load->view('content/article', $data, FALSE);
        $this->load->view('foot');
    }

    private function _get_content($title, $content)
    {
        $this->load->config('blog');
        $show_title = $this->config->item('show_title');
        if ($show_title) {
            $format = $this->config->item('title_content_format');
            return sprintf($format, $title, $content);
        } else {
            return $content;
        }
    }

    private function _is_logged_in()
    {
        $this->load->library('auth');
        return $this->auth->is_loggedin();
    }

    private function _add_log_info(&$data)
    {
        $data['loggedin'] = $this->_is_logged_in();
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */