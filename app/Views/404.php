<!-- 網頁主要進入點(/) -->
<?= $this->extend('layout_blade/home_layout') ?>
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
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow ">
            <div class="row"><h2 class="text-center mb-2">頁面不存在</h2></div>
            <div class="row">
                 <a href="<?php echo base_url('/')?>" class="btn btn-outline-secondary">回首頁</a>
            </div>
           
        </div>


    </div>
</div>

<?= $this->endSection() ?>
