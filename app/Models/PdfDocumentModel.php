<?php
namespace App\Models;
use CodeIgniter\Model;

class PdfDocumentModel extends Model{
    protected $table = 'PdfDocument';
    protected $primaryKey = 'pdf_id';
    protected $allowedFields = [
        'pdf_id',
        'pdf_fileNumber',
        'pdf_effectiveDate',
        'pdf_buildingName',
        'pdf_constructtNumber',
        'pdf_buildingAddress',
        'pdf_starterName',
        'pdf_starterPhone',
        'pdf_contractingCompanyId',
        'pdf_clearingDriverId',
        'pdf_clearingCompanyId',
        'pdf_transportationRoute',
        'pdf_shippingQuantity',
        'pdf_shippingContents',
        'pdf_containmentCompanyId',
        'pdf_containmentPlaceEearthFlowNumer',
        'pdf_certifiedDocumentsIssuingUnit',
        'pdf_contractingSign',
        'pdf_driverSign',
        'pdf_containmentPlaceSign',
        'pdf_contractingSignDate',
        'pdf_driverSignDate',
        'pdf_containmentPlaceSignDate',
        'status_id',
        'engineering_id',
        'created_at',
        'updated_date',
    ];
}