<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Ubah Pelanggan</h1>
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
              <form method="post">
                <div class="mb-3">
                  <label for="nama_pelanggan" class="form-label">Nama</label>
                  <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" value="<?= $pelanggan['nama'] ?>">
                  <small class="text-danger"><em><?= form_error('nama_pelanggan') ?></em></small>
                </div>
                <div class="mb-3">
                  <label for="email_pelanggan" class="form-label">Email</label>
                  <input type="text" class="form-control" name="email_pelanggan" id="email_pelanggan" value="<?= $pelanggan['email'] ?>">
                </div>
                <div class="mb-3">
                  <label for="telepon_pelanggan" class="form-label">Telepon</label>
                  <input type="text" class="form-control" name="telepon_pelanggan" id="telepon_pelanggan" value="<?= $pelanggan['telepon'] ?>">
                </div>
                <div class="mb-3">
                  <label for="alamat_pelanggan" class="form-label">Alamat</label>
                  <textarea name="alamat_pelanggan" id="alamat_pelanggan" rows="5" class="form-control"><?= $pelanggan['alamat'] ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="<?= base_url('admin/pelanggan') ?>" class="btn btn-danger">Kembali</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>