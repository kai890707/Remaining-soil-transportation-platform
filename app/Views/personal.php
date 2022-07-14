<!-- 個人資訊頁面 -->
<?= $this->extend('layout_blade/personal_layout') ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">個人資訊</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Personal Information</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow">
            <form>
                <div class="mb-3">
                    <label for="company_name" class="form-label">公司名稱</label>
                    <input type="text" class="form-control" id="company_name" name="company_name">
                </div>
                <div class="mb-3">
                    <label for="company_number" class="form-label">公司統編</label>
                    <input type="text" class="form-control" id="company_number" name="company_number">
                </div>
                <div class="mb-3">
                    <label for="boss_name" class="form-label">負責人姓名</label>
                    <input type="text" class="form-control" id="boss_name" name="boss_name">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">負責人電話</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="mb-3">
                    <label for="shelter_address" class="form-label">收容場所地址</label>
                    <input type="text" class="form-control" id="shelter_address" name="shelter_address">
                </div>
                <div class="mb-3">
                    <label for="company_address" class="form-label">收容公司地址</label>
                    <input type="text" class="form-control" id="company_address" name="company_address">
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-danger" type="button">保存</button>
                    <button class="btn btn-secondary" type="button">取消</button>
                </div>
            </form>
        </div>


    </div>
</div>

<?= $this->endSection() ?>