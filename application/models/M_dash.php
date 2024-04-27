<?php
class M_dash extends CI_Model
{
    public function countPemasukan()
    {
        $bulanSaatIni = date('m'); // Mendapatkan bulan saat ini
        $tahunSaatIni = date('Y'); // Mendapatkan tahun saat ini
        $this->db->select('SUM(REPLACE(total,".","")) AS total_penjualan');
        $this->db->from('transaksi');
        $this->db->where('MONTH(tanggal)', $bulanSaatIni);
        $this->db->where('YEAR(tanggal)', $tahunSaatIni);
        $query = $this->db->get()->result_array();
        return $query;
    }
    public function countMember()
    {
        $date = date('Y-m-d');
        $this->db->select('COUNT(*) AS jumlah_member');
        $this->db->from('member');
        $this->db->where('exp >=', $date);
        $query = $this->db->get()->result_array();
        return $query;
    }
    public function countTransaksi()
    {
        $this->db->select('COUNT(*) AS Total_transaksi');
        $this->db->from('transaksi');
        $query = $this->db->get()->result_array();
        return $query;
    }
    public function getTotalMemberTidakAktif()
    {
        $date = date('Y-m-d');
        $this->db->select('COUNT(*) AS total_member_tidak_aktif');
        $this->db->from('member');
        $this->db->where('exp <=', $date);
        $query = $this->db->get()->result_array();
        return $query;
    }
}
