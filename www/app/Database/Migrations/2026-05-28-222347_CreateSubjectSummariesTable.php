<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubjectSummariesTable extends Migration
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
            'summary_id' => [
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
        $this->forge->addForeignKey('summary_id', 'summaries', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('subject_summaries');
    }

    public function down()
    {
        $this->forge->dropTable('subject_summaries');
    }
}
