<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class User extends Migration
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
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '400',
            ],
            'avatar' => [
                'type'       => 'VARCHAR',
                'constraint' => '400',
                'null' => true,
            ],
            'is_verify' => [
                'type'       => 'ENUM',
                'constraint' => ['0', '1'],
                'default'    => '0',
            ],
            'ip_login' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ],
            'last_login' => [
                'type'    => 'TIMESTAMP',
                'null' => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
