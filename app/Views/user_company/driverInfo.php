<!-- 個人資訊頁面 -->
<?= $this->extend('layout_blade/personal_layout') ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">司機資訊</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Driver Information</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow">
            <div class="mb-3">
                <label for="company_name" class="form-label">公司名稱</label>
                <input type="text" class="form-control" id="company_name" name="clearingCompany_name" value="<?php echo $info['clearingCompany_name']?>" disabled>
            </div>
            <div class="mb-3">
                <label for="company_number" class="form-label">公司統編</label>
                <input type="text" class="form-control" id="company_number" name="clearingCompany_uniformNumbers"  value="<?php echo $info['clearingCompany_uniformNumbers']?>" disabled>
            </div>
            <div class="mb-3">
                <label for="driver_name" class="form-label">駕駛姓名</label>
                <input type="text" class="form-control" id="driver_name" name="driver_name" value="<?php echo $info['clearingDriver_name'];?>" disabled>
            </div>
            <div class="mb-3">
                <label for="id_number" class="form-label">駕駛身分證號碼</label>
                <input type="text" class="form-control" id="id_number" name="driver_identityCard" value="<?php echo $info['clearingDriver_identityCard'];?>" disabled>
            </div>
            <div class="mb-3">
                <label for="license" class="form-label">車牌</label>
                <input type="text" class="form-control" id="license" name="driver_licensePlate" value="<?php echo $info['clearingDriver_licensePlate'];?>" disabled>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">聯絡電話</label>
                <input type="text" class="form-control" id="phone" name="driver_phone" value="<?php echo $info['clearingDriver_phone'];?>" disabled>
            </div>
            <div class="mb-3">
                <label for="blood_type" class="form-label">血型</label>
                <input type="text" class="form-control" id="blood_type" name="driver_bloodType" value="<?php echo $info['clearingDriver_bloodType'];?>" disabled>
            </div>
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-secondary" type="button" onclick="history.back()">回上頁</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>