<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if (!$this->session->userdata('user_id')) redirect('auth/login');

        $this->load->model('Role_model');
        $this->load->model('Permission_model');
        $this->load->helper('url');
    }

    public function index(){
        if (!$this->Permission_model->has_permission($this->session->userdata('role_id'), 'roles', 'view')) {
            echo $this->load->view('errors/html/permission_denied',[],TRUE); return;
        }
        $data['roles'] = $this->Role_model->get_all();
        $this->load->view('roles/index',$data);
    }

    public function add(){
        if (!$this->Permission_model->has_permission($this->session->userdata('role_id'), 'roles', 'add')) {
            echo $this->load->view('errors/html/permission_denied',[],TRUE); return;
        }

        if ($this->input->post()) {
            $role_name = $this->input->post('role_name', TRUE);
            $role_id = $this->Role_model->create(['role_name' => $role_name]);

            if ($role_id) {
                // Insert default zero permissions for this new role
                $modules = ['dashboard','users','roles','permissions'];
                foreach ($modules as $mod) {
                    $this->Permission_model->set_permission([
                        'role_id' => $role_id,
                        'module' => $mod,
                        'can_view' => 0,
                        'can_add' => 0,
                        'can_edit' => 0,
                        'can_delete' => 0
                    ]);
                }
                $this->session->set_flashdata('success','Role created');
                redirect('roles');
            } else {
                $this->session->set_flashdata('error','Failed to create role');
            }
        }

        $this->load->view('roles/add');
    }

    public function edit($id){
        if (!$this->Permission_model->has_permission($this->session->userdata('role_id'), 'roles', 'edit')) {
            echo $this->load->view('errors/html/permission_denied',[],TRUE); return;
        }

        $role = $this->Role_model->get($id);
        if (!$role) show_404();

        if ($this->input->post()) {
            $this->Role_model->update($id, ['role_name' => $this->input->post('role_name',TRUE)]);
            $this->session->set_flashdata('success','Role updated');
            redirect('roles');
        }

        $data['role'] = $role;
        $this->load->view('roles/edit', $data);
    }

    public function delete($id){
        if (!$this->Permission_model->has_permission($this->session->userdata('role_id'), 'roles', 'delete')) {
            echo $this->load->view('errors/html/permission_denied',[],TRUE); return;
        }
        $this->Role_model->delete($id);
        $this->session->set_flashdata('success','Role deleted');
        redirect('roles');
    }
}
