<?php namespace App\Database\Seeds;

class PermissionSeed extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        //使用者權限分類
        $data = [
            [
                'permission_id'   => "1" ,
                'permission_name' => "root"
            ],
            [
                'permission_id'   => "2" ,
                'permission_name' => "承造廠商(公司)"
            ],
            [
                'permission_id'   => "3" ,
                'permission_name' => "清運廠商(公司)"
            ],
            [
                'permission_id'   => "4" ,
                'permission_name' => "清運司機"
            ],
            [
                'permission_id'   => "5" ,
                'permission_name' => "收容場所"
            ],
            [
                'permission_id'   => "6" ,
                'permission_name' => "政府單位"
            ]

        ];
        $builder = $this->db->table('Permission')->insertBatch($data);

        //超級帳號
        $root = [
            'user_email'=>'root@root.xyz',
            'user_password'=>sha1('root2022'),
            'permission_id' => '1'
        ];
        $builder2 = $this->db->table('User')->insert($root);


        //文件狀態

        $pdfStatus = [
            [
             "status_id"=>"1",
             "status_remark"=>"創建完成"   
            ],
            [
             "status_id"=>"2",
             "status_remark"=>"承造簽名完成"   
            ],[
             "status_id"=>"3",
             "status_remark"=>"司機簽名完成"   
            ],[
             "status_id"=>"4",
             "status_remark"=>"收容簽名完成"   
            ],[
             "status_id"=>"5",
             "status_remark"=>"簽名完畢"   
            ],
        ];
        $builder3 = $this->db->table('PdfStatus')->insertBatch($pdfStatus);
    }
}