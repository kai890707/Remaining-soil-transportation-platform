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
               <button type="button" class="btn btn-outline-success">申請聯單</button> 
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
                    <tr>
                        <td>工程流向編號清單名稱1</td>
                        <td>EOG24264asdasdas+4+15165</td>
                        <td><button type="button" class="btn btn-outline-primary">查看</button></td>
                    </tr>
                    <tr>
                        <td>工程流向編號清單名稱2</td>
                        <td>EO</td>
                        <td><button type="button" class="btn btn-outline-primary">查看</button></td>
                    </tr>
                    <tr>
                        <td>工程流向編號清單名稱3</td>
                        <td>EOG24264984651516</td>
                        <td><button type="button" class="btn btn-outline-primary">查看</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>