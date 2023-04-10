<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring extends CI_Controller
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
        $data = [
            'title' => 'Monitoring data',
            'page'  => 'monitoring',
            'nilai' => $this->data->getSensor(),
        ];

        $this->load->view('index', $data);
    }

    public function delete($id)
    {
        $this->db->delete('sensor', ['id' => $id]);
        $this->session->set_flashdata('toastr-success', 'Data berhasil dihapus!');
        redirect('monitoring', 'refresh');
    }
}

/* End of file Monitoring.php */
