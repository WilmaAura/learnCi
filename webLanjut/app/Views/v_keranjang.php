<?= $this->extend('layout')?>
<?= $this->section('content')?>
<?php
if (session()->getFlashData('success')){
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?=session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
<?php
}
?>

<!-- Pastikan pembuka form sudah ada jika kamu menggunakan fitur Perbarui Keranjang -->
<?= form_open('keranjang/edit') ?>

<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Foto</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (!empty($items)) :
            foreach ($items as $index => $item):
                // Hitung balik harga asli sebelum diskon untuk kebutuhan harga coret
                // Karena $item['price'] sudah harga diskon, maka harga asli = harga diskon + nominal diskon
                $hargaAsli = $item['price'] + ($nominal_diskon ?? 0);
        ?>
            <tr>
                <td> <?=$item['name'] ?></td>
                <td><img src="<?= base_url() . "img/" . $item['options']['foto'] ?>" width="100px"></td>
                <td>
                    <?php if (isset($nominal_diskon) && $nominal_diskon > 0) : ?>
                        <!-- Menampilkan harga asli dicoret warna merah -->
                        <span style="text-decoration: line-through; color: #dc3545; font-size: 0.9em; display: block;">
                            <?= number_to_currency($hargaAsli, 'IDR') ?>
                        </span>
                    <?php endif; ?>
                    <!-- Menampilkan harga diskon (harga aktif) -->
                    <span style="color: #000;">
                        <?= number_to_currency($item['price'], 'IDR') ?>
                    </span>
                </td>
                <td>
                    <!-- input qty menggunakan array bawaan cart -->
                    <input type="number" min="1" name="qty<?= $i++ ?>" class="form-control" value="<?= $item['qty'] ?>" style="width: 80px;">
                </td>
                <td><?= number_to_currency($item['subtotal'], 'IDR') ?></td>
                <td>
                    <!-- Button hapus keranjang -->
                    <a href="<?= base_url('keranjang/delete/' . $item['rowid'] . '') ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                </td>             
            </tr>
        <?php
            endforeach;
        endif;
        ?>
    </tbody>
</table>

<div class="alert alert-info">
    <?= "Total = " . number_to_currency($total, 'IDR') ?>
</div>

<button type="submit" class="btn btn-primary">Perbarui Keranjang</button>
<a class="btn btn-warning" href="<?= base_url() ?>keranjang/clear">Kosongkan Keranjang</a>
<?php if (!empty($items)) :?>
    <a class="btn btn-success" href="<?php echo base_url() ?>checkout">Selesai Belanja</a>
<?php endif; ?>

<?= form_close() ?>
<?= $this->endSection() ?>