<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederAkun3 extends Seeder
{
    public function run()
    {
        $data = [
            // Aktiva Lancar (kode_akun1 = 1, kode_akun2 = 1)
            [
                'kode_akun3' => 1101,
                'nama_akun3' => 'Kas',
                'kode_akun1' => 1,
                'kode_akun2' => 1,
            ],
            [
                'kode_akun3' => 1102,
                'nama_akun3' => 'Piutang Usaha',
                'kode_akun1' => 1,
                'kode_akun2' => 1,
            ],
            [
                'kode_akun3' => 1103,
                'nama_akun3' => 'Perlengkapan Kantor',
                'kode_akun1' => 1,
                'kode_akun2' => 1,
            ],
            [
                'kode_akun3' => 1104,
                'nama_akun3' => 'Sewa Dibayar Dimuka',
                'kode_akun1' => 1,
                'kode_akun2' => 1,
            ],
            [
                'kode_akun3' => 1105,
                'nama_akun3' => 'Asuransi Dibayar Dimuka',
                'kode_akun1' => 1,
                'kode_akun2' => 1,
            ],

            // Aktiva Tetap (kode_akun1 = 1, kode_akun2 = 2)
            [
                'kode_akun3' => 1201,
                'nama_akun3' => 'Peralatan Kantor',
                'kode_akun1' => 1,
                'kode_akun2' => 2,
            ],
            [
                'kode_akun3' => 1202,
                'nama_akun3' => 'Akumulasi Penyusutan Peralatan',
                'kode_akun1' => 1,
                'kode_akun2' => 2,
            ],
            [
                'kode_akun3' => 1203,
                'nama_akun3' => 'Kendaraan',
                'kode_akun1' => 1,
                'kode_akun2' => 2,
            ],
            [
                'kode_akun3' => 1204,
                'nama_akun3' => 'Akumulasi Penyusutan Kendaraan',
                'kode_akun1' => 1,
                'kode_akun2' => 2,
            ],
            [
                'kode_akun3' => 1205,
                'nama_akun3' => 'Gedung',
                'kode_akun1' => 1,
                'kode_akun2' => 2,
            ],
            [
                'kode_akun3' => 1206,
                'nama_akun3' => 'Akumulasi Penyusutan Gedung',
                'kode_akun1' => 1,
                'kode_akun2' => 2,
            ],
            [
                'kode_akun3' => 1207,
                'nama_akun3' => 'Tanah',
                'kode_akun1' => 1,
                'kode_akun2' => 2,
            ],

            // Utang Jangka Pendek (kode_akun1 = 2, kode_akun2 = 3)
            [
                'kode_akun3' => 2101,
                'nama_akun3' => 'Utang Usaha',
                'kode_akun1' => 2,
                'kode_akun2' => 3,
            ],
            [
                'kode_akun3' => 2102,
                'nama_akun3' => 'Utang Gaji',
                'kode_akun1' => 2,
                'kode_akun2' => 3,
            ],
            [
                'kode_akun3' => 2103,
                'nama_akun3' => 'Pendapatan Diterima Dimuka',
                'kode_akun1' => 2,
                'kode_akun2' => 3,
            ],

            // Utang Jangka Panjang (kode_akun1 = 2, kode_akun2 = 4)
            [
                'kode_akun3' => 2201,
                'nama_akun3' => 'Utang Bank',
                'kode_akun1' => 2,
                'kode_akun2' => 4,
            ],
            [
                'kode_akun3' => 2202,
                'nama_akun3' => 'Utang Hipotek',
                'kode_akun1' => 2,
                'kode_akun2' => 4,
            ],

            // Modal (kode_akun1 = 3, kode_akun2 = 5)
            [
                'kode_akun3' => 3101,
                'nama_akun3' => 'Modal Pemilik',
                'kode_akun1' => 3,
                'kode_akun2' => 5,
            ],
            // Prive (kode_akun1 = 3, kode_akun2 = 6)
            [
                'kode_akun3' => 3201,
                'nama_akun3' => 'Prive Pemilik',
                'kode_akun1' => 3,
                'kode_akun2' => 6,
            ],

            // Pendapatan Usaha (kode_akun1 = 4, kode_akun2 = 7)
            [
                'kode_akun3' => 4101,
                'nama_akun3' => 'Pendapatan Usaha',
                'kode_akun1' => 4,
                'kode_akun2' => 7,
            ],
            // Pendapatan di Luar Usaha (kode_akun1 = 4, kode_akun2 = 8)
            [
                'kode_akun3' => 4201,
                'nama_akun3' => 'Pendapatan di Luar Usaha',
                'kode_akun1' => 4,
                'kode_akun2' => 8,
            ],

            // Beban Usaha (kode_akun1 = 5, kode_akun2 = 9)
            [
                'kode_akun3' => 5101,
                'nama_akun3' => 'Beban Gaji',
                'kode_akun1' => 5,
                'kode_akun2' => 9,
            ],
            [
                'kode_akun3' => 5102,
                'nama_akun3' => 'Beban Iklan',
                'kode_akun1' => 5,
                'kode_akun2' => 9,
            ],
            [
                'kode_akun3' => 5103,
                'nama_akun3' => 'Beban Asuransi',
                'kode_akun1' => 5,
                'kode_akun2' => 9,
            ],
            [
                'kode_akun3' => 5104,
                'nama_akun3' => 'Beban Telepon',
                'kode_akun1' => 5,
                'kode_akun2' => 9,
            ],
            [
                'kode_akun3' => 5105,
                'nama_akun3' => 'Beban Sewa',
                'kode_akun1' => 5,
                'kode_akun2' => 9,
            ],
            [
                'kode_akun3' => 5106,
                'nama_akun3' => 'Beban Penyusutan Peralatan',
                'kode_akun1' => 5,
                'kode_akun2' => 9,
            ],
            [
                'kode_akun3' => 5107,
                'nama_akun3' => 'Beban Perlengkapan',
                'kode_akun1' => 5,
                'kode_akun2' => 9,
            ],

            // Beban di Luar Usaha (kode_akun1 = 5, kode_akun2 = 10)
            [
                'kode_akun3' => 5201,
                'nama_akun3' => 'Beban Bunga',
                'kode_akun1' => 5,
                'kode_akun2' => 10,
            ],
        ];

        $this->db->table('akun3s')->insertBatch($data);
    }
}
