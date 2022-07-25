<!-- 超級帳號註冊頁面 -->
<?= $this->extend('layout_blade/register_layout') ?>
<?= $this->section('main') ?>


<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">車籍資訊</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Car Membership Information</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
         <div class=" col-11 bg-light shadow p-3 m-1  mx-auto ">
            <div class="d-grid gap-2 d-md-block mb-4">
                <button class="btn btn-secondary" type="button" onclick="history.back()">回上頁</button>
            </div>
            <table class="table table-striped fs-5">
                <thead>
                    <tr>
                        <th scope="col">車牌</th>
                        <th scope="col">司機姓名</th>
                        <th scope="col">操作</th>

                    </tr>
                </thead>
                <tbody style="word-break: break-all;">
                <?php foreach ($cars as $car) { ?>
                    <tr>
                        <td><?php echo $car['clearingDriver_licensePlate']?></td>
                        <td><?php echo $car['clearingDriver_name']?></td>
                        <td><button type="button" class="btn btn-outline-primary" onclick="location.href='<?php echo base_url('clearingCompany/getDriverInfo').'/'.$car['clearingDriver_id']?>'">查看</button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-center align-items-center">
                    <?= $pager->links() ?>  
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
