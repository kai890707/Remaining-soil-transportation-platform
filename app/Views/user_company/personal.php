<!-- 個人資訊頁面 -->
<?= $this->extend('layout_blade/personal_layout') ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">個人資訊</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Personal Information</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow">
            <form id="company_personal_form">
                <?= $this->include('personalMain_component/company');?>
            </form>
        </div>


    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>
<script>
    
    $("form[id='company_personal_form']").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(document.getElementById('company_personal_form'));

        Swal.fire({
            title: '確定要更新使用者資料嗎?',
            showDenyButton: true,
            confirmButtonText: '是! 我要更新',
            denyButtonText: `不! 目前不需要`,
        }).then((result) => {
            if (result.isConfirmed) {
                BaseLib.Post("/clearingCompany/personalUpdate",formData).then(
                (res)=>{
                    BaseLib.ResponseCheck(res).then(()=>{
                        console.log(res);
                        if(res.status =="success"){
                            window.location=BaseLib.base_Url+'/lobby';
                        }
                    })
                },
                (err)=>{
                    console.log(err);
                })
            } else if (result.isDenied) {
                Swal.fire('資料尚未更新', '', 'info')
            }
            
        })
     
    })
</script>
<?= $this->endSection() ?>