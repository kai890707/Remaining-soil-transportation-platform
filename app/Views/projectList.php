<!-- 聯單頁面 -->
<?= $this->extend('layout_blade/projectList_layout') ?>
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
        <div class=" col-11 bg-light shadow p-3 m-1  mx-auto ">
            <div class="w-100 d-flex justify-content-end align-items-center mb-2">
               <button type="button" class="btn btn-outline-success"   onclick="location.href='<?php echo base_url('contract/projectCreate')?>'">申請聯單</button> 
            </div>
            <table class="table table-striped fs-5">
                <thead>
                    <tr>
                        <th scope="col">名稱</th>
                        <th scope="col">流向編號</th>
                        <th scope="col">操作</th>

                    </tr>
                </thead>
                <tbody style="word-break: break-all;">
                <?php foreach ($projects as $proj) {?>     
                    <tr>
                        <td><?php echo $proj['engineering_name']?></td>
                        <td><?php echo $proj['engineering_projectNumber']?></td>
                        <td><button type="button" class="btn btn-outline-primary">查看</button></td>
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