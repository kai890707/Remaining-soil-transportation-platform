<!-- 超級帳號註冊頁面 -->
<?= $this->extend('layout_blade/register_layout') ?>
<?= $this->section('main') ?>


<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">帳號創建</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Account Creation</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded block-btn" id="contract" onclick="location.href='<?php echo base_url('register/2')?>'">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark" style="font-size: 2rem;"></i>
                </div>
                <div class="col-8">
                    <p class="h4 text-center">承造公司身分創建</p>
                    <p class="h5 p-0 m-0 text-center">Contracting Company</p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded block-btn" id="transport" onclick="location.href='<?php echo base_url('register/3')?>'">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark" style="font-size: 2rem;"></i>
                </div>
                <div class="col-8">
                    <p class="h4 text-center">清運公司身分創建</p>
                    <p class="h5 p-0 m-0 text-center">Transport Company</p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded block-btn" id="drive" onclick="location.href='<?php echo base_url('register/4')?>'">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark" style="font-size: 2rem;"></i>
                </div>
                <div class="col-8">
                    <p class="h4 text-center">清運司機身分創建</p>
                    <p class="h5 p-0 m-0 text-center">Transport Driver</p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded block-btn" id="shelter" onclick="location.href='<?php echo base_url('register/5')?>'">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark" style="font-size: 2rem;"></i>
                </div>
                <div class="col-8">
                    <p class="h4 text-center">收容場所身分創建</p>
                    <p class="h5 p-0 m-0 text-center">Shelter</p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded block-btn" id="shelter" onclick="location.href='<?php echo base_url('register/6')?>'">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <i class="bi bi-file-earmark" style="font-size: 2rem;"></i>
                </div>
                <div class="col-8">
                    <p class="h4 text-center">政府單位身分創建</p>
                    <p class="h5 p-0 m-0 text-center">Government</p>
                </div>
            </div>
        </div>


    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>
    <script>

    </script>
<?= $this->endSection() ?>
