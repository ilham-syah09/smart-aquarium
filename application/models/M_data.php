<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{

    public function getSensor()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('sensor')->result();
    }

    public function getAbout()
    {
        return $this->db->get('about')->result();
    }

    public function getStatusPompa($where)
    {
        $this->db->select('*');
        $this->db->from('sensor');
        $this->db->where('status_pompa', $where);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->row();
    }
}

/* End of file M_data.php */
