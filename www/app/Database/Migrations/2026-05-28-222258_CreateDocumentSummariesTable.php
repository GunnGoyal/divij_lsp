<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDocumentSummariesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'document_id' => [
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
        $this->forge->addForeignKey('document_id', 'documents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('summary_id', 'summaries', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('document_summaries');
    }

    public function down()
    {
        $this->forge->dropTable('document_summaries');
    }
}
