<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function sensor()
    {
        $kekeruhan = $this->input->get('kekeruhan');

        if ($kekeruhan != null) {
            $data = [
                'kekeruhan' => $kekeruhan
            ];

            $this->db->order_by('id', 'desc');

            $data_sebelumnya = $this->db->get('sensor', 1)->row();

            $kekeruhan_sebelumnya    = $data_sebelumnya->kekeruhan;

            if ($data_sebelumnya) {
                if ($kekeruhan_sebelumnya != $kekeruhan) {
                    # code...
                    $this->db->insert('sensor', $data);

                    echo 'berhasil masuk';
                } else {
                    echo 'Nilai masih sama';
                }
            } else {
                $this->db->insert('sensor', $data);

                echo 'berhasil masuk';
            }
        } else {
            echo 'data masih sama!';
        }
    }

    public function setting()
    {
        $data = $this->db->get('setting')->row();

        $jam_sekarang = date('H:i');

        if ($jam_sekarang == $data->jadwalPakan) {
            echo "ON#" . "#OK";
        } else {
            echo "OFF#" . "#OK";
        }
    }
}

/* End of file Api.php */
