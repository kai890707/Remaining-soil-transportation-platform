<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContainmentCompany extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'containmentCompany_id' =>[
                'type' => 'INT',
                'auto_increment' =>true
            ],
            'containmentCompany_uniformNumbers' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '收容公司統編'
            ],
            'containmentCompany_name' =>[
                'type' => 'VARCHAR',
                'constraint' => 30,
                'comment' => '收容公司名稱'
            ],
            'containmentCompany_principalName' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '負責人姓名'
            ],
            'containmentCompany_principalPhone' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '負責人電話'
            ],
            'containmentCompany_placeAddress' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '收容公司場所地址'
            ],
            'containmentCompany_address' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '收容公司地址'
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

        $this->forge->addPrimaryKey('containmentCompany_id');
        $this->forge->createTable('ContainmentCompany');
    }

    public function down()
    {
        $this->forge->dropTable('ContainmentCompany');
    }
}
