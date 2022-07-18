<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' =>[
                'type' => 'INT',
                'auto_increment' =>true
            ],
            'user_email' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '使用者帳號'
            ],
            'user_password' =>[
                'type' => 'VARCHAR',
                'constraint' => 255,
                'comment' => '使用者密碼'
            ],
            'permission_id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'comment' => '權限id'
            ],
            'created_at datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('user_id');
        $this->forge->createTable('User');
    }

    public function down()
    {
        $this->forge->dropTable('User');
    }
}
