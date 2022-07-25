<!-- 個人資訊頁面 -->
<?= $this->extend('layout_blade/personal_layout') ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">查看及修改帳號資訊</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">Personal Information</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow">
            <form id="root_personal_form">
                <?php if($permission_id == "1"){?>
                     <?= $this->include('user_root/accountInfoComponent/root');?>
                <?php }else if($permission_id == "2"){?>
                    <?= $this->include('user_root/accountInfoComponent/contract');?>
                <?php }else if($permission_id == "3"){?>
                    <?= $this->include('user_root/accountInfoComponent/company');?>
                <?php }else if($permission_id == "4"){?>
                    <?= $this->include('user_root/accountInfoComponent/driver');?>
                <?php }else if($permission_id == "5"){?>
                    <?= $this->include('user_root/accountInfoComponent/shelter');?>
                <?php }else if($permission_id == "6"){?>
                    <?= $this->include('user_root/accountInfoComponent/contract');?>
                <?php}else{?>
                <?php }?>
            </form>
        </div>


    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>
<script>
    let permission_id = <?php echo $permission_id;?> 
    $("form[id='root_personal_form']").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(document.getElementById('root_personal_form'));
        formData.append('permission_id',permission_id);
        // if(checkRegister(formData))return;
        Swal.fire({
            title: '確定要更新使用者資料嗎?',
            showDenyButton: true,
            confirmButtonText: '是! 我要更新',
            denyButtonText: `不! 目前不需要`,
        }).then((result) => {
            if (result.isConfirmed) {
                BaseLib.Post("/root/personalUpdate",formData).then(
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
    function checkRegister(formData) {
        if(formData.get(permission_id)!=="1"){
            return false;
        }
        if(formData.get('new_password')!== formData.get('re_password')){
            Swal.fire(
                '輸入錯誤!',
                '二次輸入的密碼不符合!',
                'info'
            )
            return true;
        }
        if(formData.get('new_password').length<=6){
            Swal.fire(
                '提醒!',
                '密碼必須大於6個英文字!',
                'info'
            )
            return true;
        }
        return false;
    } 
</script>
<?= $this->endSection() ?>