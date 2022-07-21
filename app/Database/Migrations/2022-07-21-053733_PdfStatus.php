<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PdfStatus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'status_id' =>[
                'type' => 'VARCHAR',
                'constraint' => 10,
                'comment' => '狀態編號'
            ],
            'status_remark' =>[
                'type' => 'VARCHAR',
                'constraint' => 50,
                'comment' => '狀態備註'
            ],
            'created_at datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('status_id');
        $this->forge->createTable('PdfStatus');
    }

    public function down()
    {
       $this->forge->dropTable('PdfStatus');
    }
}
