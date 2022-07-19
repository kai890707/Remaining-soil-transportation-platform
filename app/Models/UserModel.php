<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = 'User';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'user_id',
        'user_email',
        'user_password',
        'permission_id',
        'created_at',
        'updated_date',
    ];

 
}