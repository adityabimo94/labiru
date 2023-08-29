<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Todo extends Migration
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_done' => [
                'type'       => 'ENUM',
                'constraint' => ['0', '1'],
                'default'    => '0',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('todo');
    }

    public function down()
    {
        $this->forge->dropTable('todo');
    }
}
