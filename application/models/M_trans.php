<?php
class M_trans extends CI_Model
{
    public function getNoTransaksi()
    {
        $this->db->select_max("no_transaksi");
        $query = $this->db->get("transaksi");
        $result = $query->row();

        $getMax = $result->no_transaksi;

        $selectMax = $getMax + 1;
        return $selectMax;
    }
    public function insertTransaksi($data_transaksi)
    {
        $this->db->insert("transaksi", $data_transaksi);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
}