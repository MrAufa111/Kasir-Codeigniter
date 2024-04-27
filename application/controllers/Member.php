<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }
    public function index()
    {
        $data['page'] = 'admin/member/index';
        $data['title'] = 'Member';
        $data['member'] = $this->db->get('member')->result_array();
        $data['diskon'] = $this->db->get_where('diskon', ['id' => 1])->row_array();
        $this->load->view('admin/template/index', $data);
    }
    public function tambahMember()
    {
        $data['page'] = 'admin/member/tambahMember';
        $data['title'] = 'Tambah Member';
        $this->load->view('admin/template/index', $data);
    }
    public function insert()
    {
        $this->form_validation->set_rules('nama_member', 'Nama Member', 'required|is_unique[member.nama_member]', ['required' => 'Nama Member Harus Di isi', 'is_unique' => 'Nama Member Sudah Ada']);
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|is_unique[member.no_telp]', ['required' => 'Nomor Telepon Harus Di isi!!', 'is_unique' => 'Nama Member Sudah Ada']);
        $this->form_validation->set_rules('exp', 'Exp', 'required', ['required' => 'Tanggal Exp Harus Di Isi!!!']);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('member/tambahMember');
        } else {
            $date = date('Y-m-d');
            $input = $this->input->post(null, true);
            $data['nama_member'] = $input['nama_member'];
            $data['no_telp'] = $input['no_telp'];
            $data['exp'] = $input['exp'];
            if ($data['exp'] < $date) {
                $this->session->set_flashdata('error', 'Tanggal Tidak Valid');
                redirect('member/tambahMember');
            } else {
                $this->db->insert('member', $data);
                $this->session->set_flashdata('success', 'Member Berhasil Di Tambah!!');
                redirect('member');
            }
        }
    }
    public function editMember($id)
    {
        $data['page'] = 'admin/member/editMember';
        $data['title'] = 'Edit Member';
        $data['member'] = $this->db->get_where('member', ['id' => $id])->row_array();
        $this->load->view('admin/template/index', $data);
    }
    public function update()
    {
        $this->form_validation->set_rules('nama_member', 'Nama Member', 'required', ['required' => 'Nama Member Harus Di isi']);
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required', ['required' => 'Nomor Telepon Harus Di isi!!']);
        $this->form_validation->set_rules('exp', 'Exp', 'required', ['required' => 'Tanggal Exp Harus Di Isi!!!']);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('membeer/tambahMember');
        } else {
            $input = $this->input->post(null, true);
            $id = $input['id'];
            $data['nama_member'] = $input['nama_member'];
            $data['no_telp'] = $input['no_telp'];
            $data['exp'] = $input['exp'];

            $this->db->where('id', $id);
            $this->db->update('member', $data);
            $this->session->set_flashdata('success', 'Member Berhasil Di Edit!!');
            redirect('member');
        }
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('member');
        $this->session->set_flashdata('success', 'Member Berhasil Di Delete!!');
        redirect('member');
    }
}
