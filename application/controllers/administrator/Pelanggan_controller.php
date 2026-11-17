<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('pelanggan_model');
    }

    // ================= TAMPIL =================
    public function index()
    {
        $data['list_pelanggan'] = $this->pelanggan_model->get_all();
        $this->load->view('administrator/templates/header');
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/pelanggan/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    // ================= TAMBAH =================
    public function tambah_pelanggan()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $data = [
                'nama'    => ucwords($this->input->post('nama_pelanggan')),
                'email'   => $this->input->post('email_pelanggan'),
                'telepon' => $this->input->post('telepon_pelanggan'),
                'alamat'  => $this->input->post('alamat_pelanggan')
            ];
            if ($this->pelanggan_model->tambah($data)) {
                $this->__alert('success', 'Berhasil menambahkan pelanggan!!');
            } else {
                $this->__alert('danger', 'Gagal menambahkan pelanggan!!');
            }
            redirect('admin/pelanggan');
        } else {
            $this->load->view('administrator/templates/header');
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/pelanggan/tambah_pelanggan');
            $this->load->view('administrator/templates/footer');
        }
    }

    // ================= UBAH =================
    public function ubah_pelanggan($id)
    {
        $pelanggan = $this->pelanggan_model->get_by_id($id);
        if (!$pelanggan) {
            $this->__alert('danger', 'Pelanggan tidak ditemukan!!');
            redirect('admin/pelanggan');
        }
        $this->form_validation->set_rules('nama_pelanggan', 'Nama', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $data = [
                'nama'    => ucwords($this->input->post('nama_pelanggan')),
                'email'   => $this->input->post('email_pelanggan'),
                'telepon' => $this->input->post('telepon_pelanggan'),
                'alamat'  => $this->input->post('alamat_pelanggan')
            ];
            if ($this->pelanggan_model->ubah($data, $id)) {
                $this->__alert('success', 'Berhasil mengubah pelanggan!!');
            } else {
                $this->__alert('danger', 'Gagal mengubah pelanggan!!');
            }
            redirect('admin/pelanggan');
        } else {
            $data['pelanggan'] = $pelanggan;
            $this->load->view('administrator/templates/header');
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/pelanggan/ubah_pelanggan', $data);
            $this->load->view('administrator/templates/footer');
        }
    }

    // ================= HAPUS =================
    public function hapus_pelanggan($id)
    {
        $pelanggan = $this->pelanggan_model->get_by_id($id);
        if ($pelanggan) {
            if ($this->pelanggan_model->hapus($id)) {
                $this->__alert('success', 'Berhasil menghapus pelanggan!!');
            } else {
                $this->__alert('danger', 'Gagal menghapus pelanggan!!');
            }
        } else {
            $this->__alert('danger', 'Pelanggan tidak ditemukan!!');
        }
        redirect('admin/pelanggan');
    }

    // ================= PESAN ALERT =================
    private function __alert($tipe, $pesan)
    {
        $this->session->set_flashdata('message',
            '<div class="alert alert-' . $tipe . ' alert-dismissible fade show" role="alert">'
            . $pesan .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );
    }
}