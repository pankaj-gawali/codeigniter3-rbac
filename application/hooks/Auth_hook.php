<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_hook {
    public function check_access() {
        $CI =& get_instance();
        // load what is needed (session, url helper already autoloaded partially)
        $CI->load->library('session');
        $CI->load->helper('url');
        $CI->load->model('Permission_model');

        $uri    = trim($CI->uri->uri_string(), '/');
        $first  = strtolower($CI->uri->segment(1)); // controller/module
        $second = strtolower($CI->uri->segment(2)); // method/action

        $public = array('', 'auth', 'auth/login', 'auth/logout');
        if (in_array($uri, $public) || $first === 'assets') {
            return;
        }

        if (!$CI->session->userdata('user_id')) {
            redirect('auth/login');
            exit;
        }

        $role_id = (int)$CI->session->userdata('role_id');
        $module  = $first ?: 'dashboard';

        $action = 'view';
        if (in_array($second, array('add','create','store'))) {
            $action = 'add';
        } elseif (in_array($second, array('edit','update'))) {
            $action = 'edit';
        } elseif (in_array($second, array('delete','destroy','remove'))) {
            $action = 'delete';
        }

        if (!$CI->Permission_model->has_permission($role_id, $module, $action)) {
            echo $CI->load->view('errors/html/permission_denied', [], TRUE);
            exit;
        }
    }
}
