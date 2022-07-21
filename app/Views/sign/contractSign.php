<!-- 聯單使用 -->
<?= $this->extend('layout_blade/sign_layout') ?>
<?= $this->section('customCss') ?>
<style>
    canvas {
        background: #eee;
        width: 70%;
        height: 80%;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">聯單使用</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">The Single Use</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <i class="bi bi-person" style="font-size: 2rem;"></i>
                </div>
                <div class="col-8">
                    <p class="h4 text-center">人員身分</p>
                    <p class="h5 p-0 m-0 text-center"><?= esc($permissionName)?></p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row text-break">
                <div class="col-6 border-end ">
                    <p>文件序號</p>
                </div>
                <div class="col-6">
                    <p><?php echo $pdfInfo['pdf_fileNumber']?></p>
                </div>
                <div class="col-6 border-end ">
                    <p>建築物或拆除物名</p>
                </div>
                <div class="col-6">
                    <p><?php echo $pdfInfo['pdf_buildingName']?></p>
                </div>
                <div class="col-6 border-end ">
                    <p>建(拆)造號碼</p>
                </div>
                <div class="col-6">
                    <p><?php echo $pdfInfo['pdf_constructNumber']?></p>
                </div>
                <div class="col-6 border-end ">
                    <p>建築物地點</p>
                </div>
                <div class="col-6">
                    <p><?php echo $pdfInfo['pdf_buildingAddress']?></p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row mb-4" style="height: 50vh; max-height:50vh">
                <div class="col-12 h-25 w-100">
                    <h3 class="text-center border-bottom p-2">簽名處</h3>
                </div>
                <div class="col-12 h-50 w-100 p-2">
                    <div class="row p-0 m-0 mb-2 h-100 w-100 mx-auto">
                        <canvas id="mycanvas" class="h-100 w-100" ></canvas>
                    </div>

                    <!-- <div id="image"></div> -->
                </div>
                <div class="row p-0 m-0 h-25 w-100">
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary " type="button" id="clear">清除</button>
                        <button class="btn btn-primary" type="button" id="convertToImage">完成</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script type="text/javascript">
    // init canvas element
    var canvas = document.getElementById('mycanvas');
    var ctx = canvas.getContext("2d");
    var writeStatus = 0; //簽章狀態鎖
    let width = canvas.width,
        height = canvas.height;
    if (window.devicePixelRatio) {
        canvas.style.width = width + "px";
        canvas.style.height = height + "px";
        canvas.height = height * window.devicePixelRatio;
        canvas.width = width * window.devicePixelRatio;
        ctx.scale(window.devicePixelRatio, window.devicePixelRatio);
    }


    // mouse
    function getMousePos(canvas, evt) {
        var rect = canvas.getBoundingClientRect();
        return {
            x: evt.clientX - rect.left,
            y: evt.clientY - rect.top
        };
    }

    function mouseMove(evt) {
        var mousePos = getMousePos(canvas, evt);
        ctx.lineCap = "round";
        ctx.lineWidth = 2;
        ctx.lineJoin = "round";
        ctx.shadowBlur = 1; // 邊緣模糊，防止直線邊緣出現鋸齒 
        ctx.shadowColor = 'black'; // 邊緣顏色
        ctx.lineTo(mousePos.x, mousePos.y);
        ctx.stroke();
    }

    canvas.addEventListener('mousedown', function(evt) {
        var mousePos = getMousePos(canvas, evt);
        ctx.beginPath();
        ctx.moveTo(mousePos.x, mousePos.y);
        evt.preventDefault();
        canvas.addEventListener('mousemove', mouseMove, false);
    });

    canvas.addEventListener('mouseup', function() {
        canvas.removeEventListener('mousemove', mouseMove, false);
    }, false);


    // touch
    function getTouchPos(canvas, evt) {
        var rect = canvas.getBoundingClientRect();
        return {
            x: evt.touches[0].clientX - rect.left,
            y: evt.touches[0].clientY - rect.top
        };
    }

    function touchMove(evt) {
        // console.log("touchmove")
        var touchPos = getTouchPos(canvas, evt);
        // console.log(touchPos.x, touchPos.y)

        ctx.lineWidth = 2;
        ctx.lineCap = "round"; // 繪制圓形的結束線帽
        ctx.lineJoin = "round"; // 兩條線條交匯時，建立圓形邊角
        ctx.shadowBlur = 1; // 邊緣模糊，防止直線邊緣出現鋸齒 
        ctx.shadowColor = 'black'; // 邊緣顏色
        ctx.lineTo(touchPos.x, touchPos.y);
        ctx.stroke();
    }

    function signStoreFn(sign) {
        if (signStore.size > 1) {
            signStore.delete('sign');
            signStore.set('sign', sign);
        } else {
            signStore.set('sign', sign);
        }
    }
    canvas.addEventListener('touchstart', function(evt) {
        // console.log('touchstart')
        // console.log(evt)
        //使用狀態鎖 鎖定
        if(writeStatus == 0){
            var touchPos = getTouchPos(canvas, evt);
            ctx.beginPath(touchPos.x, touchPos.y);
            ctx.moveTo(touchPos.x, touchPos.y);
            evt.preventDefault();
            canvas.addEventListener('touchmove', touchMove, false);
        }
       
    });

    canvas.addEventListener('touchend', function() {
        // console.log("touchend")
        if(writeStatus == 0 ){
            canvas.removeEventListener('touchmove', touchMove, false);
        }
        
    }, false);


    // clear
    document.getElementById('clear').addEventListener('click', function() {
        // console.log("reset")
        writeStatus = 0;
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }, false);


    // convertToImage
    document.getElementById('convertToImage').addEventListener('click', function() {
        writeStatus = 1;
        var image = canvas.toDataURL("image/png");
        //base 64

        console.log(image);
        
        let signData = new FormData();
        signData.append('sign',image);
        signData.append('pdf_id',<?php echo $pdf_id?>);

        Swal.fire({
            title: '已確認簽名了嗎?',
            showDenyButton: true,
            confirmButtonText: '是! 已簽名',
            denyButtonText: `尚未簽名`,
        }).then((result) => {
            if (result.isConfirmed) {
                BaseLib.Post("/pdf/uploadSign",signData).then(
                (res)=>{
                    BaseLib.ResponseCheck(res).then(()=>{
                        if(res.status =="success"){
                            window.location=BaseLib.base_Url+'/lobby';
                        }
                    })
                },
                (err)=>{
                    console.log(err);
                })
            } else if (result.isDenied) {
                Swal.fire('資料尚未更新', '', 'info')
            }
            
        })

    }, false);



</script>
<?= $this->endSection() ?>