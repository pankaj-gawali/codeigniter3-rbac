<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_id')) redirect('auth/login');

        $this->load->model('User_model');
        $this->load->model('Role_model');
        $this->load->model('Permission_model');
        $this->load->helper('url');
    }

    public function index() {
        if (!$this->Permission_model->has_permission($this->session->userdata('role_id'), 'users', 'view')) {
            echo $this->load->view('errors/html/permission_denied',[],TRUE); return;
        }
        $data['users'] = $this->User_model->get_all_with_roles();
        $this->load->view('users/index', $data);
    }

    public function add() {
        if (!$this->Permission_model->has_permission($this->session->userdata('role_id'), 'users', 'add')) {
            echo $this->load->view('errors/html/permission_denied',[],TRUE); return;
        }

        if ($this->input->post()) {
            $save = [
                'name' => $this->input->post('name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => md5($this->input->post('password')),
                'role_id' => $this->input->post('role_id')
            ];
            $this->User_model->create($save);
            $this->session->set_flashdata('success','User created');
            redirect('users');
        }

        $data['roles'] = $this->Role_model->get_all();
        $this->load->view('users/add', $data);
    }

    public function edit($id) {
        if (!$this->Permission_model->has_permission($this->session->userdata('role_id'), 'users', 'edit')) {
            echo $this->load->view('errors/html/permission_denied',[],TRUE); return;
        }

        $data['user'] = $this->User_model->get($id);
        if (!$data['user']) show_404();
        $data['roles'] = $this->Role_model->get_all();

        if ($this->input->post()) {
            $update = [
                'name' => $this->input->post('name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'role_id' => $this->input->post('role_id')
            ];
            if ($this->input->post('password')) {
                $update['password'] = md5($this->input->post('password'));
            }
            $this->User_model->update($id,$update);
            $this->session->set_flashdata('success','User updated');
            redirect('users');
        }

        $this->load->view('users/edit', $data);
    }

    public function delete($id) {
        if (!$this->Permission_model->has_permission($this->session->userdata('role_id'), 'users', 'delete')) {
            echo $this->load->view('errors/html/permission_denied',[],TRUE); return;
        }

        $this->User_model->delete($id);
        $this->session->set_flashdata('success','User deleted');
        redirect('users');
    }
}
