<?php namespace App\Database\Seeds;

class PermissionSeed extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
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
        $root = [
            'user_email'=>'root@root.xyz',
            'user_password'=>sha1('root2022'),
            'permission_id' => '1'
        ];

      
        $builder2 = $this->db->table('User')->insert($root);
    }
}