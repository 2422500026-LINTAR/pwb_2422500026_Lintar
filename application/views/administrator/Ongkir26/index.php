<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Ongkir26</h1>
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
                <a href="<?= base_url('admin/ongkir26/tambah') ?>" class="btn btn-labeled btn-primary">
                  <span class="btn-label"><i class="fa fa-plus"></i></span>
                  Ongkir
                </a>
              </p>

              <?php if ($this->session->flashdata('message')) : ?>
                <?= $this->session->flashdata('message') ?>
              <?php endif ?>

              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Ekspedisi</th>
                    <th>Jenis Layanan</th>
                    <th>Tarif per Kg</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($list_ongkir as $ongkir) : ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $ongkir['nama_ekspedisi026'] ?></td>
                      <td><?= $ongkir['jenis_layanan026'] ?></td>
                      <td><?= $ongkir['tarif_per_kg026'] ?></td>
                      <td><?= $ongkir['status026'] ?></td>
                      <td>
                        <a href="<?= base_url('admin/ongkir26/ubah/') . $ongkir['id_ongkir026'] ?>" class="badge badge-success">Ubah</a>
                        <a href="<?= base_url('admin/ongkir26/hapus/') . $ongkir['id_ongkir026'] ?>" class="badge badge-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
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