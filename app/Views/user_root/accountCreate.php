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
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row">
                <?php 
                    switch ($key) {
                        case '2':
                ?>
                            <?= $this->include('registerMain_component/contract') ?>
                <?php   break;
                        case '3':
                ?>
                            <?=$this->include('registerMain_component/company')?>
                <?php   break;
                        case '4':
                ?>
                            <?=$this->include('registerMain_component/drive')?>
                <?php   break;
                        case '5':
                ?>
                           <?=$this->include('registerMain_component/shelter') ?>
                <?php   break; 
                        default:
                ?>
                            <?=$this->include('registerMain_component/404') ?>
                <?php   break;
                    }
                ?>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
