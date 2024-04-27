<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diskon extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        cek_role();
    }

    public function update()
    {
        $this->form_validation->set_rules('diskon', 'diskon', 'required', ['required' => 'Diskon Harus di isi!']);
        $this->form_validation->set_rules('minimal_pembelanjaan', 'required', ['required' => 'Minimal Pembelanjaan harus di isi!']);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('member');
        } else {
            $input = $this->input->post(null, true);
            $id = $input['id'];
            $data['diskon'] = $input['diskon'] . '%';
            $data['minimal_pembelanjaan'] = $input['minimal'];

            $this->db->where('id', $id);
            $this->db->update('diskon', $data);
            $this->session->set_flashdata('success', 'Diskon Berhasil DI update');
            redirect('member');
        }
    }
}
