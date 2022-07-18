<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Permission extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'permission_id' =>[
                'type' => 'INT',
            ],
            'permission_name' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '權限名稱'
            ],
            'created_at datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('permission_id');
        $this->forge->createTable('Permission');
    }

    public function down()
    {
        $this->forge->dropTable('Permission');
    }
}
