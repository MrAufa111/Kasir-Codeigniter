<?php

use PhpOffice\PhpSpreadsheet\Calculation\Information\Value;

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        cek_role();
        $this->load->model('M_dash', 'model');
    }
    public function index()
    {
        $data['page'] = 'admin/index';
        $data['title'] = 'Dashboard';

        $this->load->view('admin/template/index', $data);
    }
    public function getCountPemasukan()
    {

        $data['total_penjualan'] = $this->model->countPemasukan();
        $data['total_member'] = $this->model->countMember();
        $data['memberTidakAktif'] = $this->model->getTotalMemberTidakAktif();
        $data['countTransaksi'] = $this->model->countTransaksi();
        echo json_encode($data);
    }
}
