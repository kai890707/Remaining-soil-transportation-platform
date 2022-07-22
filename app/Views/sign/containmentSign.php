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
            <div class="row text-break text-center">
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
                <div class="col-6 border-end ">
                    <p>該聯單檔案</p>
                </div>
                <div class="col-6">
                    <p><button class="btn btn-outline-success"  onclick="location.href='<?php echo base_url('pdf/showPdf').'/'.$pdfInfo['pdf_id']?>'" >查看</button></p>
                </div>
            </div>
        </div>    
        <form id="containment_sign_form">
            <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow">
                <div class="mb-3">
                    <h3 class="text-center border-bottom p-2">資料填寫</h3>
                </div>
                <div class="mb-3">
                    <label for="shippingQuantity" class="form-label">剩餘土石載運數量<span class="text-danger">*請確實填寫單位(土方載運數量若採容積法請填立方公尺，若採重量法則填公噸。)</span></label>
                    <input type="text" class="form-control" id="shippingQuantity" name="shippingQuantity" required>
                </div>
                <div class="mb-3">
                    <label for="shippingContents" class="form-label">載運內容(土質)</label>
                    <input type="text" class="form-control" id="shippingContents" name="shippingContents" required>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="carFront">車頭照片</label>
                    <input type="file" class="form-control" id="carFront" multiple="multiple" accept="image/*" capture="camera" required>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="carBody">車斗照片</label>
                    <input type="file" class="form-control" id="carBody" multiple="multiple" accept="image/*" capture="camera" required>
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <a class="btn btn-success" href="#sign">前往簽名</a>
                </div>
            </div>
            <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
                <div class="row mb-4" style="height: 50vh; max-height:50vh" id="sign">
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
                            <button class="btn btn-danger " type="button" id="clear">清除簽名</button>
                            <button class="btn btn-primary" type="submit" id="convertToImage">送出</button>
                        </div>
                    </div>
                </div>
                <img src="" id="img1">
            </div>
        </form>
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
        // console.log("1",image.length);
       
        $("form[id='containment_sign_form']").submit(function(e) {
            e.preventDefault();
            // console.log(document.getElementById('carFront').files[0].size);
            var formData = new FormData(document.getElementById('containment_sign_form'));
            var signBase64;
            compress(image,2.5,function(base64){
                signBase64 = base64;
            });    
            formData.append('sign',signBase64);
            formData.append('pdf_id',<?php echo $pdf_id?>);
            Main(formData);
            // var reader = new FileReader();
            // reader.readAsDataURL(file);
        
            // reader.onload = function (e) { 
            //     res = e.target.result;
            //     // console.log(res);
            // }
              
            //  compress(reader.result,2.5,function(base64){
            //     // signBase64 = base64;
            //     console.log(base64.length);
            // });   
            // const base641 = fileToBase64(file,base64 => {
            //     // let imgs = document.getElementById('imgs')
            //     // imgs.src = base64
            //     // console.log(base64);
            //     compress(base64,2.5,function(base64After){
            //         console.log("2",base64After);
            //     });  
            // })
            // Swal.fire({
            //     title: '已確認簽名了嗎?',
            //     showDenyButton: true,
            //     confirmButtonText: '是! 已簽名',
            //     denyButtonText: `尚未簽名`,
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //         BaseLib.Post("/pdf/uploadSign",formData).then(
            //         (res)=>{
            //             // BaseLib.ResponseCheck(res).then(()=>{
            //                 // console.log(res);
            //                 // if(res.status =="success"){
            //                 //     window.location=BaseLib.base_Url+'/lobby';
            //                 // }
            //             // })
            //         },
            //         (err)=>{
            //             console.log(err);
            //         })
            //     } else if (result.isDenied) {
            //         Swal.fire('資料尚未更新', '', 'info')
            //     }
                
            // })
        
        })
    }, false);

    function compress(
            base64,        // 源图片
            rate,          // 缩放比例
            callback       // 回调
        ) {
            //处理缩放，转格式
            var _img = new Image();
            _img.src = base64;
            _img.onload = function() {
                var _canvas = document.createElement("canvas");
                var w = this.width / rate;
                var h = this.height / rate;
                _canvas.setAttribute("width", w);
                _canvas.setAttribute("height", h);
                _canvas.getContext("2d").drawImage(this, 0, 0, w, h);
                var base64 = _canvas.toDataURL("image/png");
                _canvas.toBlob(function(blob) {
                    if(blob.size > 750*1334){        //如果还大，继续压缩
                        compress(base64, rate, callback);
                    }else{
                        callback(base64);
                    }
                }, "image/png");
            }
        }

     

      

        /**
         * 圖片轉BASE64
         */
        const toBase64 = file => new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = error => reject(error);
        });

        async function Main(formData) {

            const carFront = document.querySelector('#carFront').files[0];
            const carBody = document.querySelector('#carBody').files[0];
            let carFrontBase=  await toBase64(carFront);
            let carBodyBase=  await toBase64(carBody);
            let uploadCarFront;
            let uploadCarBody;

            compress(carFrontBase,4,function(base64){
                uploadCarFront = base64;
            });  
            compress(carBodyBase,4,function(base64){
                uploadCarBody = base64
            });  

            formData.append('carFront',uploadCarFront);
            formData.append('carBody',uploadCarBody);

            for (var pair of formData.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }
            Swal.fire({
                title: '已確認簽名了嗎?',
                showDenyButton: true,
                confirmButtonText: '是! 已簽名',
                denyButtonText: `尚未簽名`,
            }).then((result) => {
                if (result.isConfirmed) {
                    BaseLib.Post("/pdf/uploadSign",formData).then(
                    (res)=>{
                        BaseLib.ResponseCheck(res).then(()=>{
                            console.log(res);
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
        }
        // function readFile(file) {
        //     var reader = new FileReader(),
        //         result = 'empty';

        //     reader.onload = function(e) {
        //         result = e.target.result;
        //     };

        //     reader.readAsDataURL(file);

        //     return result;
        // }
        //  function readFile() {
            // var file = document.getElementById('carFront').files[0];
            // var reader = new FileReader();
            // reader.readAsDataURL(file);
            // reader.onload = function (e) { 
            //     // txshow.src = this.result; alert(this.result); 
            //     // console.log(this.result);
            //     return this.result; 
            // }
            
        // }
        // const fileToBase64 = (file, callback) =>{
        //     const reader = new FileReader()
        //     reader.onload = function(evt){
        //         if(typeof callback === 'function') {
        //             callback(evt.target.result)
        //         } else {
        //             console.log("我是base64:", evt.target.result);
        //         }

        //     }
        //     /* readAsDataURL 方法会读取指定的 Blob 或 File 对象
        //     ** 读取操作完成的时候，会触发 onload 事件
        //     *  result 属性将包含一个data:URL格式的字符串（base64编码）以表示所读取文件的内容。
        //     */ 
        //     reader.readAsDataURL(file);
        // }
            
            // let _files = document.getElementById('carFront')
            // _files.addEventListener('change',function(e){
            //     console.log(e.target.files[0])
            //     let file = e.target.files[0] // file对象
            //     const base64 = fileToBase64(file,base64 => {
            //         // let imgs = document.getElementById('imgs')
            //         // imgs.src = base64
            //         console.log(base64);
            //     })
            // })


</script>
<?= $this->endSection() ?>