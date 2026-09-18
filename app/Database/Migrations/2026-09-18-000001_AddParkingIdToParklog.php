<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddParkingIdToParklog extends Migration
{
    public function up()
    {
        $this->forge->addColumn('parklog_tbl', [
            'p_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'after'      => 'v_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('parklog_tbl', 'p_id');
    }
}
