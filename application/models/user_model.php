<?php
class user_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'users';
    }

    private function _get_user_id($email)
    {
        $this->db->select('id');
        $query = $this->db->get_where($this->table, array('email' => $email));
        return $query->row();
    }

    private function _get_hash($email, $password)
    {
        return hash('sha512', $email.$password.$this->config->item('encryption_key'));
    }

    public function authenticate($email, $password)
    {
        $id = $this->_get_user_id($email);
        if(!$id){
            return false;
        }
    
        $hash = $this->_get_hash($email, $password);
        $user = $this->db->select('id')->get_where($this->table, array('email' => $email,'hash' => $hash))->row();

        if(sizeof($user)){
            return true;
        }
        return false;
    }
    
    public function create($email, $password)
    {
        $id = $this->_get_user_id($email);
        if ($id) {
            return false;
        }

        $hash = $this->_get_hash($email, $password);
        $this->db->insert($this->table, array('email' => $email,'hash' => $hash));
        return true;
    }
}