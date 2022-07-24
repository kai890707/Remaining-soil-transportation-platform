<!-- 工程聯單 -->
<?= $this->extend('layout_blade/documentList_layout') ?>
<?= $this->section('customCss') ?>

<?= $this->endSection() ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">工程流向編號清單</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Document List</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <?php if(session()->get('permission_id') == 2){?>
            <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
                <div class="row text-break d-flex align-items-center justify-content-center">
                    <div class="col-5 border-end ">
                        <p class="m-0 text-center">新增聯單</p>
                    </div>
                    <div class="col-7 border-end text-center">
                        <button type="button" class="btn btn-outline-success"   onclick="location.href='<?php echo base_url('contract/documentCreate').'/'.$projectInfo['engineering_id']?>'">新增聯單</button> 
                    </div>
                    
                </div>
            </div>
        <?php }?>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row text-break">
                <div class="col-5 border-end ">
                    <p class="m-0 text-center">工程流向編號</p>
                </div>
                <div class="col-7">
                    <p class="m-0 text-center"><?php echo $projectInfo['engineering_name']?></p>
                </div>
            </div>
            <div class="row text-break">
                <div class="col-5 border-end ">
                    <p class="m-0 text-center">工程名稱</p>
                </div>
                <div class="col-7">
                    <p class="m-0 text-center"><?php echo $projectInfo['engineering_projectNumber']?></p>
                </div>
            </div>
            <div class="row text-break">
                <div class="col-5 border-end ">
                    <p class="m-0 text-center">完成進場收容</p>
                </div>
                <div class="col-7 border-end">
                    <p class="m-0 text-center"><?php echo $countArray["Shelter"]?></p>
                </div>
            </div>
        </div>
       
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row text-break d-flex align-items-center justify-content-center">
                <div class="col-4 border-end ">
                    <p class="m-0 text-center">未使用聯單</p>
                </div>
                <div class="col-4 border-end ">
                    <p class="m-0 text-center"><?php echo $countArray["Create"]?></p>
                </div>
                <div class="col-4  text-center">
                    <button class="btn btn-outline-success " onclick="location.href='<?php echo base_url('document').'/'.$projectInfo['engineering_id'].'/1'?>'">查看</button>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row text-break d-flex align-items-center justify-content-center">
                <div class="col-4 border-end ">
                    <p class="m-0 text-center">承造已使用</p>
                </div>
                <div class="col-4 border-end ">
                    <p class="m-0 text-center"><?php echo $countArray["Contract"]?></p>
                </div>
                <div class="col-4  text-center">
                    <button class="btn btn-outline-success" onclick="location.href='<?php echo base_url('document').'/'.$projectInfo['engineering_id'].'/2'?>'">查看</button>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row text-break d-flex align-items-center justify-content-center">
                <div class="col-4 border-end ">
                    <p class="m-0 text-center">清運已使用</p>
                </div>
                <div class="col-4 border-end">
                    <p class="m-0 text-center"><?php echo $countArray["Driver"]?></p>
                </div>
                <div class="col-4  text-center">
                    <button class="btn btn-outline-success" onclick="location.href='<?php echo base_url('document').'/'.$projectInfo['engineering_id'].'/3'?>'">查看</button>
                </div>
            </div>
        </div>
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
            <div class="row text-break d-flex align-items-center justify-content-center">
                <div class="col-4 border-end">
                    <p class="m-0 text-center">聯單總數量</p>
                </div>
                <div class="col-4 border-end">
                    <p class="m-0 text-center"><?php echo $countArray["All"]?></p>
                </div>
                <div class="col-4  text-center">
                    <button class="btn btn-outline-success" onclick="location.href='<?php echo base_url('document').'/'.$projectInfo['engineering_id'].'/4'?>'">查看</button>
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