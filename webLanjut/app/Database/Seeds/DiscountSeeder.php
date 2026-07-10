<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class DiscountSeeder extends Seeder
{
    public function run()
    {
        $startDate = Time::now('Asia/Jakarta');
        $nominals  = [100000, 100000, 200000, 150000, 250000, 300000, 300000, 300000, 300000, 300000];
        $data      = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'tanggal'    => $startDate->addDays($i)->format('Y-m-d'),
                'nominal'    => $nominals[$i],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => null,
                'deleted_at' => null,
            ];
        }

        // Langsung panggil lewat $this->db tanpa bikin variabel builder
        $this->db->table('discounts')->insertBatch($data);
    }
}