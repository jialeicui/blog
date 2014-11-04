<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class log extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->log_url = get_class($this).'/login';
    }

    private function _is_loggedin()
    {
        return $this->session->userdata('loggedin');
    }

    private function _set_loggedin()
    {
        $this->session->set_userdata('loggedin', true);
    }

    public function logout()
    {
        $this->session->set_userdata('loggedin', false);
        redirect('/');
    }

    public function index()
    {
        if (!$this->_is_loggedin()) {
            redirect($this->log_url);
        }else{
            redirect('/');
        }
    }

    public function login()
    {
        $post = $this->input->post();
        if ($post) {
            $this->load->model('user_model');
            if ($this->user_model->authenticate($post['id'], $post['pwd'])) {
                $this->_set_loggedin();
            }
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
