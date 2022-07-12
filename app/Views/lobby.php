<!-- 各身分登入後大廳 -->

<?= $this->extend('layout_blade/lobby_layout') ?>
<?= $this->section('customCss') ?>
<?= $this->endSection() ?>
<?= $this->section('main') ?>
<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">營建剩餘土石方憑證系統</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Construction of remaining earthwork voucher system</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4">
        <div class="col-11 bg-light shadow p-4 m-1  mx-auto shadow">
            <p class="p-0 m-0 h4">目前登入身分 : <span>xxx</span></p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-4 p-0  ">
        <h2 class="text-center">功能列表</h2>
        <!-- include lobby main page start-->
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <i class="bi bi-building " style="font-size: 2rem;"></i>
                </div>
                <div class="col-8">
                    <p class="h4 p-0 m-0 text-center">公司資訊</p>
                    <p class="h5 p-0 m-0 text-center">Company Information</p>
                </div>
            </div>

        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark" style="font-size: 2rem;"></i>
                </div>
                <div class="col-8">
                    <p class="h4 text-center">聯單使用</p>
                    <p class="h5 p-0 m-0 text-center">The Single Use</p>
                </div>
            </div>

        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <i class="bi bi-person" style="font-size: 2rem;"></i>
                </div>
                <div class="col-8">
                    <p class="h4 text-center">個人資訊</p>
                    <p class="h5 p-0 m-0 text-center">Personal Information</p>
                </div>
            </div>

        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">

            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <i class="bi bi-folder-check" style="font-size: 2rem;"></i>
                </div>
                <div class="col-8">
                    <p class="h4 text-center">工程結案區</p>
                    <p class="h5 p-0 m-0 text-center">Project Closed Area</p>
                </div>
            </div>
        </div>
        <!-- end -->

    </div>
</div>

<?= $this->endSection() ?>