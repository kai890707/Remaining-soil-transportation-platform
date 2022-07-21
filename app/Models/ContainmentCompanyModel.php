<?php
namespace App\Models;
use CodeIgniter\Model;

class ContainmentCompanyModel extends Model{
    protected $table = 'ContainmentCompany';
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
    public function getCompanyData()
    {

        return $this->where('containmentCompany_id',session()->get('containmentCompany_id'))->first();
    }

    public function getDataJoinPdf($containment_id)
    {
        return $this->select('ContainmentCompany.*')
                    ->join('PdfDocument','PdfDocument.pdf_containmentCompanyId = ContainmentCompany.containmentCompany_id')
                    ->where('ContainmentCompany.containmentCompany_id',$containment_id)
                    ->first();
    }
}