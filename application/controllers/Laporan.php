<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_laporan', 'model');
        cek_login();
        cek_role();
    }
    public function index()
    {
        $data['title'] = 'Laporan Transaksi';
        $data['page'] = 'admin/laporan/index';
        $data['laporan'] = $this->model->getAllLaporan();
        $data['petugas'] = $this->db->get('admin')->result_array();
        $data['metode'] = $this->db->get('metode_pembayaran')->result();
        $this->load->view('admin/template/index', $data);
    }
    public function detail($id)
    {
        $data['title'] = 'Detail Transaksi';
        $data['page'] = 'admin/laporan/detail';
        $data['laporan'] = $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();
        $data['getBarang'] = $this->db->get_where('transaksi_detail', ['id_transaksi' => $id])->result_array();
        $this->load->view('admin/template/index', $data);
    }
    public function get($id)
    {
        $result = $this->db->get_where('transaksi_detail', ['id_transaksi' => $id])->result_array();
        echo json_encode($result);
    }
    public function hapusbarang($id)
    {
        $this->db->where('id_detail', $id);
        $this->db->delete('transaksi_detail');
        if ($this->db->affected_rows() <= 0) {
            return true;
        } else {
            return false;
        }
    }
    public function edit($id)
    {
        $input = $this->input->post(null, true);
        $data['no_faktur'] = $input['no_faktur'];
        $data['no_transaksi'] = $input['no_trans'];
        $data['nama_kasir'] = $input['nama_kasir'];
        $data['tanggal'] = $input['tanggal'];
        $data['member'] = $input['member'];
        $data['metode_pembayaran'] = $input['metode_pem'];
        $data['pembayaran'] = $input['pembayaran'];
        $data['kembalian'] = $input['kembalian'];
        $data['diskon'] = $input['diskon'];
        $data['total'] = $input['total'];

        $this->db->where('id_transaksi', $id);
        $this->db->update('transaksi', $data);
        $this->session->set_flashdata('success', 'Berhasil Mengupdate Data');
        redirect('laporan');
    }
    public function hapus($id)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->delete('transaksi');
        if ($this->db->affected_rows() >= 0) {
            $this->db->where('id_transaksi', $id);
            $this->db->delete('transaksi_detail');
        } else {
            return false;
        }
        $this->session->set_flashdata('success', 'Berhasil Menghapus Data');
        redirect('laporan');
    }
    public function excel()
    {
        $input = $this->input->post(null, true);

        $tanggal = $input['tanggal'];

        $newTanggal = date('d-m-Y', strtotime($tanggal));
        if ($tanggal) {
            $date = $newTanggal;
        } else {
            $date = date('d-m-Y');
        }

        header('Content-Type: application/vnd.ms.excel');
        header('Content-Disposition: attachment;filename="Laporan-Transaksi-' . $date . '.xlsx"');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'No');
        $activeWorksheet->setCellValue('B1', 'Nomor Transaksi');
        $activeWorksheet->setCellValue('C1', 'Nomor Faktur');
        $activeWorksheet->setCellValue('D1', 'Nama Kasir');
        $activeWorksheet->setCellValue('E1', 'Tanggal');
        $activeWorksheet->setCellValue('F1', 'Total');
        $activeWorksheet->setCellValue('G1', 'Member');
        $activeWorksheet->setCellValue('H1', 'Metode Pembayaran');
        $activeWorksheet->setCellValue('I1', 'Pembayaran');
        $activeWorksheet->setCellValue('J1', 'Kembalian');
        $activeWorksheet->setCellValue('K1', 'Diskon');
        $activeWorksheet->setCellValue('L1', 'Kode Barang');
        $activeWorksheet->setCellValue('M1', 'Nama Barang');
        $activeWorksheet->setCellValue('N1', 'QTY');
        $activeWorksheet->setCellValue('O1', 'Harga Barang');
        $activeWorksheet->setCellValue('P1', 'Harga Total Barang');

        $this->db->select("transaksi.*, transaksi_detail.kode_barang, transaksi_detail.nama_barang, transaksi_detail.qyt, transaksi_detail.harga_barang, transaksi_detail.harga_total_barang");
        $this->db->from("transaksi");
        $this->db->join("transaksi_detail", "transaksi_detail.id_transaksi = transaksi.id_transaksi");

        if ($input['tanggal'] != null) {
            $this->db->where('DATE(tanggal)', $tanggal);
        }
        if ($input['petugas'] != 'Pilih Petugas') {
            $this->db->where('nama_kasir', $input['petugas']);
        }
        if ($input['metode'] != 'Pilih Metode Pembayaran') {
            $this->db->where('metode_pembayaran', $input['metode']);
        }
        $result = $this->db->get()->result_array();

        $sn = 2;
        $n = 1;
        foreach ($result as $r) {
            $activeWorksheet->setCellValue('A' . $sn, $n++);
            $activeWorksheet->setCellValue('B' . $sn, $r['no_faktur']);
            $activeWorksheet->setCellValue('C' . $sn, $r['no_transaksi']);
            $activeWorksheet->setCellValue('D' . $sn, $r['nama_kasir']);
            $activeWorksheet->setCellValue('E' . $sn, $r['tanggal']);
            $activeWorksheet->setCellValue('F' . $sn, $r['total']);
            $activeWorksheet->setCellValue('G' . $sn, $r['member']);
            $activeWorksheet->setCellValue('H' . $sn, $r['metode_pembayaran']);
            $activeWorksheet->setCellValue('I' . $sn, $r['pembayaran']);
            $activeWorksheet->setCellValue('J' . $sn, $r['kembalian']);
            $activeWorksheet->setCellValue('K' . $sn, $r['diskon']);
            $activeWorksheet->setCellValue('L' . $sn, $r['kode_barang']);
            $activeWorksheet->setCellValue('M' . $sn, $r['nama_barang']);
            $activeWorksheet->setCellValue('N' . $sn, $r['qyt']);
            $activeWorksheet->setCellValue('O' . $sn, $r['harga_barang']);
            $activeWorksheet->setCellValue('P' . $sn, $r['harga_total_barang']);
            $activeWorksheet->getStyle('F' . $sn)->getNumberFormat()->setFormatCode('0.000');
            $activeWorksheet->getStyle('I' . $sn)->getNumberFormat()->setFormatCode('0.000');
            if ($r['kembalian'] != 0) {
                $activeWorksheet->getStyle('J' . $sn)->getNumberFormat()->setFormatCode('0.000');
            }
            if ($r['diskon'] != 0) {
                $activeWorksheet->getStyle('K' . $sn)->getNumberFormat()->setFormatCode('0.000');
            }
            $activeWorksheet->getStyle('O' . $sn)->getNumberFormat()->setFormatCode('0.000');
            $activeWorksheet->getStyle('P' . $sn)->getNumberFormat()->setFormatCode('0.000');
            $sn++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
