<?php
namespace App\Models;
use CodeIgniter\Model;

class ClearingDriverModel extends Model{
    protected $table = 'ClearingDriver';
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
    
    public function getDriverData()
    {

        return $this->where('clearingDriver_id',session()
                    ->get('clearingDriver_id'))
                    ->join('ClearingCompany','ClearingCompany.clearingCompany_id = ClearingDriver.clearingCompany_id')
                    ->first();
   
    }

    public function getDataJoinPdf($driver_id)
    {
        return $this->select('ClearingDriver.*')
                    ->join('PdfDocument','PdfDocument.pdf_clearingDriverId = ClearingDriver.clearingDriver_id')
                    ->where('ClearingDriver.clearingDriver_id',$driver_id)
                    ->first();
    }
}