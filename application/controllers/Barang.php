<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }
    public function index()
    {
        $data['page'] = "admin/barang/index";
        $data['title'] = 'Barang';
        $data['barang'] = $this->db->get('barang')->result_array();
        $this->load->view('admin/template/index', $data);
    }
    public function tambahBarang()
    {
        $data['page'] = "admin/barang/tambahBarang";
        $data['title'] = 'Tambah Barang';
        $this->load->view('admin/template/index', $data);
    }
    public function insert()
    {
        $user = $this->session->userdata('username');
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|is_unique[barang.kode_barang]', ['required' => 'Kode Barang Harus Di Isi!!', 'is_unique' => 'Kode Barang Sudah Ada!!']);
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', ['required' => 'Kode Barang Harus Di Isi!!']);
        $this->form_validation->set_rules('exp', 'Exp', 'required', ['required' => 'Exp Harus Di Isi!!!']);
        $this->form_validation->set_rules('stock', 'Stock', 'required', ['required' => 'Stock Harus Di Isi!!!']);
        $this->form_validation->set_rules('harga_perbarang', 'Harga Perbarang', 'required', ['required' => 'Harga Perbarang Harus Di Isi!!!']);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('barang/tambahBarang');
        } else {
            $input = $this->input->post(null, true);
            $data['kode_barang'] = $input['kode_barang'];
            $data['nama_barang'] = $input['nama_barang'];
            $data['exp'] = $input['exp'];
            $data['stock'] = $input['stock'];
            $data['harga_perbarang'] = $input['harga_perbarang'];


            $this->db->insert('barang', $data);
            $this->session->set_flashdata('success', 'Barang Berhasil Di Tambahkan!!');
            redirect('barang');
        }
    }
    public function editBarang($id)
    {
        $data['page'] = "admin/barang/editBarang";
        $data['title'] = 'Edit Barang';
        $data['barang'] = $this->db->get_where('barang', ['id' => $id])->row_array();
        $this->load->view('admin/template/index', $data);
    }
    public function update()
    {
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required', ['required' => 'Kode Barang Harus Di Isi!!']);
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', ['required' => 'Kode Barang Harus Di Isi!!']);
        $this->form_validation->set_rules('exp', 'Exp', 'required', ['required' => 'Exp Harus Di Isi!!!']);
        $this->form_validation->set_rules('stock', 'Stock', 'required', ['required' => 'Stock Harus Di Isi!!!']);
        $this->form_validation->set_rules('harga_perbarang', 'Harga Perbarang', 'required', ['required' => 'Harga Perbarang Harus Di Isi!!!']);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('barang/tambahBarang');
        } else {
            $input = $this->input->post(null, true);
            $id = $input['id'];
            $data['kode_barang'] = $input['kode_barang'];
            $data['nama_barang'] = $input['nama_barang'];
            $data['exp'] = $input['exp'];
            $data['stock'] = $input['stock'];
            $data['harga_perbarang'] = $input['harga_perbarang'];

            $stockLama = $this->db->get_where('barang', ['id' => $id])->row_array();
            if ($data['stock'] > $stockLama['stock']) {
                $getStock = $data['stock'] - $stockLama['stock'];
                $procedure = "CALL log_barang (?,?,?)";
                $this->db->query($procedure, array('action' => 'Penambahan STOCK', 'kode_barang' => $data['kode_barang'], 'stock' => $getStock));
            } elseif ($data['stock'] < $stockLama['stock']) {
                $getStock = $stockLama['stock'] - $data['stock'];
                $procedure = "CALL log_barang (?,?,?)";
                $this->db->query($procedure, array('action' => 'Pengurangan STOCK', 'kode_barang' => $data['kode_barang'], 'stock' => $getStock));
            } else {
                if ($stockLama['stock'] == $data['stock']) {
                    $stockBaru = '0';
                } elseif ($stockLama['stock'] < $data['stock']) {
                    $stockBaru = $data['stock'] - $stockLama['stock'];
                } elseif ($stockLama['stock'] > $data['stock']) {
                    $stockBaru = $stockLama['stock'] - $data['stock'];
                }
                $procedure = "CALL log_barang (?,?,?)";
                $this->db->query($procedure, array('action' => 'Update Barang', 'kode_barang' => $data['kode_barang'], 'stock' => $stockBaru));
            }

            $this->db->where('id', $id);
            $this->db->update('barang', $data);
            $this->session->set_flashdata('success', 'Barang Berhasil Di Edit!!');
            redirect('barang');
        }
    }
    public function updateStock($id)
    {
        $query = $this->db->get_where('barang', ['id' => $id])->row_array();

        $data['stock'] = $this->input->post('stock');

        $stockinput =  $data['stock'] - $query['stock'];


        $stockLama = $this->db->get_where('barang', ['id' => $id])->row_array();
        if ($data['stock'] > $stockLama['stock']) {
            $getStock = $data['stock'] - $stockLama['stock'];
            $procedure = "CALL log_barang (?,?,?)";
            $this->db->query($procedure, array('action' => 'Penambahan STOCK', 'kode_barang' => $stockLama['kode_barang'], 'stock' => $getStock));
        } else {
            $getStock = $stockLama['stock'] - $data['stock'];
            $procedure = "CALL log_barang (?,?,?)";
            $this->db->query($procedure, array('action' => 'Pengurangan STOCK', 'kode_barang' => $stockLama['kode_barang'], 'stock' => $getStock));
        }


        $this->db->where('id', $id);
        $this->db->update('barang', $data);
        $this->session->set_flashdata('success', 'Stock Berhasil Di tambah');
        redirect('barang');
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('barang');
        $this->session->set_flashdata('success', 'Data Berhasil Di Hapus!!');
        redirect('barang');
    }
    public function excel()
    {
        $dataNOW = strtotime(date('Y-m-d')); // Mengonversi tanggal saat ini ke dalam format timestamp

        $input = $this->input->post(null, true);
        $data['tanggal'] = $input['tanggal'];
        $data['stanggal'] = $input['stanggal'];

        if ($data['tanggal'] == date('Y-m-d', $dataNOW) && $data['stanggal'] == date('Y-m-d', $dataNOW)) {
            $tanggal = date('d-m-Y', $dataNOW); // Format tanggal berdasarkan timestamp
        } else {
            $tanggal = $data['tanggal'] . '-' . $data['stanggal'];
        }
        header('Content-Type: application/vnd.ms.excel');

        header('Content-Disposition: attachment;filename="Laporan-Barang-' . $tanggal . '.xlsx"');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'No');
        $activeWorksheet->setCellValue('B1', 'Aksi');
        $activeWorksheet->setCellValue('C1', 'Kode Barang');
        $activeWorksheet->setCellValue('D1', 'Nama Barang');
        $activeWorksheet->setCellValue('E1', 'Stock');
        $activeWorksheet->setCellValue('F1', 'Tanggal');

        $this->db->select('barang.*, log_barang.*');
        $this->db->from('log_barang');
        $this->db->join('barang', 'barang.kode_barang = log_barang.kode_barang');
        $this->db->where('DATE(log_barang.created_at) >=',  $data['tanggal']);
        $this->db->where('DATE(log_barang.created_at) <=',  $data['stanggal']);
        $query = $this->db->get()->result_array();

        $sn = 2;
        $n = 1;
        foreach ($query as $r) {
            $activeWorksheet->setCellValue('A' . $sn, $n++);
            $activeWorksheet->setCellValue('B' . $sn, $r['action']);
            $activeWorksheet->setCellValue('C' . $sn, $r['kode_barang']);
            $activeWorksheet->setCellValue('D' . $sn, $r['nama_barang']);
            $activeWorksheet->setCellValue('E' . $sn, $r['stock']);
            $activeWorksheet->setCellValue('F' . $sn, $r['created_at']);
            $sn++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
