<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{
    protected     $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library('session');
        $this->log_key = 'loggedin';
    }

    public function is_loggedin()
    {
        return $this->ci->session->userdata($this->log_key);
    }

    public function login($email, $password)
    {
        $this->ci->load->model('user_model');
        if ($this->ci->user_model->authenticate($email, $password)) {
            $this->_set_loggedin();
            return true;
        }
        return false;
    }

    public function logout()
    {
        return $this->_set_loggedout();
    }

    private function _set_loggedin()
    {
        $this->ci->session->set_userdata($this->log_key, true);
    }

    private function _set_loggedout()
    {
        $this->ci->session->set_userdata($this->log_key, false);
    }
}

/* End of file auth.php */
/* Location: ./application/libraries/auth.php */
