<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterToko extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        cek_role();
    }

    public function index()
    {
        $data['page'] = 'admin/masterToko/index';
        $data['title'] = 'Master Toko';
        $data['laporan'] = $this->db->get('masterToko')->result_array();
        $this->load->view('admin/template/index', $data);
    }
    public function detail($id)
    {
        $data['page'] = 'admin/masterToko/detail';
        $data['title'] = 'Detail Master';
        $data['toko'] = $this->db->get_where('masterToko', ['id' => $id])->row_array();
        $this->load->view('admin/template/index', $data);
    }
    public function update($id)
    {
        $data['nama_toko'] = $this->input->post('nama_toko');
        $data['alamat'] = $this->input->post('alamat_toko');
        $data['no_telp'] = $this->input->post('no_telp');
        $this->db->where('id', $id);
        $this->db->update('masterToko', $data);
        $this->session->set_flashdata('success', 'Berhasil Di Ubah');
        redirect('masterToko');
    }
}
