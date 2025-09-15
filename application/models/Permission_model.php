<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_model extends CI_Model {
    public function __construct(){ parent::__construct(); }

    public function get_module_row($role_id, $module){
        return $this->db->get_where('permissions', [
            'role_id' => (int)$role_id,
            'module'  => $module
        ])->row();
    }

    public function has_permission($role_id, $module, $action){
        $row = $this->get_module_row($role_id, $module);
        if (!$row) return false;
        switch ($action) {
            case 'view':   return (bool) $row->can_view;
            case 'add':    return (bool) $row->can_add;
            case 'edit':   return (bool) $row->can_edit;
            case 'delete': return (bool) $row->can_delete;
            default:       return false;
        }
    }

    public function has_any_permission($role_id, $module){
        $row = $this->get_module_row($role_id, $module);
        if ($row) return ($row->can_view || $row->can_add || $row->can_edit || $row->can_delete);
        return false;
    }

    public function get_by_role($role_id) {
        return $this->db->get_where('permissions',['role_id' => (int)$role_id])->result();
    }

    public function set_permission($data) {
        $clean = [
            'role_id'    => (int) $data['role_id'],
            'module'     => (string) $data['module'],
            'can_view'   => !empty($data['can_view'])   ? 1 : 0,
            'can_add'    => !empty($data['can_add'])    ? 1 : 0,
            'can_edit'   => !empty($data['can_edit'])   ? 1 : 0,
            'can_delete' => !empty($data['can_delete']) ? 1 : 0,
        ];
        $exists = $this->get_module_row($clean['role_id'], $clean['module']);
        if ($exists) {
            return $this->db->where('id', $exists->id)->update('permissions', $clean);
        } else {
            return $this->db->insert('permissions', $clean);
        }
    }
}
