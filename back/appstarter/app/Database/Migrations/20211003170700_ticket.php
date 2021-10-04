<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ticket extends Migration
{
    
    public function up()
    {
        
        $this->forge->addField([
            'TCK_ID'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'TCK_TITLE'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'TCK_MESSAGE' => [
                'type' => 'TEXT',
            ],
            'TCK_TYPE' => [
                'type' => 'ENUM',
                'constraint' => "'en attente','en cours','traité','annulé'"
            ],
        ]);
        $this->forge->addKey('TCK_ID', true);
        $this->forge->createTable('T_TICKET_TCK');
    }

    public function down()
    {
        $this->forge->dropTable('T_TICKET_TCK');
    }
}