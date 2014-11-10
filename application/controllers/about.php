<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class about extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
    }

    public function index($id = NULL)
    {
        $query = $this->data_model->get_about();
        
        $this->load->library('auth');

        $data['loggedin'] = $this->auth->is_loggedin();
        $data['link']     = $query;
        $data['title']    = 'about';

        $this->load->view('head', $data);
        $this->load->view('about/about', $data, FALSE);
        $this->load->view('foot');        
    }
}

/* End of file about.php */
/* Location: ./application/controllers/about.php */