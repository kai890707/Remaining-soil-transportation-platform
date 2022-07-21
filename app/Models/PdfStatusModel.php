<?php
namespace App\Models;
use CodeIgniter\Model;

class PdfStatusModel extends Model{
    protected $table = 'PdfStatus';
    protected $primaryKey = 'status_id';
    protected $allowedFields = [
        'status_id',
        'status_remark',
        'created_at',
        'updated_date',
    ];


}