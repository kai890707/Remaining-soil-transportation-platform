<!-- 聯單使用 -->
<?= $this->extend('layout_blade/documentList_layout') ?>
<?= $this->section('customCss') ?>

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
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded block-btn" onclick="goToScan()">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <i class="bi bi-qr-code-scan" style="font-size: 2rem;"></i>
                </div>
                <div class="col-8">
                    <p class="h4 text-center">快速掃描</p>
                    <p class="h5 p-0 m-0 text-center">Quick Scan</p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded block-btn" onclick="openTypeModal()">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <i class="bi bi-search" style="font-size: 2rem;"></i>
                </div>
                <div class="col-8">
                    <p class="h4 text-center">手動查詢</p>
                    <p class="h5 p-0 m-0 text-center">Manual Query</p>
                </div>
            </div>

        </div>
        <div id="asd"></div>
        <video id="preview"></video>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>

<script type="text/javascript">
    function goToScan() {
        window.location.href = "<?php echo base_url('qrscan')?>"
    }
    function openTypeModal() {
        Swal.fire({
            title: '輸入聯單號碼',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: '搜尋',
            showLoaderOnConfirm: true,
            preConfirm: (document_id) => {
                let formData = new FormData();
                formData.append('pdf_fileNumber',document_id);
                BaseLib.Post("/pdf/selectDocument/",formData).then(
                (res)=>{
                    BaseLib.ResponseCheck(res).then(()=>{
                        if(res.status =="success"){
                            window.location=BaseLib.base_Url+"/pdf/validSign/"+res.p_id;
                        }
                    })
                },
                (err)=>{
                    console.log(err);
                })
            },
        })
    }
</script>
<?= $this->endSection() ?>