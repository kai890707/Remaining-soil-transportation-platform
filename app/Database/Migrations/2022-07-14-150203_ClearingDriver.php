<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClearingDriver extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'clearingDriver_id' =>[
                'type' => 'INT',
                'auto_increment' =>true
            ],
            'clearingDriver_name' =>[
                'type' => 'VARCHAR',
                'constraint' => 30,
                'comment' => '駕駛姓名'
            ],
            'clearingDriver_identityCard' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '駕駛身分證號碼'
            ],
            'clearingDriver_licensePlate' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '清運司機車牌'
            ],
            'clearingDriver_phone' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '清運司機連絡電話'
            ],

            'clearingDriver_bloodType' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '清運司機血型'
            ],

            'clearingCompany_id' =>[
                'type' => 'INT',
                'constraint' => 10,
                'comment' => '清運公司外來鍵'
            ],

            'created_at datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addForeignKey('clearingCompany_id','ClearingCompany','clearingCompany_id');
        $this->forge->addPrimaryKey('clearingDriver_id');
        $this->forge->createTable('ClearingDriver');
    }

    public function down()
    {
        $this->forge->dropTable('ClearingDriver');
    }
}
