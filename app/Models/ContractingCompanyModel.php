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
    public function getCompanyData()
    {

        return $this->where('contracting_id',session()->get('contracting_id'))->first();
    }

    public function getDataJoinPdf($contracting_id)
    {
        return $this->select('ContractingCompany.*')
                    ->join('PdfDocument','PdfDocument.pdf_contractingCompanyId = ContractingCompany.contracting_id')
                    ->where('ContractingCompany.contracting_id',$contracting_id)
                    ->first();
    }
}