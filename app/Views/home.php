<?= $this->extend('layout_blade/home_layout') ?>

<?= $this->section('customCss') ?>
<style>
    .factor {
        background-image: url(<?php echo base_url('assets/images/pic1.jpg') ?>);
        background-repeat: no-repeat;
        /* background-size: 100% 100%; */
        /* background-size: cover; */
        max-width: 100%;
        object-fit: cover;
        background-position: center center;
        /* -webkit-clip-path: polygon(0% 100%, 0% 0%, 100% 0%); */
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('main') ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">營建剩餘土石方憑證系統</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        登入
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">承造廠商</a></li>
                        <li><a class="dropdown-item" href="#">清運公司</a></li>
                        <li><a class="dropdown-item" href="#">司機</a></li>
                        <li><a class="dropdown-item" href="#">收容場所</a></li>
                        <li><a class="dropdown-item" href="#">政府單位</a></li>
                    </ul>
                </li>

            </div>
        </div>
    </div>
</nav>
<div style="margin-top: 60px;">
    <h1 class="text-center mt-3 text-white fw-bolder" style="font-size:45px">營建剩餘土石方</h1>
    <h1 class="text-center  text-white fs-2  fw-bolder">憑證系統</h1>

</div>


<div class="row mt-4 p-0">
    <div class="col-xl-4 col-12 bg-light shadow p-4 mb-3 factor">
        承造廠商
    </div>
    <div class="col-xl-4 col-12 bg-light shadow p-4 mb-3">
        清運公司
    </div>
    <div class="col-xl-4 col-12 bg-light shadow p-4 mb-3">
        司機
    </div>
    <div class="col-xl-4 col-12 bg-light shadow p-4 mb-3">
        收容場所
    </div>
    <div class="col-xl-4 col-12 bg-light shadow p-4 mb-3">
        政府單位
    </div>

</div>
<?= $this->endSection() ?>