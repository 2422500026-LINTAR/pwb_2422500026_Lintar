<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pelanggan</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <p class="card-text">
                <a href="<?= base_url('admin/pelanggan/tambah') ?>" class="btn btn-labeled btn-primary">
                  <span class="btn-label"><i class="fa fa-plus"></i></span>
                  Pelanggan
                </a>
              </p>

              <?php if ($this->session->flashdata('message')) : ?>
                <?= $this->session->flashdata('message') ?>
              <?php endif ?>

              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($list_pelanggan as $pelanggan) : ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $pelanggan['nama_pelanggan'] ?></td>
                      <td><?= $pelanggan['email'] ?></td>
                      <td><?= $pelanggan['telp_pelanggan'] ?></td>
                      <td><?= $pelanggan['alamat'] ?></td>
                      <td>
                        <a href="<?= base_url('admin/pelanggan/ubah/') . $pelanggan['id_pelanggan'] ?>"><span class="badge bg-success">Ubah</span></a>
                        <a href="<?= base_url('admin/pelanggan/hapus/') . $pelanggan['id_pelanggan'] ?>"><span class="badge bg-danger">Hapus</span></a>
                      </td>
                    </tr>
                  <?php $no++;
                  endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>