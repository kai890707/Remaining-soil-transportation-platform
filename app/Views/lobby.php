<!-- 各身分登入後大廳 -->

<?= $this->extend('layout_blade/lobby_layout') ?>
<?= $this->section('customCss') ?>
<?= $this->endSection() ?>
<?= $this->section('main') ?>
<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">營建剩餘土石方憑證系統</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Construction of remaining earthwork voucher system</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4">
        <div class="col-11 bg-light shadow p-4 m-1  mx-auto shadow">
            <p class="p-0 m-0 h4">目前登入身分 : <span><?php echo session()->get('permission_name')?></span></p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mt-4 p-0  ">
        <h2 class="text-center">功能列表</h2>
        <?php 
            switch (session()->get('permission_id')) {
                case '1':
        ?>
                    <?= $this->include('lobbyMain_component/root')?>
        <?php   break;
                case '2':
        ?>
                    <?= $this->include('lobbyMain_component/contract')?>
        <?php   break;
                case '3':
        ?>
                    <?= $this->include('lobbyMain_component/company')?>
        <?php   break;
                case '4':
        ?>
                    <?= $this->include('lobbyMain_component/driver')?>
        <?php   break;
                case '5':
        ?>
                    <?= $this->include('lobbyMain_component/shelter')?>
        <?php   break;
                case '6':
        ?>
                    <?= $this->include('lobbyMain_component/government')?>
        <?php   break; 
                default:
        ?>
                    <?=$this->include('registerMain_component/404') ?>
        <?php   break;
            }
        ?>
        
      

    </div>
</div>

<?= $this->endSection() ?>