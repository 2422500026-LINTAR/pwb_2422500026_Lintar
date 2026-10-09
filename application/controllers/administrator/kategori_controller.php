<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class kategori_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('produk_kategori_model');
    }

    public function index()
    {
        $data['list_kategori'] = $this->produk_kategori_model->get_all();
        $this->load->view('administrator/templates/header');
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/kategori/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    // ================= TAMBAH =================
    public function tambah_kategori()
    {
        $data['title'] = 'Tambah Kategori';

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->__simpan_kategori();
        } else {
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/kategori/tambah_kategori');
            $this->load->view('administrator/templates/footer');
        }
    }

    private function __simpan_kategori()
    {
        $data = [
            'nama'      => ucwords($this->input->post('nama_kategori')),
            'deskripsi' => ucfirst($this->input->post('deskripsi_kategori'))
        ];
        $simpan = $this->produk_kategori_model->tambah($data);
        if ($simpan) {
            $this->__alert('success', 'Berhasil menambahkan kategori!!');
        } else {
            $this->__alert('danger', 'Gagal menambahkan kategori!!');
        }
        redirect('admin/kategori');
    }

    // ================= HAPUS =================
    public function hapus_kategori($id)
    {
        $kategori = $this->produk_kategori_model->get_by_id($id);
        if ($kategori) {
            $hapus = $this->produk_kategori_model->hapus($id);
            if ($hapus) {
                $this->__alert('success', 'Berhasil menghapus kategori!!');
            } else {
                $this->__alert('danger', 'Gagal menghapus kategori!!');
            }
        } else {
            $this->__alert('danger', 'Kategori tidak ditemukan!!');
        }
        redirect('admin/kategori');
    }

    // ================= UBAH =================
    public function ubah_kategori($id)
    {
        $kategori = $this->produk_kategori_model->get_by_id($id);
        if ($kategori) {
            $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $this->__ubah_kategori($id);
            } else {
                $data['title']    = 'Ubah Kategori';
                $data['kategori'] = $kategori;
                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar');
                $this->load->view('administrator/kategori/ubah_kategori', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            $this->__alert('danger', 'Kategori tidak ditemukan!!');
            redirect('admin/kategori');
        }
    }

    private function __ubah_kategori($id)
    {
        $data = [
            'nama'      => ucwords($this->input->post('nama_kategori')),
            'deskripsi' => ucfirst($this->input->post('deskripsi_kategori'))
        ];
        $ubah = $this->produk_kategori_model->ubah($data, $id);
        if ($ubah) {
            $this->__alert('success', 'Berhasil mengubah kategori!!');
        } else {
            $this->__alert('danger', 'Gagal mengubah kategori!!');
        }
        redirect('admin/kategori');
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