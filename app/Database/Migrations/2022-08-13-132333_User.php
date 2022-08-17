<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class User extends Migration
{
  public function up()
  {
    $this->db->disableForeignKeyChecks();

    $this->forge->addField([
      'id' => [
        'type' => 'INT',
        'constraint' => 5,
        'unsigned' => true,
        'auto_increment' => true
      ],
      'id_secret_question' => [
        'type' => 'INT',
        'constraint' => 5,
        'unsigned'   => true,
      ],
      'name' => [
        'type' => 'VARCHAR',
        'constraint' => 255
      ],
      'email' => [
        'type' => 'VARCHAR',
        'constraint' => 255,
        'unique' => true
      ],
      'password' => [
        'type' => 'VARCHAR',
        'constraint' => 255,
      ],
      'created_at' => [
        'type'    => 'TIMESTAMP',
        'default' => new RawSql('CURRENT_TIMESTAMP'),
      ]
    ]);

    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('id_secret_question', 'secret_questions', 'id');
    $this->forge->createTable('users');

    $this->db->enableForeignKeyChecks();
  }

  public function down()
  {
    $this->forge->dropTable('users');
  }
}
