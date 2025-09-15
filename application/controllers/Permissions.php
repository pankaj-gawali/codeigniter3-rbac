<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if (!$this->session->userdata('user_id')) redirect('auth/login');

        $this->load->model('Permission_model');
        $this->load->model('Role_model');
        $this->load->helper('url');
    }

    public function index(){
        if (!$this->Permission_model->has_permission($this->session->userdata('role_id'), 'permissions', 'view')) {
            echo $this->load->view('errors/html/permission_denied',[],TRUE); return;
        }
        $data['roles'] = $this->Role_model->get_all();
        $this->load->view('permissions/index',$data);
    }

    public function edit($role_id){
        if (!$this->Permission_model->has_permission($this->session->userdata('role_id'), 'permissions', 'edit')) {
            echo $this->load->view('errors/html/permission_denied',[],TRUE); return;
        }

        $modules = ['dashboard','users','roles','permissions'];

        if ($this->input->post()) {
            foreach ($modules as $mod) {
                $perm = [
                    'role_id'    => $role_id,
                    'module'     => $mod,
                    'can_view'   => $this->input->post($mod.'_view')?1:0,
                    'can_add'    => $this->input->post($mod.'_add')?1:0,
                    'can_edit'   => $this->input->post($mod.'_edit')?1:0,
                    'can_delete' => $this->input->post($mod.'_delete')?1:0
                ];
                $this->Permission_model->set_permission($perm);
            }
            $this->session->set_flashdata('success','Permissions updated');
            redirect('permissions');
        }

        $data['role'] = $this->Role_model->get($role_id);
        $data['modules'] = $modules;

        $existing = $this->Permission_model->get_by_role($role_id);
        $map = [];
        foreach($existing as $e) $map[$e->module] = $e;
        $data['existing'] = $map;

        $this->load->view('permissions/edit',$data);
    }
}
