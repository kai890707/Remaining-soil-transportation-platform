<!-- 各使用狀態聯單 -->
<?= $this->extend('layout_blade/documentList_layout') ?>
<?= $this->section('customCss') ?>

<?= $this->endSection() ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow"><?= esc($subTitle)?></h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0"><?= esc($enSubTitle)?></p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
       
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow rounded">
        
                <button class="btn btn-primary" onclick="history.back()">回上頁</button>
            
             <table class="table table-striped fs-5">
                <thead>
                    <tr>
                        <th scope="col">聯單編號</th>
                        <th scope="col">使用狀態</th>
                        <th scope="col">操作</th>

                    </tr>
                </thead>
                <tbody style="word-break: break-all;">
                <?php foreach ($info as $i) {?>     
                    <tr>
                        <td><?php echo $i['pdf_fileNumber']?></td>
                        <td><?php echo $i['status_remark']?></td>
                        <td><button type="button" class="btn btn-outline-primary"  onclick="location.href='<?php echo base_url('pdf/validSign').'/'.$i['pdf_id']?>'" >查看</button></td>
                    </tr> 
                <?php }?>
                </tbody>
            </table>
            <div class="d-flex justify-content-center align-items-center">
                    <?= $pager->links() ?>  
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>

<script type="text/javascript">

</script>
<?= $this->endSection() ?>