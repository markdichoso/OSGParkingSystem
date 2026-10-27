<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateParkingSchema extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'u_empno' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
            ],
            'u_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 254,
            ],
            'u_password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'u_regdate' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'u_createdate' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'u_status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'Pending',
            ],
        ]);
        $this->forge->addKey('u_empno', true);
        $this->forge->addUniqueKey('u_email');
        $this->forge->createTable('users_tbl', true);

        $this->forge->addField([
            'up_empno' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
            ],
            'up_fullname' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'up_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 254,
                'null'       => true,
            ],
            'up_mobileno' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'null'       => true,
            ],
            'up_division' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'up_role' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'null'       => true,
            ],
            'up_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('up_empno', true);
        $this->forge->createTable('userprofile_tbl', true);

        $this->forge->addField([
            'v_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'v_empno' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
            ],
            'v_make' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'v_model' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'v_color' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'v_plateno' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
            ],
        ]);
        $this->forge->addKey('v_id', true);
        $this->forge->addKey('v_empno');
        $this->forge->addUniqueKey(['v_empno', 'v_plateno']);
        $this->forge->createTable('vehicle_tbl', true);

        $this->forge->addField([
            'p_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'p_slotno' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
            ],
            'p_level' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'p_category' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'p_status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 0,
            ],
        ]);
        $this->forge->addKey('p_id', true);
        $this->forge->addUniqueKey(['p_slotno', 'p_level']);
        $this->forge->addKey(['p_status', 'p_category']);
        $this->forge->createTable('parking_tbl', true);

        $this->forge->addField([
            'pl_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'u_empno' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
            ],
            'v_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'pl_checkin' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'pl_checkout' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'pl_category' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
            ],
            'pl_duration' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'pl_due' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('pl_id', true);
        $this->forge->addKey(['u_empno', 'pl_checkin']);
        $this->forge->addKey('v_id');
        $this->forge->createTable('parklog_tbl', true);
    }

    public function down()
    {
        $this->forge->dropTable('parklog_tbl', true);
        $this->forge->dropTable('parking_tbl', true);
        $this->forge->dropTable('vehicle_tbl', true);
        $this->forge->dropTable('userprofile_tbl', true);
        $this->forge->dropTable('users_tbl', true);
    }
}
