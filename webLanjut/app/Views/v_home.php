<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<div class="row">
    <?php foreach ($products as $key => $item) : ?>         
            <div class="col-lg-6">
                <?= form_open('keranjang') ?>
                <?php
                // 1. Hitung harga final setelah dikurangi diskon hari ini
                $hargaFinal = $item['harga'] - $nominal_diskon;
                if ($hargaFinal < 0) $hargaFinal = 0; // Jaga-jaga agar tidak minus

                echo form_hidden('id', $item['id']);
                echo form_hidden('nama', $item['nama']);
                // 2. Harga yang dikirim ke keranjang adalah harga setelah diskon
                echo form_hidden('harga', (string)$hargaFinal);
                echo form_hidden('foto', $item['foto']);
                ?>
                <div class="card">
                    <div class="card-body text-center">
                        <img src="<?= base_url() . "img/" . $item['foto'] ?>" alt="..." width="50%">
                        <h5 class="card-title">
                            <?= $item['nama'] ?><br>
                            
                            <?php if ($nominal_diskon > 0) : ?>
                                <span style="text-decoration: line-through; color: #dc3545; font-size: 0.85em; margin-right: 5px;">
                                    <?= number_to_currency($item['harga'], 'IDR') ?>
                                </span> 
                                <span style="color: #0d6efd; font-weight: bold;">
                                    <?= number_to_currency($hargaFinal, 'IDR') ?>
                                </span>
                            <?php else : ?>
                                <?= number_to_currency($item['harga'], 'IDR') ?>
                            <?php endif; ?>
                        </h5>
                        <button type="submit" class="btn btn-info rounded-pill">Beli</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div> 
    <?php endforeach ?> 
</div>
<?= $this->endSection() ?>