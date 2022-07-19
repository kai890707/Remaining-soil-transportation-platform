<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ContractingCompanyModel;
use App\Models\EngineeringManagementModel;
use App\Models\PdfDocumentModel;

class PdfController extends Controller
{
    protected $session;
    protected $contractingCompanyModel;
    protected $engineeringManagementModel;
    protected $pdfDocumentModel;
    public function __construct()
    {
        $this->db = db_connect();
        $this->session = \Config\Services::session();
        $this->contractingCompanyModel = new ContractingCompanyModel();
        $this->engineeringManagementModel = new EngineeringManagementModel();
        $this->pdfDocumentModel = new PdfDocumentModel();
    }


    public function index()
    {
        return view('pdf_view');
    }
    public function htmlToPDF()
    {
        try {
        // $path_to_image = "assets/images/pic1.jpg";
                $logo = "data:image/png;base64,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";
                $html = "<img src=".$logo." width='150px' height='100px'>";
                // echo $html;
                $dompdf = new \Dompdf\Dompdf();
                $dompdf->set_option('isRemoteEnabled', TRUE);
                $dompdf->loadHtml(view('pdf_view'));
                // $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'letter');
                $dompdf->render();
                $dompdf->stream('newfile',array('Attachment'=>0));
                // $dompdf->stream();

        } catch (\Exception $e) {
                print_r($e);
        }
    }

    public function insertEngineering()
    {
        $engineeringName = $this->request->getPostGet('engineering_name'); //工程名稱
        $engineerinNumber = $this->request->getPostGet('engineering_number'); //工程流向編號
        $engineeringdocumentNumber = $this->request->getPostGet('engineering_documentNumber');
        $documentEfficientDate = date('Y-m-d',strtotime('+10year'));
        $buildingName = $this->request->getPostGet('building_name');
        $buildingNumber = $this->request->getPostGet('building_number');
        $buildingAddress = $this->request->getPostGet('building_address');
        $starterName = $this->request->getPostGet('starter_name');
        $starterPhone = $this->request->getPostGet('starter_phone');
        $userid =  $this->session->get('user_id');
        $transportationRoute = $this->request->getPostGet('transportation_route');//運輸路線
        $contracting_id = $this->contractingCompanyModel->where('user_id',$userid)->first();
        if($contracting_id){
            $data=[
                'engineering_name' => $engineeringName,
                'engineering_projectNumber' => $engineerinNumber,
            ];
            $insertEngineeringData = $this->engineeringManagementModel->insert($data);

            if($insertEngineeringData){
                $fileNumber = date('Y').$engineerinNumber."TCP".$insertEngineeringData;
                $data=[
                    'pdf_fileNumber' => $fileNumber,
                    'pdf_effectiveDate' => $documentEfficientDate,
                    'pdf_buildingName' => $buildingName,
                    'pdf_constructtNumber' => $buildingNumber,
                    'pdf_buildingAddress' => $buildingAddress,
                    'pdf_starterName' => $starterName,
                    'pdf_starterPhone' => $starterPhone,
                    'pdf_transportationRoute' => $transportationRoute,
                ];
                $insertPdfData = $this->pdfDocumentModel->insert($data);
                if($insertPdfData){
                    $response=[
                        'status' => 'success',
                        'message' => '建立成功'
                    ];
                }else{
                    $response=[
                        'status' => 'fail',
                        'message' => '建立失敗'
                    ];
                }

            }else{
                $response=[
                    'status' => 'fail',
                    'message' => '建立失敗'
                ];
            }
        }else{
            $response=[
                'status' => 'fail',
                'message' => '建立失敗'
            ];
        }

        return $this->response->setJSON($response);
    }


    public function addEngineeringPdf()
    {

    }

}
