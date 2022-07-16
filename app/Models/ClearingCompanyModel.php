<?php
namespace App\Models;
use CodeIgniter\Model;

class ClearingCompanyModel extends Model{
    protected $table = 'clearingcompany';
    protected $primaryKey = 'clearingCompany_id';
    protected $allowedFields = [
        'clearingCompany_id ',
        'clearingCompany_name',
        'clearingCompany_uniformNumbers',
        'clearingCompany_principalName',
        'clearingCompany_identityCard',
        'clearingCompany_phone',
        'clearingCompany_address',
        'user_id',
        'permission_id',
        'created_at',
        'updated_date',
    ];
}