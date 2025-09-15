<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {
    public function __construct(){ parent::__construct(); }

    public function get_all(){ return $this->db->get('roles')->result(); }
    public function get($id){ return $this->db->get_where('roles',['id'=>$id])->row(); }

    public function create($data) {
        $this->db->insert('roles',$data);
        return $this->db->insert_id();
    }

    public function update($id,$data){ return $this->db->where('id',$id)->update('roles',$data); }
    public function delete($id){ return $this->db->where('id',$id)->delete('roles'); }
}
