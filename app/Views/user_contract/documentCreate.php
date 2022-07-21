<!-- 個人資訊頁面 -->
<?= $this->extend('layout_blade/personal_layout') ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">聯單新增</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Create Document</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow">
            <form id="create_project_form">
                <div class="mb-3">
                    <label for="engineering_name" class="form-label">工程名稱</label>
                    <input type="text" class="form-control" id="engineering_name" name="engineering_name" >
                </div>
                <div class="mb-3">
                    <label for="engineering_projectNumber" class="form-label">工程流向編號</label>
                    <input type="text" class="form-control" id="engineering_projectNumber" name="engineering_projectNumber" >
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-danger" type="submit">建立工程</button>
                </div>
            </form>
        </div>


    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>
<script>
    
    $("form[id='create_project_form']").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(document.getElementById('create_project_form'));
        BaseLib.Post("/contract/projectCreate",formData).then(
        (res)=>{
            BaseLib.ResponseCheck(res).then(()=>{
                console.log(res);
                if(res.status =="success"){
                    window.location=BaseLib.base_Url+'/projectList';
                }
            })
        },
        (err)=>{
            console.log(err);
        })

            
        
     
    })
</script>
<?= $this->endSection() ?>