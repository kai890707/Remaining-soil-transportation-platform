<!-- 各使用狀態聯單 -->
<?= $this->extend('layout_blade/documentList_layout') ?>
<?= $this->section('customCss') ?>

<?= $this->endSection() ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">聯單 QRCODE</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Document QRCODE</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
       
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <button class="btn btn-primary"onclick="history.back()">回上頁</button>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 fs-6">工程流向編號</p>
                </div>
                <div class="col-8 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 fs-6"><?php echo $projectInfo['engineering_projectNumber']?></p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 fs-6">工程名稱</p>
                </div>
                <div class="col-8 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 fs-6"><?php echo $projectInfo['engineering_name']?></p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 fs-6">文件編號</p>
                </div>
                <div class="col-8 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 fs-6"><?php echo $projectInfo['pdf_fileNumber']?></p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 fs-6">該聯單檔案</p>
                </div>
                <div class="col-8 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 fs-6">
                        <button class="btn btn-outline-success"  onclick="location.href='<?php echo base_url('document/documentTable').'/'.$projectInfo['pdf_id']?>'" >查看</button>
                    </p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row" >
                <div class="col-12 p-4 d-flex justify-content-center align-items-center">
                    <?php echo $qrcodeImgHtml?>
                </div>
               
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>

<script type="text/javascript">

</script>
<?= $this->endSection() ?>