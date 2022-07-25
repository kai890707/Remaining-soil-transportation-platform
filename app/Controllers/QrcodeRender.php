<?php

namespace App\Controllers;

use App\Controllers\BaseController;

// use vendor\chillerlan\QRCode\QRCode;
// use vendor\chillerlan\QRCode\QROptions;
use App\Models\PdfDocumentModel;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

use TCPDF;
class QrcodeRender extends BaseController
{
    protected $pdfDocumentModel;
    public function __construct()
    {
        $this->pdfDocumentModel = new PdfDocumentModel();
    }

    public function index()
    {

        $data = 'https://www.youtube.com/watch?v=DLzxrzFCyOs&t=43s';

        $options = new QROptions([
            'version'      => 10,
            'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel'     => QRCode::ECC_H,
            'scale'        => 5,
            'imageBase64'  => false,
            'moduleValues' => [
                // finder
                1536 => [0, 63, 255], // dark (true)
                6    => [255, 255, 255], // light (false), white is the transparency color and is enabled by default
                5632 => [241, 28, 163], // finder dot, dark (true)
                // alignment
                2560 => [255, 0, 255],
                10   => [255, 255, 255],
                // timing
                3072 => [255, 0, 0],
                12   => [255, 255, 255],
                // format
                3584 => [67, 99, 84],
                14   => [255, 255, 255],
                // version
                4096 => [62, 174, 190],
                16   => [255, 255, 255],
                // data
                1024 => [0, 0, 0],
                4    => [255, 255, 255],
                // darkmodule
                512  => [0, 0, 0],
                // separator
                8    => [255, 255, 255],
                // quietzone
                18   => [255, 255, 255],
                // logo (requires a call to QRMatrix::setLogoSpace())
                20    => [255, 255, 255],
            ],
        ]);

        // header('Content-type: image/png');

        // return (new QRCode($options))->render($data);
        // return '<img src="' . (new QRCode())->render($data) . '" alt="QR Code" />';

        $qrcode = new QRCode($options);
        $file = $qrcode->render($data);
        $fileName = uniqid();
        // $_SERVER['DOCUMENT_ROOT'] 指到專案目錄底下的public
        //php不接受由http或https來源的存取，故需指到專案絕對路徑
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/assets/qrcode/'.$fileName.'.png',$file);
        echo '<img src="'.base_url("/assets/qrcode/".$fileName.".png").'" alt="QR Code" />';
    }



    public function baseTest()
    {
        $q = "data:image/png;base64,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";

        $fileName = uniqid();
        // $_SERVER['DOCUMENT_ROOT'] 指到專案目錄底下的public
        //php不接受由http或https來源的存取，故需指到專案絕對路徑

        file_put_contents(
            $_SERVER['DOCUMENT_ROOT'].'/assets/qrcode/'.$fileName.'.png',
            base64_decode(
                str_replace('data:image/png;base64,', '', $q)
            )
        );

        echo '<img src="'.base_url("/assets/qrcode/".$fileName.".png").'" alt="QR Code" />';
    }

     /**
     * 確認PDF是否被權限簽名
     * 是=>true
     * 否=>false
     *
     * @return bool
     */
    public function checkPermissionSign($pdf_id){
        $permission_id = session()->get('permission_id');

        $doc =  $this->pdfDocumentModel
                     ->where('pdf_id',$pdf_id)
                     ->first();
        if($permission_id == $this::$permissionIdByClearingDriver){
            return FALSE;
        }
        // switch ($permission_id) {
        //     case $this::$permissionIdByContractingCompany:
        //         $contractIsSign = $doc['pdf_contractingSign'];
        //         if(!empty($contractIsSign)){
        //             return TRUE;
        //         }else{
        //             return FALSE;
        //         }
        //         break;
        //     case $this::$permissionIdByClearingDriver:
        //         $driverIsSign = $doc['pdf_driverSign'];
        //         if(!empty($driverIsSign)){
        //             return TRUE;
        //         }else{
        //             return FALSE;
        //         }
        //         break;
        //     case $this::$permissionIdByContainmentCompany:
        //         $containmentIsSign = $doc['pdf_containmentPlaceSign'];
        //         if(!empty($containmentIsSign)){
        //             return TRUE;
        //         }else{
        //             return FALSE;
        //         }
        //         break;
        //     case $this::$permissionIdByClearingCompany:
        //         return TRUE;
        //         break;
        //     case $this::$permissionIdByGovernment:
        //         return TRUE;
        //         break;
        //     default:
        //         return TRUE;
        //         break;
        // }

    }
    /**
     * PDF QRCODE
     * 產生PDF QRCODE
     * 
     * @param [INT] $pdf_id
     * @return string
     */
    public function generateQrcode($pdf_id)
    {
        
        
        $url = base_url('pdf/validSign'.'/'.$pdf_id);
        
        
        $options = new QROptions([
            'version'      => 10,
            'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel'     => QRCode::ECC_H,
            'scale'        => 5,
            'imageBase64'  => false,
            'moduleValues' => [
                // finder
                1536 => [0, 63, 255], // dark (true)
                6    => [255, 255, 255], // light (false), white is the transparency color and is enabled by default
                5632 => [241, 28, 163], // finder dot, dark (true)
                // alignment
                2560 => [255, 0, 255],
                10   => [255, 255, 255],
                // timing
                3072 => [255, 0, 0],
                12   => [255, 255, 255],
                // format
                3584 => [67, 99, 84],
                14   => [255, 255, 255],
                // version
                4096 => [62, 174, 190],
                16   => [255, 255, 255],
                // data
                1024 => [0, 0, 0],
                4    => [255, 255, 255],
                // darkmodule
                512  => [0, 0, 0],
                // separator
                8    => [255, 255, 255],
                // quietzone
                18   => [255, 255, 255],
                // logo (requires a call to QRMatrix::setLogoSpace())
                20    => [255, 255, 255],
            ],
        ]);

        return '<img class="img-fluid" style="max-width: 100%;height: auto;" src="' . (new QRCode())->render($url) . '" alt="QR Code"  />';
    }

}
