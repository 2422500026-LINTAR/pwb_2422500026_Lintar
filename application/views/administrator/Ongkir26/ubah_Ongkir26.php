<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Ubah Ongkir</h1>
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
                  <label for="nama_ekspedisi026" class="form-label">Nama Ekspedisi</label>
                  <input type="text" class="form-control" name="nama_ekspedisi026" id="nama_ekspedisi026" value="<?= set_value('nama_ekspedisi026', $ongkir['nama_ekspedisi026']) ?>">
                  <small class="text-danger"><em><?= form_error('nama_ekspedisi026') ?></em></small>
                </div>
                <div class="mb-3">
                  <label for="jenis_layanan026" class="form-label">Jenis Layanan</label>
                  <input type="text" class="form-control" name="jenis_layanan026" id="jenis_layanan026" value="<?= set_value('jenis_layanan026', $ongkir['jenis_layanan026']) ?>">
                  <small class="text-danger"><em><?= form_error('jenis_layanan026') ?></em></small>
                </div>
                <div class="mb-3">
                  <label for="tarif_per_kg026" class="form-label">Tarif per Kg</label>
                  <input type="text" class="form-control" name="tarif_per_kg026" id="tarif_per_kg026" value="<?= set_value('tarif_per_kg026', $ongkir['tarif_per_kg026']) ?>">
                  <small class="text-danger"><em><?= form_error('tarif_per_kg026') ?></em></small>
                </div>
                <div class="mb-3">
                  <label for="status026" class="form-label">Status</label>
                  <select name="status026" id="status026" class="form-control">
                    <option value="Aktif" <?= set_select('status026', 'Aktif', $ongkir['status026'] == 'Aktif') ?>>Aktif</option>
                    <option value="Tidak Aktif" <?= set_select('status026', 'Tidak Aktif', $ongkir['status026'] == 'Tidak Aktif') ?>>Tidak Aktif</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= base_url('admin/ongkir26') ?>" class="btn btn-danger">Kembali</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>