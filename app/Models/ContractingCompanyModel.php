<?php
namespace App\Models;
use CodeIgniter\Model;

class ContractingCompanyModel extends Model{
    protected $table = 'ContractingCompany';
    protected $primaryKey = 'contracting_id';
    protected $allowedFields = [
        'contracting_id',
        'contracting_companyName',
        'contracting_uniformNumbers',
        'contracting_contractUserName',
        'contracting_contractUserPhone',
        'contracting_contractWatcherName',
        'contracting_contractWatcherPhone',
        'contracting_companyAddress',
        'user_id',
        'permission_id',
        'created_at',
        'updated_date',
    ];
}