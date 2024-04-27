<?php
class M_laporan extends CI_Model
{
    public function getAllLaporan()
    {
        $this->db->select("transaksi.*");
        $this->db->from("transaksi");
        $result = $this->db->get()->result_array();
        return $result;
    }
    public function getWhereLaporan($id)
    {

        $this->db->select("transaksi.*, transaksi_detail.kode_barang, transaksi_detail.nama_barang, transaksi_detail.qyt, transaksi_detail.harga_barang, transaksi_detail.harga_total_barang");
        $this->db->from("transaksi");
        $this->db->join("transaksi_detail", "transaksi_detail.id_transaksi = transaksi.id_transaksi");
        $this->db->where('transaksi.id_transaksi', $id);
        $result = $this->db->get()->row_array();
        return $result;
    }
}