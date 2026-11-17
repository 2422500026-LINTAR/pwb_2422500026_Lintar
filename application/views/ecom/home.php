<div class="container mt-4">
    <h4 class="mb-3">Produk Terbaru</h4>
    <div class="row">
        <?php foreach ($list_produk as $p): ?>
            <div class="col-6 col-md-3 mb-4">
                <div class="card h-100">
                    <div class="bg-secondary bg-opacity-25 d-flex align-items-center justify-content-center" style="height:160px;">
                        <i class="bi bi-image fs-1 text-secondary"></i>
                    </div>
                    <div class="card-body">
                        <a href="#" class="d-block mb-2"><?= $p['pd_nama'] ?></a>
                        <div class="d-flex justify-content-between small">
                            <span>Rp <?= number_format($p['harga'] ?? 0, 0, ',', '.') ?></span>
                            <span class="text-muted">Stok <?= $p['stok'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mb-4">
        <a href="#" class="btn btn-outline-primary btn-sm">Lihat Semua Produk</a>
    </div>
</div>