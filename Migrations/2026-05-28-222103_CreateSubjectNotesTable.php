<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubjectNotesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'subject_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'note_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('subject_id', 'subjects', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('note_id', 'notes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('subject_notes');
    }

    public function down()
    {
        $this->forge->dropTable('subject_notes');
    }
}
