<?php
namespace App\Models;
use CodeIgniter\Model;

class EngineeringManagementModel extends Model{
    protected $table = 'EngineeringManagement';
    protected $primaryKey = 'engineering_id';
    protected $allowedFields = [
        'engineering_id',
        'engineering_name',
        'engineering_projectNumber',
        'contractCompany_id',
        'created_at',
        'updated_date',
    ];

    public function getDataJoinPdf($engineering_id)
    {
        return $this->select('EngineeringManagement.*')
                    ->join('PdfDocument','PdfDocument.engineering_id = EngineeringManagement.engineering_id')
                    ->where('EngineeringManagement.engineering_id',$engineering_id)
                    ->first();
    }
}