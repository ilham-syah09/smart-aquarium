<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('log_admin'))) {
            $this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
            redirect('auth', 'refresh');
        }

        $this->db->where('id', $this->session->userdata('id'));
        $this->dt_admin = $this->db->get('user')->row();

        $this->load->model('M_data', 'data');
    }


    public function index()
    {
        $jadwal = $this->db->get('setting', 1)->row();

        $data = [
            'title'     => 'Home page',
            'page'      => 'home',
            'jadwal'    => $jadwal
        ];

        $this->load->view('index', $data);
    }

    public function getRealtime()
    {
        $this->db->order_by('id', 'desc');
        $kekeruhan = $this->db->get('sensor', 1)->row();

        $record = $this->db->get('sensor')->num_rows();


        $data = [
            'kekeruhan' => $kekeruhan,
            'record'    => $record
        ];

        echo json_encode($data);
    }

    public function updateJadwal()
    {
        $data = [
            'jadwalPakan'   => $this->input->post('jadwalPakan')
        ];

        $this->db->where('id', 1);
        $this->db->update('setting', $data);

        $this->session->set_flashdata('toastr-success', 'Jadwal berhasil diperbaharui');
        redirect('admin', 'refresh');
    }
}

/* End of file Home.php */
