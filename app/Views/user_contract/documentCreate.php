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
            <form id="create_document_form">
                <div class="mb-3">
                    <input type="text" class="form-control" id="engineering_id" name="engineering_id" value="<?php echo $engineering_id?>" hidden>
                </div>  
                <div class="mb-3">
                    <input type="text" class="form-control" id="contractCompany_id" name="contractCompany_id" value="<?php echo session()->get('contracting_id')?>" hidden>
                </div>  
                <div class="mb-3">
                    <label for="building_name" class="form-label">建物名稱</label>
                    <input type="text" class="form-control" id="building_name" name="building_name" >
                </div>
                <div class="mb-3">
                    <label for="building_number" class="form-label">建造編號</label>
                    <input type="text" class="form-control" id="building_number" name="building_number" >
                </div>
                <div class="mb-3">
                    <label for="building_address" class="form-label">建物地址</label>
                    <input type="text" class="form-control" id="building_address" name="building_address" >
                </div>
                <div class="mb-3">
                    <label for="starter_name" class="form-label">起造人姓名</label>
                    <input type="text" class="form-control" id="starter_name" name="starter_name" >
                </div>
                <div class="mb-3">
                    <label for="starter_phone" class="form-label">起造人電話</label>
                    <input type="text" class="form-control" id="starter_phone" name="starter_phone" >
                </div>
                <div class="mb-3">
                    <label for="transportation_route" class="form-label">運輸路線</label>
                    <input type="text" class="form-control" id="transportation_route" name="transportation_route" >
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-danger" type="submit">建立聯單</button>
                </div>
            </form>
        </div>


    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>
<script>
    
    $("form[id='create_document_form']").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(document.getElementById('create_document_form'));
        BaseLib.Post("/contract/insertEngineeringData",formData).then(
        (res)=>{
            BaseLib.ResponseCheck(res).then(()=>{
                console.log(res);
                if(res.status =="success"){
                    window.location=BaseLib.base_Url+'/project/projectList';
                }
            })
        },
        (err)=>{
            console.log(err);
        })

            
        
     
    })
</script>
<?= $this->endSection() ?>