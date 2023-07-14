<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends CI_Controller
{
    public function sensor()
    {
        $kekeruhan = $this->input->get('kekeruhan');
        $tinggiAir = $this->input->get('tinggiAir');

        if ($kekeruhan <= 20.00) {
            $status       = "JERNIH";
            $status_pompa = "SELESAI KURAS";
        } else {
            $status       = "KERUH";
            $status_pompa = "KURAS";
        }

        $data = [
            'kekeruhan'    => $kekeruhan,
            'tinggiAir'    => $tinggiAir,
            'status'       => $status,
            'status_pompa' => $status_pompa
        ];

        if ($data) {
            $this->db->order_by('id', 'desc');
            $data_sebelumnya = $this->db->get('sensor', 1)->row();

            if ($data_sebelumnya->kekeruhan != $data['kekeruhan'] && $data_sebelumnya->tinggiAir != $data['tinggiAir']) {
                # code...
                $this->db->insert('sensor', $data);
                echo 'berhasil masuk';
            } else {
                echo 'Nilai masih sama';
            }
        } else {
            echo 'server error';
        }
    }

    public function setting()
    {
        $data = $this->db->get('setting')->row();

        $now = date('H:i');

        if ($now == $data->jadwal1 || $now == $data->jadwal2 || $now == $data->jadwal3) {
            echo "ON#OK";
        } else {
            echo "OFF#OK";
        }
    }
}

  /* End of file Api.php */
