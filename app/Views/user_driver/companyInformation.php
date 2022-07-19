<!-- 超級帳號註冊頁面 -->
<?= $this->extend('layout_blade/lobby_layout') ?>
<?= $this->section('main') ?>


<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">公司資訊</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Company Information</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded ">
            <div class="row">
                <div class="mb-3">
                    <label for="company_name" class="form-label">公司名稱</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $info['clearingCompany_name'];?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="company_number" class="form-label">公司統編</label>
                    <input type="text" class="form-control" id="company_number" name="company_number"  value="<?php echo $info['clearingCompany_uniformNumbers'];?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="company_address" class="form-label">公司地址</label>
                    <input type="text" class="form-control" id="company_address" name="company_address"  value="<?php echo $info['clearingCompany_address'];?>" disabled>
                </div>
                 <div class="mb-3" onclick="history.back()">
                    <button class="btn btn-primary">回上頁</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
