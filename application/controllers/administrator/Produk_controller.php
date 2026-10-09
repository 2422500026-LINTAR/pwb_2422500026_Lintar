<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->library('session');
        $this->load->library('form_validation');
        // Load model
        $this->load->model('produk_model');
        $this->load->model('produk_kategori_model');
        $this->load->model('produk_gambar_model');
    }

    // ================= TAMPIL =================
    public function index()
    {
        $data['title'] = 'Daftar Produk';
        $data['list_produk'] = $this->produk_model->get_all();
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/produk/index');
        $this->load->view('administrator/templates/footer');
    }

    // ================= TAMBAH =================
    public function tambah_produk()
    {
        $data['title'] = 'Tambah Produk';
        $this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
        $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->__simpan_produk();
        } else {
            $data['list_kategori'] = $this->produk_kategori_model->get_all();
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/produk/tambah_produk', $data);
            $this->load->view('administrator/templates/footer');
        }
    }

    private function __simpan_produk()
    {
        $data = [
            'nama'        => ucwords($this->input->post('nama_produk')),
            'categori_id' => $this->input->post('kategori_produk'),
            'harga'       => $this->input->post('harga_produk'),
            'stok'        => $this->input->post('stok_produk'),
            'deskripsi'   => ucfirst($this->input->post('deskripsi_produk'))
        ];

        # simpan dan return id_produk yang disimpan
        $id_produk = $this->produk_model->tambah($data);

        # simpan data, lalu upload gambar
        $count = count($_FILES['gambar_produk']['name']);
        if ($count > 0) {
            // jika ada gambar upload
            $this->__produk_gambar_upload($count, $id_produk);
        }

        $this->__alert('success', 'Berhasil menambahkan produk!!');
        redirect('admin/produk');
    }

    private function __produk_gambar_upload($count, $id_produk)
    {
        for ($i = 0; $i < $count; $i++) {
            if (!empty($_FILES['gambar_produk']['name'][$i])) {
                $_FILES['file']['name']     = $_FILES['gambar_produk']['name'][$i];
                $_FILES['file']['type']     = $_FILES['gambar_produk']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['gambar_produk']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['gambar_produk']['error'][$i];
                $_FILES['file']['size']     = $_FILES['gambar_produk']['size'][$i];

                $config['upload_path']   = 'uploads/produk/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size']      = '5000';
                $config['file_name']     = "produk-" . $id_produk . '-' . $i;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $data = [
                        'nama_gambar' => $filename,
                        'produk_id'   => $id_produk
                    ];
                    $this->produk_gambar_model->tambah($data);
                }
            }
        }
    }

    // ================= UBAH =================
    public function ubah_produk($id)
    {
        // check dulu apakah id dengan produk ada?
        $produk = $this->produk_model->get_by_id($id);
        if ($produk) {
            $this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
            $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required');
            if ($this->form_validation->run() !== FALSE) {
                $this->__ubah_produk($id);
            } else {
                $data['title'] = 'Ubah produk';
                $data['produk'] = $produk;
                $data['list_kategori'] = $this->produk_kategori_model->get_all();
                $data['gambar_model'] = $this->produk_gambar_model;
                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar');
                $this->load->view('administrator/produk/ubah_produk', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            $this->__alert('danger', 'Produk tidak ditemukan!!');
            redirect('admin/produk');
        }
    }

    private function __ubah_produk($id)
    {
        $data = [
            'nama'        => ucwords($this->input->post('nama_produk')),
            'categori_id' => $this->input->post('kategori_produk'),
            'harga'       => $this->input->post('harga_produk'),
            'stok'        => $this->input->post('stok_produk'),
            'deskripsi'   => ucfirst($this->input->post('deskripsi_produk'))
        ];

        $ubah = $this->produk_model->ubah($data, $id);

        // cek apakah ada gambar baru yang dipilih
        $ada_gambar_baru = !empty($_FILES['gambar_produk']['name'][0]);
        if ($ada_gambar_baru) {
            // hapus gambar lama (database dan file)
            $list_gambar = $this->produk_gambar_model->get_by_produk_id($id);
            foreach ($list_gambar as $gambar) {
                $this->produk_gambar_model->hapus($gambar['id_gambar']);
                $path = './uploads/produk/' . $gambar['nama_gambar'];
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            // upload gambar baru
            $count = count($_FILES['gambar_produk']['name']);
            $this->__produk_gambar_upload($count, $id);
        }

        if ($ubah || $ada_gambar_baru) {
            $this->__alert('success', 'Berhasil mengubah produk!!');
        } else {
            $this->__alert('danger', 'Gagal mengubah produk!!');
        }
        redirect('admin/produk');
    }

    // ================= HAPUS =================
    public function hapus_produk($id)
    {
        // check apakah ada produk
        $produk = $this->produk_model->get_by_id($id);
        if ($produk) {
            // ambil data gambar
            $list_gambar = $this->produk_gambar_model->get_by_produk_id($id);
            foreach ($list_gambar as $gambar) {
                $id_gambar = $gambar['id_gambar'];
                $nama_gambar = $gambar['nama_gambar'];
                // hapus gambar di database
                $this->produk_gambar_model->hapus($id_gambar);
                // hapus gambar di file
                $path = './uploads/produk/' . $nama_gambar;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            // hapus produk di database
            $this->produk_model->hapus($id);
            $this->__alert('success', 'Berhasil menghapus produk!!');
        } else {
            $this->__alert('danger', 'Produk tidak ditemukan!!');
        }
        redirect('admin/produk');
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