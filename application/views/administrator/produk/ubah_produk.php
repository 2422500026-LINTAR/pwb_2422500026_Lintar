<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Ubah Produk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nama_produk" class="form-label">Nama produk</label>
                  <input type="text" class="form-control" name="nama_produk" id="nama_produk" aria-describedby="Nama produk" value="<?= $produk['nama'] ?>">
                  <small class="text-danger"><em><?= form_error('nama_produk') ?></em></small>
                </div>
                <div class="mb-3">
                  <label for="kategori_produk" class="form-label">Kategori produk</label>
                  <select class="form-control" name="kategori_produk" id="kategori_produk">
                    <option value="">-- pilih kategori --</option>
                    <?php foreach ($list_kategori as $kategori) : ?>
                      <option <?= ($produk['categori_id'] == $kategori['id_kategori']) ? 'selected' : '' ?> value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama'] ?></option>
                    <?php endforeach ?>
                  </select>
                  <small class="text-danger"><em><?= form_error('kategori_produk') ?></em></small>
                </div>
                <div class="mb-3">
                  <label for="harga_produk" class="form-label">Harga</label>
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Rp</span>
                    <input type="number" name="harga_produk" id="harga_produk" class="form-control" value="<?= $produk['harga'] ?>">
                  </div>
                </div>
                <div class="mb-3">
                  <label for="stok_produk" class="form-label">Stok produk</label>
                  <input type="number" class="form-control" name="stok_produk" id="stok_produk" aria-describedby="Stok produk" value="<?= $produk['stok'] ?>">
                  <small class="text-danger"><em><?= form_error('stok_produk') ?></em></small>
                </div>
                <div class="mb-3">
                  <label for="gambar_produk" class="form-label">Gambar Produk</label>
                  <input class="form-control" type="file" id="gambar_produk" name="gambar_produk[]" multiple>
                </div>
                <?php
                // get gambar dengan id produk
                $list_gambar = $gambar_model->get_by_produk_id($produk['id_produk']);
                ?>
                <div class="row mb-3">
                  <?php foreach ($list_gambar as $gambar) : ?>
                    <div class="col-lg-3">
                      <div class="card" style="width: 18rem;">
                        <img src="<?= base_url('uploads/produk/') . $gambar['nama_gambar'] ?>" class="card-img-top">
                        <div class="card-body d-grid">
                          <a href="#" class="btn btn-danger">Hapus</a>
                        </div>
                      </div>
                    </div>
                  <?php endforeach ?>
                </div>

                <div class="mb-3">
                  <label for="deskripsi_produk" class="form-label">Deskripsi</label>
                  <textarea name="deskripsi_produk" id="deskripsi_produk" cols="30" rows="10" class="form-control"><?= $produk['deskripsi'] ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
                <a href="<?= base_url('admin/produk') ?>" class="btn btn-danger">Kembali</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->