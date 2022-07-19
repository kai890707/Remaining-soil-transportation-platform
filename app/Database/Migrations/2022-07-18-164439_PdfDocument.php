<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PdfDocument extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pdf_id' =>[
                'type' => 'INT',
                'auto_increment' =>true
            ],
            'pdf_fileNumber' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '文件序號'
            ],
            'pdf_effectiveDate' =>[
                'type' => 'DATE',
                'null' => true,
                'comment' => '文件有效日期'
            ],
            'pdf_buildingName' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '建物或拆除物名稱'
            ],

            'pdf_constructNumber' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '建造號碼'
            ],
            'pdf_buildingAddress' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '建築物地址'
            ],
            'pdf_starterName' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '起造人姓名'
            ],
            'pdf_starterPhone' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '起造人電話'
            ],
            'pdf_contractingCompanyId'=>[
                'type' =>'INT',
                'constraint'=>11,
                'comment' => '承造公司外來鍵'
            ],
            'pdf_clearingDriverId' =>[
                'type' => 'INT',
                'constraint' => 11,
                'comment' => '清運司機外來鍵'
            ],
            'pdf_clearingCompanyId' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '清運公司外來鍵'
            ],
            'pdf_transportationRoute' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '運輸路線'
            ],
            'pdf_shippingQuantity' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '土石載運數量'
            ],
            'pdf_shippingContents' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '載運內容'
            ],
            'pdf_containmentCompanyId' =>[
                'type' => 'INT',
                'constraint' => 11,
                'comment' => '收容單位外來鍵'
            ],
            'pdf_containmentPlaceEearthFlowNumer'=>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '收容場所土石流向管制編號'
            ],
            'pdf_certifiedDocumentsIssuingUnit'=>[
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => '證明文件核發單位'
            ],
            'pdf_contractingSign'=>[
                'type' => 'VARCHAR',
                'constraint' => 255,
                'comment' => '承造公司簽名圖片位置'
            ],
            'pdf_driverSign'=>[
                'type' => 'VARCHAR',
                'constraint' => 255,
                'comment' => '駕駛簽名圖片位置'
            ],
            'pdf_containmentPlaceSign'=>[
                'type' => 'VARCHAR',
                'constraint' => 255,
                'comment' => '收容場所圖片位置'
            ],
            'pdf_contractingSignDate'=>[
                'type' => 'DATETIME',
                'null' => true,
                'comment' => '承造簽名日期'
            ],
            'pdf_driverSignDate'=>[
                'type' => 'DATETIME',
                'null' => true,
                'comment' => '駕駛簽名日期'
            ],
            'pdf_containmentPlaceSignDate'=>[
                'type' => 'DATETIME',
                'null' => true,
                'comment' => '收容場所簽名日期'
            ],
            'engineering_id'=>[
                'type' =>'INT',
                'constraint'=>11,
                'comment' => '工程管理外來鍵'
            ],

            'created_at datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('pdf_id');
        $this->forge->createTable('PdfDocument');
    }

    public function down()
    {
        $this->forge->dropTable('PdfDocument');
    }
}
