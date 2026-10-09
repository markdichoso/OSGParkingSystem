<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRememberTokens extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'selector' => [
                'type'       => 'CHAR',
                'constraint' => 32,
            ],
            'token_hash' => [
                'type'       => 'CHAR',
                'constraint' => 64,
            ],
            'u_empno' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
            ],
            'expires_at' => [
                'type' => 'DATETIME',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('selector', true);
        $this->forge->addKey('u_empno');
        $this->forge->addKey('expires_at');
        $this->forge->createTable('remember_tokens', true);
    }

    public function down()
    {
        $this->forge->dropTable('remember_tokens', true);
    }
}
