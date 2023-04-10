<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
    }


    public function index()
    {
        $data = [
            'title' => 'Profile',
            'page'  => 'profile',
        ];

        $this->load->view('index', $data);
    }

    public function update()
    {
        if ($this->input->post('password')) {

            $img = $_FILES['image']['name'];

            if ($img) {
                $config['upload_path']      = 'uploads/profile';
                $config['allowed_types']    = 'jpg|jpeg|png';
                $config['max_size']         = 2000;
                $config['remove_spaces']    = TRUE;
                $config['encrypt_name']     = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $this->session->set_flashdata('toastr-error', $this->upload->display_errors());
                    redirect('profile');
                } else {
                    $upload_data = $this->upload->data();
                    $previmage = $this->input->post('previmage');

                    $data = [
                        'name'  => $this->input->post('name'),
                        'username'  => $this->input->post('username'),
                        'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                        'image'     => $upload_data['file_name']
                    ];

                    $this->db->where('id', $this->dt_admin->id);
                    $insert = $this->db->update('user', $data);

                    if ($insert) {
                        if ($previmage != 'default.png') {
                            unlink(FCPATH . 'uploads/profile/' . $previmage);
                        }
                        $this->session->set_flashdata('toastr-success', 'success !');
                        redirect('profile');
                    } else {
                        $this->session->set_flashdata('toastr-error', 'failed!');
                        redirect('profile');
                    }
                }
            } else {
                $data = [
                    'name'  => $this->input->post('name'),
                    'username'  => $this->input->post('username'),
                    'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                ];

                $this->db->where('id', $this->dt_admin->id);
                $insert = $this->db->update('user', $data);

                if ($insert) {
                    $this->session->set_flashdata('toastr-success', 'success !');
                    redirect('profile');
                } else {
                    $this->session->set_flashdata('toastr-error', 'failed!');
                    redirect('profile');
                }
            }
        } else {
            $img = $_FILES['image']['name'];

            if ($img) {
                $config['upload_path']      = 'uploads/profile';
                $config['allowed_types']    = 'jpg|jpeg|png';
                $config['max_size']         = 2000;
                $config['remove_spaces']    = TRUE;
                $config['encrypt_name']     = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $this->session->set_flashdata('toastr-error', $this->upload->display_errors());
                    redirect('profile');
                } else {
                    $upload_data = $this->upload->data();
                    $previmage = $this->input->post('previmage');

                    $data = [
                        'name'  => $this->input->post('name'),
                        'username'  => $this->input->post('username'),
                        'image'     => $upload_data['file_name']
                    ];

                    $this->db->where('id', $this->dt_admin->id);
                    $insert = $this->db->update('user', $data);

                    if ($insert) {
                        if ($previmage != 'default.png') {
                            unlink(FCPATH . 'uploads/profile/' . $previmage);
                        }
                        $this->session->set_flashdata('toastr-success', 'success !');
                        redirect('profile');
                    } else {
                        $this->session->set_flashdata('toastr-error', 'failed!');
                        redirect('profile');
                    }
                }
            } else {
                $data = [
                    'name'  => $this->input->post('name'),
                    'username'  => $this->input->post('username'),
                ];

                $this->db->where('id', $this->dt_admin->id);
                $insert = $this->db->update('user', $data);

                if ($insert) {
                    $this->session->set_flashdata('toastr-success', 'success !');
                    redirect('profile');
                } else {
                    $this->session->set_flashdata('toastr-error', 'failed!');
                    redirect('profile');
                }
            }
        }
    }
}

/* End of file Monitoring.php */
