<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
    }

    public function index(){ redirect('auth/login'); }

    public function login() {
        if ($this->input->post()) {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);

            $user = $this->User_model->check_login($email, $password);
            if ($user) {
                $this->session->set_userdata([
                    'user_id'   => $user->id,
                    'role_id'   => $user->role_id,
                    'user_name' => $user->name,
                    'email'     => $user->email,
                    'logged_in' => TRUE
                ]);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error','Invalid credentials');
                redirect('auth/login');
            }
        } else {
            $this->load->view('auth/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
