<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClearingCompany extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'clearingCompany_id' =>[
                'type' => 'INT',
                'auto_increment' =>true
            ],
            'clearingCompany_name' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '清運公司名稱'
            ],
            'clearingCompany_uniformNumbers' =>[
                'type' => 'VARCHAR',
                'constraint' => 30,
                'comment' => '清運公司統編'
            ],
            'clearingCompany_principalName' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '負責人姓名'
            ],
            'clearingCompany_identityCard' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '身分證號碼'
            ],

            'clearingCompany_phone' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '清運公司電話'
            ],

            'clearingCompany_address' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '清運公司地址'
            ],

            'created_at datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('clearingCompany_id');
        $this->forge->createTable('ClearingCompany');

    }

    public function down()
    {
        $this->forge->dropTable('ClearingCompany');
    }
}
