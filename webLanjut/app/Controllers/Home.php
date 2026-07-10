<?php

namespace App\Controllers;

use App\Models\ProductModel; //Import productModel
class Home extends BaseController
{
    protected $productModel;

    function __construct(){
        helper(['number', 'form']);
        $this->productModel = new ProductModel(); //
    }

    public function index(): string
    {
      // 1. Ambil semua data produk seperti semula
        $products = $this->productModel->findAll(); 

        // 2. Ambil tanggal hari ini (Format: Y-m-d)
        $hariIni = date('Y-m-d');

        // 3. Ambil koneksi database untuk cek diskon hari ini
        $db = \Config\Database::connect();
        $diskon = $db->table('discounts')
                     ->where('tanggal', $hariIni)
                     ->get()
                     ->getRowArray();

        // 4. Masukkan ke array data untuk dikirim ke view
        $data['products'] = $products;
        $data['nominal_diskon'] = $diskon ? $diskon['nominal'] : 0; 

        return view('v_home', $data);
    }
    public function contact(): string{
        return view('v_contact');
    }
}
