<!-- 聯單使用 -->
<?= $this->extend('layout_blade/sign_layout') ?>
<?= $this->section('customCss') ?>
<?= $this->endSection() ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">工程流向編號清單狀態</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Document Status</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 fs-6">編號</p>
                </div>
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 fs-6">使用狀態</p>
                </div>
                <div class="col-4 d-flex align-items-center justify-content-center">
                    <p class="m-0 fs-6">操作</p>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0">TCP EOG269956 104 00001</p>
                </div>
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 ">承造已簽名</p>
                </div>
                <div class="col-4 d-flex align-items-center justify-content-center">
                    <button class="btn btn-outline-primary">查看</button>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0">TCP EOG269956 104 00001</p>
                </div>
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 ">承造已簽名</p>
                </div>
                <div class="col-4 d-flex align-items-center justify-content-center">
                    <button class="btn btn-outline-primary">查看</button>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0">TCP EOG269956 104 00001</p>
                </div>
                <div class="col-4 border-end d-flex align-items-center justify-content-center">
                    <p class="m-0 ">承造已簽名</p>
                </div>
                <div class="col-4 d-flex align-items-center justify-content-center">
                    <button class="btn btn-outline-primary">查看</button>
                </div>
            </div>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center ">
                <li class="page-item disabled">
                    <a class="page-link">上一頁</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">下一頁</a>
                </li>
            </ul>
        </nav>



    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>


<?= $this->endSection() ?>