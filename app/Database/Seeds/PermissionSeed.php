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
                'permission_name' => "contractingCompany"
            ],
            [
                'permission_id'   => "3" , 
                'permission_name' => "clearingCompany"
            ],
            [
                'permission_id'   => "4" , 
                'permission_name' => "clearingDriver"
            ],
            [
                'permission_id'   => "5" , 
                'permission_name' => "containmentCompany"
            ],
            [
                'permission_id'   => "6" , 
                'permission_name' => "government"
            ]
            
        ];

        $builder = $this->db->table('Permission')->insertBatch($data);
    }
}