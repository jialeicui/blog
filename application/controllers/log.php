<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class log extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->log_url = get_class($this).'/login';
        $this->load->library('auth');
    }

    public function logout()
    {
        $this->auth->logout();
        redirect('/');
    }

    public function index($url = NULL)
    {
        if($url == NULL) {
            $url = '/';
        }
        if (!$this->auth->is_loggedin()) {
            redirect($this->log_url);
        }else{
            redirect($url);
        }
    }

    public function login()
    {
        $post = $this->input->post();
        if ($post) {
            $this->auth->login($post['id'], $post['pwd']);
            return $this->index();
        }else{
            $data['title'] = 'login';
            $this->load->view('head', $data);
            $this->load->view('admin/login', $data, FALSE);
            $this->load->view('foot');
        }
    }
}

/* End of file log.php */
/* Location: ./application/controllers/log.php */
