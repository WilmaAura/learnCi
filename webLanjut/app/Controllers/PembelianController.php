<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TransactionModel;
class PembelianController extends BaseController
{
    protected $transactionModel;
    public function __construct(){
        helper(['number', 'form']);
        $this->transactionModel = new TransactionModel();

        // Proteksi tingkat Controller: Hanya admin yang boleh masuk
        if (session()->get('role') !== 'admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Anda tidak memiliki akses ke halaman ini.");
        }
    }
    public function index()
    {
        // Mengambil semua data transaksi dari database
        $data['transactions'] = $this->transactionModel->findAll();

        // Mengambil data diskon hari ini agar badge di navbar layout tidak error/hilang
        $db = \Config\Database::connect();
        $hariIni = date('Y-m-d');
        $diskon = $db->table('discounts')->where('tanggal', $hariIni)->get()->getRowArray();
        $data['nominal_diskon'] = $diskon ? $diskon['nominal'] : 0;

        return view('v_pembelian', $data); // Berkas view akan kita buat setelah ini
    }

    public function ubahStatus($id)
    {
        // Cari data transaksi berdasarkan ID
        $transaksi = $this->transactionModel->find($id);

        if ($transaksi) {
            // Jika status sekarang 0 (Belum Selesai), ganti jadi 1 (Sudah Selesai). Begitu juga sebaliknya.
            $statusBaru = ($transaksi['status'] == 0) ? 1 : 0;

            $this->transactionModel->update($id, [
                'status' => $statusBaru
            ]);

            return redirect()->to('pembelian')->with('success', 'Status pesanan ID #' . $id . ' berhasil diperbarui.');
        }

        return redirect()->to('pembelian')->with('failed', 'Data transaksi tidak ditemukan.');
    }
}
