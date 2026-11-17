<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ongkir26_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('ongkir26_model');
    }

    // ================= TAMPIL =================
    public function index()
    {
        $data['list_ongkir'] = $this->ongkir26_model->get_all();
        $this->load->view('administrator/templates/header');
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/Ongkir26/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    // ================= TAMBAH =================
    public function tambah_ongkir26()
    {
        $this->form_validation->set_rules('nama_ekspedisi026', 'Nama Ekspedisi', 'required');
        $this->form_validation->set_rules('jenis_layanan026', 'Jenis Layanan', 'required');
        $this->form_validation->set_rules('tarif_per_kg026', 'Tarif per Kg', 'required');
        $this->form_validation->set_rules('status026', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('administrator/templates/header');
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/Ongkir26/tambah_Ongkir26');
            $this->load->view('administrator/templates/footer');
        } else {
            $data = [
                'nama_ekspedisi026' => $this->input->post('nama_ekspedisi026'),
                'jenis_layanan026'  => $this->input->post('jenis_layanan026'),
                'tarif_per_kg026'   => $this->input->post('tarif_per_kg026'),
                'status026'         => $this->input->post('status026'),
            ];
            if ($this->ongkir26_model->tambah($data)) {
                $this->__alert('success', 'Berhasil menambah ongkir!!');
            } else {
                $this->__alert('danger', 'Gagal menambah ongkir!!');
            }
            redirect('admin/ongkir26');
        }
    }

    // ================= UBAH =================
    public function ubah_ongkir26($id)
    {
        $ongkir = $this->ongkir26_model->get_by_id($id);
        if (!$ongkir) {
            $this->__alert('danger', 'Ongkir tidak ditemukan!!');
            redirect('admin/ongkir26');
        }

        $this->form_validation->set_rules('nama_ekspedisi026', 'Nama Ekspedisi', 'required');
        $this->form_validation->set_rules('jenis_layanan026', 'Jenis Layanan', 'required');
        $this->form_validation->set_rules('tarif_per_kg026', 'Tarif per Kg', 'required');
        $this->form_validation->set_rules('status026', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['ongkir'] = $ongkir;
            $this->load->view('administrator/templates/header');
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/Ongkir26/ubah_Ongkir26', $data);
            $this->load->view('administrator/templates/footer');
        } else {
            $data = [
                'nama_ekspedisi026' => $this->input->post('nama_ekspedisi026'),
                'jenis_layanan026'  => $this->input->post('jenis_layanan026'),
                'tarif_per_kg026'   => $this->input->post('tarif_per_kg026'),
                'status026'         => $this->input->post('status026'),
            ];
            if ($this->ongkir26_model->ubah($data, $id)) {
                $this->__alert('success', 'Berhasil mengubah ongkir!!');
            } else {
                $this->__alert('danger', 'Gagal mengubah ongkir!!');
            }
            redirect('admin/ongkir26');
        }
    }

    // ================= HAPUS =================
    public function hapus_ongkir26($id)
    {
        $ongkir = $this->ongkir26_model->get_by_id($id);
        if ($ongkir) {
            if ($this->ongkir26_model->hapus($id)) {
                $this->__alert('success', 'Berhasil menghapus ongkir!!');
            } else {
                $this->__alert('danger', 'Gagal menghapus ongkir!!');
            }
        } else {
            $this->__alert('danger', 'Ongkir tidak ditemukan!!');
        }
        redirect('admin/ongkir26');
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