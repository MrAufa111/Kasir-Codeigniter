<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        $data['page'] = 'auth/index';
        $data['title'] = 'Login';
        $this->load->view('auth/template/index', $data);
    }
    public function register()
    {
        $data['username'] = $this->input->post('username');
        $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $data['roleId'] = 1;

        $this->db->insert('admin', $data);
        $this->session->set_flashdata('susscess', 'Berhasil');
        redirect('auth/index');
    }
    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required', ['required' => 'Username Harus DI isi']);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Password Harus DI isi']);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth');
        } else {
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);
            $user = $this->db->get_where('admin', ['username' => $username])->row_array();
            // var_dump($user);
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $data['username'] = $user['username'];
                    $data['roleId'] = $user['roleId'];
                    $a_procedure = "CALL log_login (?,?,?)";
                    $this->db->query($a_procedure, array('action' => "Login", 'username' => $data['username'], 'roleId' => $data['roleId']));
                    $this->session->set_userdata($data);
                    if ($data['roleId'] == 1) {
                        redirect('dashboard');
                    } else {
                        redirect('transaksi');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Password Atau Username Salah!!');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('error', 'Username Tidak Terdaftar');
                redirect('auth');
            }
        }
    }
    public function logout()c
    {
        $user = $this->session->userdata('username');
        $role = $this->session->userdata('roleId');
        $a_procedure = "CALL log_login (?, ?, ?)";
        $this->db->query($a_procedure, array('Logout', $user, $role)); // Ubah 'action' ke 'Login'
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('roleId');
        $this->session->set_flashdata('success', 'Berhasil Logout');
        redirect('auth');
    }
}
