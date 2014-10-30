<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post extends CI_Controller {

    public function index()
    {
        $data['title'] = "new";
        $this->load->view('head', $data);
        $this->load->view('content/post', $data);
        $this->load->view('foot');
    }

    public function submit()
    {
        $post = $this->input->post();
    }
}

/* End of file post.php */
/* Location: ./application/controllers/post.php */
