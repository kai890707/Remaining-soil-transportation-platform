<!-- <!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR code scan</title>
    <script type="text/javascript" src="<?php echo base_url('assets/js/instascan.min.js') ?>"></script>
     <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>

</head>

<body>

    <div id="qr-reader" style="width:500px"></div>
    <div id="qr-reader-results"></div>
   
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                // alert(`Scan result ${decodedText}`, decodedResult);
                location.href=decodedText;

            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 },{ facingMode: "environment" });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>

</html> -->

<!-- 聯單頁面 -->
<?= $this->extend('layout_blade/projectList_layout') ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">聯單 QR Code 掃描</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Document QR Code Scanner</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-3 m-1  mx-auto ">
            <h3 class="text-danger text-center">提醒!</h3>
            <p class="text-center">手機用戶掃描前請先點擊掃描框中的 (<span class="text-info fw-bold">Request Camera Permissions</span>) 以開啟手機相機權限</p>
            <div id="qr-reader" style="max-width:400px" class="mx-auto"></div>
            <div id="qr-reader-results"></div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>
    <script type="text/javascript" src="<?php echo base_url('assets/js/html5Qrscan.js'); ?>"></script>
    <script>
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                location.href=decodedText;
                // Swal.fire({
                //     title: '掃描成功! 按下確定為您導向頁面',
                //     showDenyButton: true,
                //     confirmButtonText: '確定',
                // }).then((result) => {
                //     if (result.isConfirmed) {
                //         location.href=decodedText;
                //         html5QrcodeScanner.clear();
                //     }
                    
                // })

            }
        }
        function onScanError(errorMessage) {
           Swal.fire(
                '錯誤!',
                '請重新掃描!',
                'info'
            )
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    </script>
<?= $this->endSection() ?>