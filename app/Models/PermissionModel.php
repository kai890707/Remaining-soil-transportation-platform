<?php
namespace App\Models;
use CodeIgniter\Model;

class PermissionModel extends Model{
    protected $table = 'Permission';
    protected $primaryKey = 'permission_id';
    protected $allowedFields = [
        'permission_id',
        'permission_name',
        'created_at',
        'updated_date',
    ];
}