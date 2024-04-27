<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        cek_role();
    }

    public function userSetting()
    {
        $data['page'] = 'admin/user/userSetting';
        $data['title'] = 'User Setting';
        $data['user'] = $this->db->get('admin')->result_array();
        $this->load->view('admin/template/index', $data);
    }
    public function tambahUser()
    {
        $data['page'] = 'admin/user/tambahUser';
        $data['title'] = 'Tambah User';
        $data['role'] = $this->db->get('admin_role')->result_array();
        $this->load->view('admin/template/index', $data);
    }
    public function insertUser()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[admin.username]', ['required' => 'Username Harus Di isi!', 'trim' => 'Tidak Boleh Ada Spasi', 'is_unique' => 'Username Sudah ada!!']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password Harus DI isi!!', 'trim' => 'Password TIdak Boleh ada Spasi!!']);
        $this->form_validation->set_rules('v_password', 'Verif Password', 'required|matches[password]', ['required' => 'Verif Password Harus DI isi!!', 'matches' => 'Password Tidak Sama!!']);
        $this->form_validation->set_rules('role', 'Role', 'required', ['required' => 'Role Harus DI isi!!']);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('user/tambahUser');
        } else {
            $input = $this->input->post(null, true);
            $data['username'] = $input['username'];
            $data['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
            $data['roleId'] = $input['role'];

            $this->db->insert('admin', $data);
            $this->session->set_flashdata('success', 'User Berhasil Di Tambah!!');
            redirect('user/userSetting');
        }
    }
    public function editUser($id)
    {
        $data['page'] = 'admin/user/editUser';
        $data['title'] = 'Edit User';
        $data['role'] = $this->db->get('admin_role')->result_array();
        $data['user'] = $this->db->get_where('admin', ['id' => $id])->row_array();
        $this->load->view('admin/template/index', $data);
    }
    public function updateUser()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim', ['required' => 'Username Harus Di isi!', 'trim' => 'Tidak Boleh Ada Spasi', 'is_unique' => 'Username Sudah ada!!']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password Harus DI isi!!', 'trim' => 'Password TIdak Boleh ada Spasi!!']);
        $this->form_validation->set_rules('v_password', 'Verif Password', 'required|matches[password]', ['required' => 'Verif Password Harus DI isi!!', 'matches' => 'Password Tidak Sama!!']);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('user/tambahUser');
        } else {
            $input = $this->input->post(null, true);
            $id = $input['id'];
            $data['username'] = $input['username'];
            $data['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
            $data['roleId'] = $input['role'];

            $this->db->where('id', $id);
            $this->db->update('admin', $data);
            $this->session->set_flashdata('success', 'User Berhasil Di Ubah!!');
            redirect('user/userSetting');
        }
    }
    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('admin');
        $this->session->set_flashdata('success', 'User Berhasil DI hapus!!');
        redirect('user/userSetting');
    }
    public function role()
    {
        $data['page'] = 'admin/user/userRole';
        $data['title'] = 'User Role';
        $data['role'] = $this->db->get('admin_role')->result_array();
        $this->load->view('admin/template/index', $data);
    }
    public function tambahRole()
    {
        $data['page'] = 'admin/user/tambahRole';
        $data['title'] = 'Tambah Role';
        $this->load->view('admin/template/index', $data);
    }
    public function insertRole()
    {
        $this->form_validation->set_rules('role', 'Nama Role', 'required', ['required' => 'Nama Role Wajib DI isi']);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('user/tambahRole');
        } else {
            $data['name_role'] = $this->input->post('role');
            $this->db->insert('admin_role', $data);
            $this->session->set_flashdata('success', 'Role Berhasil Di Tambah');
            redirect('user/role');
        }
    }
    public function editRole($id)
    {
        $data['page'] = 'admin/user/editRole';
        $data['title'] = 'Edit Role';
        $data['role'] = $this->db->get_where('admin_role', ['id' => $id])->row_array();
        $this->load->view('admin/template/index', $data);
    }
    public function updateRole()
    {
        $this->form_validation->set_rules('role', 'Nama Role', 'required', ['required' => 'Nama Role Wajib DI isi']);
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('user/tambahRole');
        } else {
            $id = $this->input->post('id');
            $data['name_role'] = $this->input->post('role');
            $this->db->where('id', $id);
            $this->db->update('admin_role', $data);
            $this->session->set_flashdata('success', 'Role Berhasil Di Tambah');
            redirect('user/role');
        }
    }
    public function deleteRole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('admin_role');
        $this->session->set_flashdata('success', 'Role Berhasil Di Delete');
        redirect('user/role');
    }
}
