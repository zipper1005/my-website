<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNilaiPenyesuaian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_penyesuaian' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'kode_akun3' => [
                'type'       => 'VARCHAR',
                'constraint' => 6,
            ],
            'debit' => [
                'type'       => 'BIGINT',
                'constraint' => 12,
                'default'    => 0,
            ],
            'kredit' => [
                'type'       => 'BIGINT',
                'constraint' => 12,
                'default'    => 0,
            ],
            'id_status' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_penyesuaian', 'tbl_penyesuaian', 'id_penyesuaian', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_nilai_penyesuaian');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_nilai_penyesuaian');
    }
}
