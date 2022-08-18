<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class UserSecretQuestion extends Migration
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
      'id_user' => [
        'type' => 'INT',
        'constraint' => 5,
        'unsigned'   => true,
      ],
      'question' => [
        'type' => 'VARCHAR',
        'constraint' => 255,
      ],
      'answer' => [
        'type' => 'VARCHAR',
        'constraint' => 255,
      ],
      'created_at' => [
        'type'    => 'TIMESTAMP',
        'default' => new RawSql('CURRENT_TIMESTAMP'),
      ]
    ]);

    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('id_user', 'users', 'id');
    $this->forge->createTable('secret_questions');

    $this->db->enableForeignKeyChecks();
  }

  public function down()
  {
    $this->forge->dropTable('secret_questions');
  }
}
