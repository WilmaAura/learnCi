<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-body pt-3">
        <h5 class="card-title">Pembelian</h5>
        <p class="text-muted">History Transaksi Pembelian</p>

        <?php if (session()->getFlashData('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashData('failed')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('failed') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <table class="table datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID Pembelian</th>
                    <th scope="col">Pembeli</th>
                    <th scope="col">Waktu Pembelian</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $index => $transaksi) : ?>
                    <tr>
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= esc($transaksi['id']) ?></td>
                        <td><?= esc($transaksi['username']) ?></td>
                        <td><?= esc($transaksi['created_at'] ?? '-') ?></td>
                        <td><?= number_to_currency($transaksi['total_harga'], 'IDR') ?></td>
                        <td><?= esc($transaksi['alamat']) ?></td>
                        <td>
                            <?php if ($transaksi['status'] == 0) : ?>
                                <span class="badge bg-warning text-dark px-2 py-1" style="font-size: 11px;">Belum Selesai</span>
                            <?php else : ?>
                                <span class="badge bg-primary text-white px-2 py-1" style="font-size: 11px;">Sudah Selesai</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm me-1">Detail</button>
                            
                            <a href="<?= base_url('pembelian/status/' . $transaksi['id']) ?>" class="btn btn-info btn-sm text-white">
                                Ubah Status
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>