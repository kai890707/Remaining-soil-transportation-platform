<!-- 工程聯單 -->
<?= $this->extend('layout_blade/projectList_layout') ?>
<?= $this->section('customCss') ?>

<?= $this->endSection() ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">工程聯單</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Engineering Records</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row text-break">
                <div class="col-5 border-end ">
                    <p class="m-0 text-center">工程流向編號</p>
                </div>
                <div class="col-7">
                    <p class="m-0 text-center">12345646</p>
                </div>
            </div>
            <div class="row text-break">
                <div class="col-5 border-end ">
                    <p class="m-0 text-center">工程名稱</p>
                </div>
                <div class="col-7">
                    <p class="m-0 text-center">12345646</p>
                </div>
            </div>
            <div class="row text-break">
                <div class="col-5 border-end ">
                    <p class="m-0 text-center">完成進場收容</p>
                </div>
                <div class="col-7 border-end">
                    <p class="m-0 text-center">12345646</p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row text-break d-flex align-items-center justify-content-center">
                <div class="col-4 border-end ">
                    <p class="m-0 text-center">未使用聯單</p>
                </div>
                <div class="col-4 border-end ">
                    <p class="m-0 text-center">186151616163</p>
                </div>
                <div class="col-4  text-center">
                    <button class="btn btn-outline-success ">查看</button>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row text-break d-flex align-items-center justify-content-center">
                <div class="col-4 border-end ">
                    <p class="m-0 text-center">承造已使用</p>
                </div>
                <div class="col-4 border-end ">
                    <p class="m-0 text-center">1861516516</p>
                </div>
                <div class="col-4  text-center">
                    <button class="btn btn-outline-success">查看</button>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row text-break d-flex align-items-center justify-content-center">
                <div class="col-4 border-end ">
                    <p class="m-0 text-center">清運已使用</p>
                </div>
                <div class="col-4 border-end">
                    <p class="m-0 text-center">1861516516</p>
                </div>
                <div class="col-4  text-center">
                    <button class="btn btn-outline-success">查看</button>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row text-break d-flex align-items-center justify-content-center">
                <div class="col-4 border-end">
                    <p class="m-0 text-center">聯單總數量</p>
                </div>
                <div class="col-4 border-end">
                    <p class="m-0 text-center">1861516516</p>
                </div>
                <div class="col-4  text-center">
                    <button class="btn btn-outline-success">查看</button>
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