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
                    <p class="h5 p-0 m-0 text-center">XXXX</p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row text-break">
                <div class="col-6 border-end ">
                    <p>文件序號</p>
                </div>
                <div class="col-6">
                    <p>12345646</p>
                </div>
                <div class="col-6 border-end ">
                    <p>建築物或拆除物名</p>
                </div>
                <div class="col-6">
                    <p>16843518513136545416846511861518416518151816</p>
                </div>
                <div class="col-6 border-end ">
                    <p>建(拆)造號碼</p>
                </div>
                <div class="col-6">
                    <p>186151616163</p>
                </div>
                <div class="col-6 border-end ">
                    <p>建築物地點</p>
                </div>
                <div class="col-6">
                    <p>1861516516</p>
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
                        <button class="btn btn-primary" type="button" id="convertToImage">下一步</button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="openMedia()">
                Launch static backdrop modal
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">拍攝車頭及車斗</h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <p class="text-danger ">*若需重新拍攝照片，請再點擊一次下方拍攝按鈕</p>
                                    <video id="video" class="w-100" autoplay="autoplay"></video>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-primary " type="button" onclick="takePhoto(1)">拍攝車頭</button>
                                        <button class="btn btn-primary" type="button" onclick="takePhoto(2)">拍攝車尾</button>
                                        <canvas id="canvas1" width="500px" height="500px" style="display: none;"></canvas>
                                        <canvas id="canvas2" width="500px" height="500px" style="display: none;"></canvas>
                                    </div>
                                </div>
                                <div class="col-12 ">
                                    <h4 id="img1Illustrate" style="display: none;">車頭照片</h4>
                                    <img id="imgTag1" src="" alt="車頭照片" class="img-fluid mb-2" style="display: none;">
                                    <h4 id="img2Illustrate" style="display: none;">車尾照片</h4>
                                    <img id="imgTag2" src="" alt="車斗照片" class="img-fluid mb-2" style="display: none;">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button> -->
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">拍攝完成並儲存</button>
                        </div>
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
    var signStore = new Map(); //簽章圖片
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
        // console.log("convertToImage")
        var image = canvas.toDataURL("image/png");
        //base 64
        signStoreFn(image);
        console.log(signStore);
        // canvas.setAttribute('disable',true);
    
        // $('#image').html("<img src='" + image + "' alt='from canvas'/>");
    }, false);


    /***** */

    let mediaStreamTrack = null; // 视频对象(全局)
    let video;
    let imagesArray = new Map();

    function openMedia() {
        let constraints = {
            video: {
                width: 500,
                height: 500
            },
            audio: false
        };
        //取得攝影機
        video = document.getElementById('video');
        let promise = navigator.mediaDevices.getUserMedia(constraints);
        promise.then((mediaStream) => {
            // mediaStreamTrack = typeof mediaStream.stop === 'function' ? mediaStream : mediaStream.getTracks()[1];
            mediaStreamTrack = mediaStream.getVideoTracks()
            video.srcObject = mediaStream;
            video.play();
        });
    }

    function pushImg(id, base64Img) {
        if (imagesArray.keys(id)) {
            imagesArray.delete(id)
            imagesArray.set(id, base64Img);
        } else {
            imagesArray.set(id, base64Img);
        }
    }

    // 拍照
    function takePhoto(id) {


        //取得canvas實體
        let video = document.getElementById('video');
        let canvas = document.getElementById('canvas' + id);
        let ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, 500, 500);


        // toDataURL 
        let img = document.getElementById('canvas' + id).toDataURL();
        // 这里的img就是得到的图片
        console.log('img-----', img);
        document.getElementById('imgTag' + id).src = img;
        document.getElementById('imgTag' + id).style.display = "";
        document.getElementById('img' + id + 'Illustrate').style.display = "";

        //圖片存到map
        pushImg(id, img)
        console.log(imagesArray.size);
        //上传
        /*$.ajax({
            url: "/xxxx.do",
            type: "POST",
            data: {"imgData": img},
            success: function (data) {
                console.log(data);
                document.gauges.forEach(function (gauge) {
                    gauge.value = data.data
                });
            },
            error: function () {
                console.log("服务端异常！");
            }
        });*/
    }
    // 關閉相機
    function closeMedia() {
        let stream = document.getElementById('video').srcObject;
        let tracks = stream.getTracks();

        tracks.forEach(function(track) {
            track.stop();
        });
        document.getElementById('video').srcObject = null;
    }
</script>
<?= $this->endSection() ?>