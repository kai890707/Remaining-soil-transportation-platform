<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContractingCompany extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'contracting_id' =>[
                'type' => 'INT',
                'auto_increment' =>true
            ],
            'contracting_companyName' =>[
                'type' => 'VARCHAR',
                'constraint' => 30,
                'comment' => '承造公司名稱'
            ],
            'contracting_uniformNumbers' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '承造公司統編'
            ],
            'contracting_contractUserName' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '承造人姓名'
            ],

            'contracting_contractUserPhone' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '承造人電話'
            ],

            'contracting_contractWatcherName' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '監造人姓名'
            ],

            'contracting_contractWatcherPhone' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '監造人電話'
            ],

            'contracting_companyAddress' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '承造公司地址'
            ],

            'created_at datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp',
        ]);


        $this->forge->addPrimaryKey('contracting_id');
        $this->forge->createTable('ContractingCompany');

    }

    public function down()
    {
        $this->forge->dropTable('ContractingCompany');
    }
}
