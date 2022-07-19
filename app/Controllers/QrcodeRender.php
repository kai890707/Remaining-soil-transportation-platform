<?php

namespace App\Controllers;

use App\Controllers\BaseController;

// use vendor\chillerlan\QRCode\QRCode;
// use vendor\chillerlan\QRCode\QROptions;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use TCPDF;
class QrcodeRender extends BaseController
{


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

        header('Content-type: image/png');

        return (new QRCode($options))->render($data);
        // return '<img src="' . (new QRCode())->render($data) . '" alt="QR Code" />';
        // var_dump((new QRCode())->render($data));
    }

    public function pdf()
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 002');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        /*if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
}*/

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('msungstdlight', '', 20);

        // add a page
        $pdf->AddPage();

        // set some text to print
        $txt = <<<EOD
TCPDF Example 002

Default page header and footer are disabled using setPrintHeader() and setPrintFooter() methods.
我踏月色而來。
EOD;

        // print a block of text using Write()
        $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

        // ---------------------------------------------------------
 $this->response->setHeader("Content-Type", "application/pdf");

        //Close and output PDF document
        $pdf->Output('test1020.pdf', 'I');

    }



}
