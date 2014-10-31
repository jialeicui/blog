<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

    public function index($id = NULL)
    {
        $this->load->model('data_model');
        $query = $this->data_model->get_by_id(2);
        if (!$query) {
            return;
        }
        $data['content'] = $query->content;
        $this->load->view('head', $data);
        $this->load->view('content/article', $data, FALSE);
        $this->load->view('foot');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */