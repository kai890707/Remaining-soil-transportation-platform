<?php
namespace App\Models;
use CodeIgniter\Model;

class ContainmentCompanyModel extends Model{
    protected $table = 'containmentcompany';
    protected $primaryKey = 'containmentCompany_id';
    protected $allowedFields = [
        'containmentCompany_id',
        'containmentCompany_uniformNumbers',
        'containmentCompany_name',
        'containmentCompany_principalName',
        'containmentCompany_principalPhone',
        'containmentCompany_placeAddress',
        'containmentCompany_address',
        'user_id',
        'permission_id',
        'created_at',
        'updated_date',
    ];
}