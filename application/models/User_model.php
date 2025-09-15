<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct(){ parent::__construct(); }

    // users list with role_name
    public function get_all_with_roles() {
        $this->db->select('users.*, roles.role_name');
        $this->db->from('users');
        $this->db->join('roles','roles.id = users.role_id','left');
        return $this->db->get()->result();
    }

    public function get($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function create($data) {
        return $this->db->insert('users', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id',$id)->update('users',$data);
    }

    public function delete($id) {
        return $this->db->where('id',$id)->delete('users');
    }

    public function check_login($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        return $this->db->get('users')->row();
    }
}
