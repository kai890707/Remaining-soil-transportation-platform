<!DOCTYPE html>
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
    <video id="preview"></video>

    <script type="text/javascript">
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        scanner.addListener('scan', function(content) {
            //網址
            alert(content);
        });
        Instascan.Camera.getCameras().then(function(cameras) {

            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('相機無法正常開啟，請使用手動輸入');
            }
        }).catch(function(e) {
            console.error(e);
        });
    </script>
</body>

</html>