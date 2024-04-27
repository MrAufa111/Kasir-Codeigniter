<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_trans', 'model');
        cek_login();
    }
    public function index()
    {
        $this->load->model('M_trans', 'model');
        $data['page'] = 'admin/transaksi/index';
        $data['title'] = 'Transaksi';
        $data['kasir'] = $this->session->userdata('username');
        $data['barang'] = $this->db->get('barang')->result();
        $data['member'] = $this->db->get('member')->result();
        $data['transaksi'] = $this->model->getNoTransaksi();
        $data['metode'] = $this->db->get('metode_pembayaran')->result();
        $this->load->view('admin/template/index', $data);
    }
    public function getBarang()
    {
        $kodeBarang = $this->input->post('kode_barang');
        $result = $this->db->get_where('barang', ['kode_barang' => $kodeBarang])->row_array();
        echo json_encode($result);
    }
    public function getDiskon()
    {
        $result = $this->db->get('diskon')->result_array();
        echo json_encode($result);
    }
    public function saveTransaksi()
    {
        $input = $this->input->post(NULL, true);
        if ($input) {
            $data_transaksi = [
                'no_faktur' => $input['noFaktur'],
                'no_transaksi' => $input['noTrans'],
                'nama_kasir' => $input['nama_kasir'],
                'tanggal' => $input['tanggal'],
                'total' => $input['total'],
                'member' => $input['member'],
                'metode_pembayaran' => $input['metode'],
                'pembayaran' => $input['pembayaran'],
                'kembalian' => $input['kembalian'],
                'diskon' => $input['diskon']
            ];

            $id_transaksi = $this->model->insertTransaksi($data_transaksi);
            if ($id_transaksi) {
                $input_barang = $this->input->post('data');
                if ($input_barang) {
                    $data_barang = array();
                    foreach ($input_barang as $barang) {
                        $data_barang[] = array(
                            'id_transaksi' => $id_transaksi,
                            'kode_barang' => $barang['kodebarang'],
                            'nama_barang' => $barang['namaBarang'],
                            'qyt' => $barang['qyt'],
                            'harga_barang' => $barang['hargabarang'],
                            'harga_total_barang' => $barang['totalHarga'],
                        );
                    }

                    $this->db->insert_batch('transaksi_detail', $data_barang);

                    $struk = $this->load->view('admin/transaksi/struck', compact('data_transaksi', 'data_barang'), true);

                    $response = [
                        'success' => true,
                        'message' => 'Struk berhasil di-generate',
                        'struk' => $struk,
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                } else {
                    $this->session->set_flashdata('error', 'Invalid JSON data.');
                    redirect('Transaksi');
                }
            } else {
                $this->session->set_flashdata('error', 'Failed to save data to billing table.');
                redirect('Transaksi');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid input data.');
            redirect('Transaksi');
        }
    }
    public function struck()
    {
        $this->load->view('admin/transaksi/struck');
    }
}
