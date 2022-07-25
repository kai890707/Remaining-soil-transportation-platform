<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Government extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'government_id' =>[
                'type' => 'INT',
                'auto_increment' =>true
            ],
            'government_name' =>[
                'type' => 'VARCHAR',
                'constraint' => 30,
                'comment' => '政府單位名稱'
            ],
            'government_principalName' =>[
                'type' => 'VARCHAR',
                'constraint' => 10,
                'comment' => '政府單位負責人姓名'
            ],
            'government_principalPhone' =>[
                'type' => 'VARCHAR',
                'constraint' => 20,
                'comment' => '政府單位負責人電話'
            ],
            'government_address' =>[
                'type' => 'VARCHAR',
                'constraint' => 20,
                'comment' => '政府單位地址'
            ],
            'user_id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'comment' => '使用者id'
            ],
            'permission_id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'comment' => '權限id'
            ],
            'created_at datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addPrimaryKey('government_id');
        $this->forge->createTable('Government');
    }

    public function down()
    {
        $this->forge->dropTable('Government');
    }
}
