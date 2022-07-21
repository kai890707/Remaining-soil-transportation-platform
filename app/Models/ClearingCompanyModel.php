<?php
namespace App\Models;
use CodeIgniter\Model;

class ClearingCompanyModel extends Model{
    protected $table = 'ClearingCompany';
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

    public function getCompanyName()
    {
       return $this->select('clearingCompany_id,clearingCompany_name')->find();
    }

    public function getCompanyData()
    {

        return $this->where('clearingCompany_id',session()->get('clearingCompany_id'))->first();
    }

    public function getDataJoinPdf($company_id)
    {
        return $this->select('ClearingCompany.*')
                    ->join('PdfDocument','PdfDocument.pdf_clearingCompanyId = ClearingCompany.clearingCompany_id')
                    ->where('ClearingCompany.clearingCompany_id',$company_id)
                    ->first();
    }
}