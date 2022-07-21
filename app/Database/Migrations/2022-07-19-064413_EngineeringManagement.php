<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EngineeringManagement extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'engineering_id' =>[
                'type' => 'INT',
                'auto_increment' =>true
            ],
            'engineering_name' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '工程名稱'
            ],
            'engineering_projectNumber' =>[
                'type' => 'VARCHAR',
                'constraint' => 255,
                'comment' => '工程流向編號'
            ],
            'contractCompany_id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'comment' => '承造公司外來鍵'
            ],
            'created_at datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('engineering_id');
        $this->forge->createTable('EngineeringManagement');
    }

    public function down()
    {
        $this->forge->dropTable('EngineeringManagement');
    }
}
