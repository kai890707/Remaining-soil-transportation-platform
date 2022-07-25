<?php
namespace App\Models;
use CodeIgniter\Model;

class GovernmentModel extends Model{
    protected $table = 'Government';
    protected $primaryKey = 'government_id';
    protected $allowedFields = [
        'government_id',
        'government_name',
        'government_principalName',
        'government_principalPhone',
        'government_address',
        'user_id',
        'permission_id',
        'created_at',
        'updated_date',
    ];


    public function getGovernmentData()
    {

        return $this->where('government_id',session()->get('government_id'))->first();
    }

}