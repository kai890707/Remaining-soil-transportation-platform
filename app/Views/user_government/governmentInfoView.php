<!-- 超級帳號註冊頁面 -->
<?= $this->extend('layout_blade/lobby_layout') ?>
<?= $this->section('main') ?>


<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">政府單位資訊</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Organization Information</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded ">
         
            <div class="row">
                <div class="mb-3">
                    <label for="government_name" class="form-label">單位名稱</label>
                    <input type="text" class="form-control" id="government_name" name="government_name" value="<?php echo $info['government_name'];?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="government_principalName" class="form-label">單位負責人</label>
                    <input type="text" class="form-control" id="government_principalName" name="government_principalName"  value="<?php echo $info['government_principalName'];?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="government_principalPhone" class="form-label">單位電話</label>
                    <input type="text" class="form-control" id="government_principalPhone" name="government_principalPhone"  value="<?php echo $info['government_principalPhone'];?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="government_address" class="form-label">單位地址</label>
                    <input type="text" class="form-control" id="government_address" name="government_address"  value="<?php echo $info['government_address'];?>" disabled>
                </div>
                <div class="mb-3" onclick="history.back()">
                    <button class="btn btn-primary">回上頁</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
