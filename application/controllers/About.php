<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
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
            'title' => 'About Us',
            'page'  => 'about',
            'about' => $this->data->getAbout(),
        ];

        $this->load->view('index', $data);
    }

    public function add()
    {
        $img = $_FILES['image']['name'];

        if ($img) {
            $config['upload_path']      = 'uploads/about';
            $config['allowed_types']    = 'jpg|jpeg|png';
            $config['max_size']         = 2000;
            $config['remove_spaces']    = TRUE;
            $config['encrypt_name']     = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('toastr-error', $this->upload->display_errors());
                redirect('about');
            } else {
                $upload_data = $this->upload->data();

                $data = [
                    'nama'  => $this->input->post('nama'),
                    'nim'   => $this->input->post('nim'),
                    'deskripsi'   => $this->input->post('deskripsi'),
                    'image' => $upload_data['file_name']
                ];

                $insert = $this->db->insert('about', $data);

                if ($insert) {
                    $this->session->set_flashdata('toastr-success', 'success !');
                    redirect('about');
                } else {
                    $this->session->set_flashdata('toastr-error', 'failed!');
                    redirect('about');
                }
            }
        }
    }

    public function delete($id)
    {
        $get = $this->db->get('about')->row();

        $this->db->where('id', $id);
        $delete = $this->db->delete('about');

        if ($delete) {
            unlink(FCPATH . 'uploads/about/' . $get->image);
            $this->session->set_flashdata('toastr-success', 'success!');
            redirect('about');
        } else {
            $this->session->set_flashdata('toastr-error', 'gagal!');
            redirect('about');
        }
    }

    public function update()
    {
        $img = $_FILES['image']['name'];


        if ($img) {
            $config['upload_path']      = 'uploads/about';
            $config['allowed_types']    = 'jpg|jpeg|png';
            $config['max_size']         = 2000;
            $config['remove_spaces']    = TRUE;
            $config['encrypt_name']     = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('toastr-error', $this->upload->display_errors());
                redirect('about');
            } else {
                $upload_data = $this->upload->data();
                $previmage = $this->input->post('previmage');

                $data = [
                    'nama'  => $this->input->post('nama'),
                    'nim'   => $this->input->post('nim'),
                    'deskripsi'   => $this->input->post('deskripsi'),
                    'image' => $upload_data['file_name']
                ];

                $this->db->where('id', $this->input->post('id'));
                $update = $this->db->update('about', $data);

                if ($update) {
                    if ($previmage) {
                        unlink(FCPATH . 'uploads/about/' . $previmage);
                    }
                    $this->session->set_flashdata('toastr-success', 'success !');
                    redirect('about');
                } else {
                    $this->session->set_flashdata('toastr-error', 'failed!');
                    redirect('about');
                }
            }
        } else {
            $data = [
                'nama'  => $this->input->post('nama'),
                'nim'   => $this->input->post('nim'),
                'deskripsi'   => $this->input->post('deskripsi'),
            ];

            $this->db->where('id', $this->input->post('id'));
            $update = $this->db->update('about', $data);

            if ($update) {
                $this->session->set_flashdata('toastr-success', 'success !');
                redirect('about');
            } else {
                $this->session->set_flashdata('toastr-error', 'failed!');
                redirect('about');
            }
        }
    }
}

/* End of file Monitoring.php */
