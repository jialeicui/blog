<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
    }

    public function index()
    {
        return $this->_show_summary();
    }

    private function _show_summary()
    {
        $query = $this->data_model->get_projects();

        $data['projects'] = $query;
        $data['title']    = 'Projects';

        $this->load->view('head', $data);
        $this->load->view('projects/summary', $data, FALSE);
        $this->load->view('foot');
    }

    public function detail($id = NULL)
    {
        if (!$id) {
            redirect(get_class($this));
        }

        $data['title']      = sprintf('Projects');
        $data['project_id'] = $id;
        $data['active_menu'] = 'blabla';
        $data['blabla_list'] = $this->data_model->get_project_blabla($id);

        $this->load->view('head', $data);
        $this->load->view('projects/detail', $data, FALSE);
        $this->load->view('foot');
    }

    public function timeline($id = NULL) 
    {
        if (!$id) {
            redirect(get_class($this));
        }

        $data['title']      = sprintf('Projects');
        $data['project_id'] = $id;
        $data['active_menu'] = 'timeline';

        $this->load->view('head', $data);
        $this->load->view('projects/detail', $data, FALSE);
        $this->load->view('foot');
    }

    public function roadmap($id = NULL)
    {
        if (!$id) {
            redirect(get_class($this));
        }

        $data['title']      = sprintf('Projects');
        $data['project_id'] = $id;
        $data['active_menu'] = 'roadmap';

        $this->load->view('head', $data);
        $this->load->view('projects/detail', $data, FALSE);
        $this->load->view('foot');
    }

    public function submit()
    {
        $limit = 254;
        $post = $this->input->post();
        if (strlen($post['blabla']) >= $limit) {
            die('over flow');
        }
        $project_id = $post['project_id'];

        $this->data_model->add_project_blabla($project_id, $post['blabla']);
        redirect(implode('/', array(get_class($this), 'detail', $project_id)));
    }
}

/* End of file projects.php */
/* Location: ./application/controllers/projects.php */