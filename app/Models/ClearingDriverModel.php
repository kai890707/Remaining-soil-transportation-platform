<?php
namespace App\Models;
use CodeIgniter\Model;

class ClearingDriverModel extends Model{
    protected $table = 'clearingdriver';
    protected $primaryKey = 'clearingDriver_id';
    protected $allowedFields = [
        'clearingDriver_id',
        'clearingDriver_name',
        'clearingDriver_identityCard',
        'clearingDriver_licensePlate',
        'clearingDriver_phone',
        'clearingDriver_bloodType',
        'clearingCompany_id',
        'user_id',
        'permission_id',
        'created_at',
        'updated_date',
    ];
}