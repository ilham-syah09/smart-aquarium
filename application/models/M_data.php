<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{

    public function getSensor()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('sensor')->result();
    }
}

/* End of file M_data.php */
