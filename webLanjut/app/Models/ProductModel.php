<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'product';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; //format hasil query
    protected $useSoftDeletes   = true; // status jika data didelete benar2 terhapus/tidak
    protected $protectFields    = true; //status perlindungan field $allowedFields
    protected $allowedFields    = ['nama', 'harga', 'jumlah', 'foto']; //daftar kolom yang boleh diinsert/update (sesuai nama kolom table)


    protected bool $allowEmptyInserts = false;  //status insert data kosong boleh/tidak
    protected bool $updateOnlyChanged = true;  //status hanya field yang berubah yang diupdate
    protected array $casts = []; //daftar untuk mengubah tipe data otomatis
    protected array $castHandlers = []; //daftar custom handler untuk cast tipe khusus

    // Dates
    protected $useTimestamps = true; //Status otomatis terisi kolom created_at/updated_at
    protected $dateFormat    = 'datetime'; 
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = []; //daftar rule validasi otomatis sebelum insert/update
    protected $validationMessages   = []; //daftar custom pesan error
    protected $skipValidation       = true; //Status untuk skip validation
    protected $cleanValidationRules = true; //status untuk mengabaikan rule yang tidak digunakan saat update

    // Callbacks
    protected $allowCallbacks = true; //status pakai fungsi callback/tidak
    protected $beforeInsert   = []; //daftar fungsi yang dipanggil sebelum insert
    protected $afterInsert    = []; //daftar fungsi yang dipanggil after insert
    protected $beforeUpdate   = []; //daftar fungsi yang dipanggil sebelum update
    protected $afterUpdate    = []; //daftar fungsi yang dipanggil after update
    protected $beforeFind     = []; //daftar fungsi yang dipanggil sebelum pencarian
    protected $afterFind      = []; //daftar fungsi yang dipanggil after pencarian
    protected $beforeDelete   = []; //daftar fungsi yang dipanggil sebelum Delete
    protected $afterDelete    = []; //daftar fungsi yang dipanggil after Delete
}
