<!-- 個人資訊頁面 -->
<?= $this->extend('layout_blade/personal_layout') ?>
<?= $this->section('main') ?>

<div class="jumbotron jumbotron-fluid" style="background-image:url('<?php echo base_url('assets/images/personalbanner.jpg') ?>') ;background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto p-4">
                <h1 class="display-4 fw-bold text-white text-shadow">修改密碼</h1>
                <p class="lead fw-bold text-white text-shadow p-0 m-0">change Password</p>
            </div>
        </div>


    </div>
</div>
<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow">
            <form id="change_password_form">
                <div class="mb-3">
                    <label for="user_email" class="form-label">使用者帳號</label>
                    <input type="text" class="form-control" id="user_email" name="user_email"  value="<?php echo session()->get('user_email')?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">輸入欲修改之密碼</label>
                    <input type="password" class="form-control" id="new_password" name="new_password"  value="">
                </div>
                <div class="mb-3">
                    <label for="re_password" class="form-label">再次輸入欲修改之密碼</label>
                    <input type="password" class="form-control" id="re_password" name="re_password"  value="">
                </div>
                <div class="mb-3">
                    <label for="user_password" class="form-label">輸入舊密碼</label>
                    <input type="password" class="form-control" id="user_password" name="user_password"  value="">
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-danger" type="submit">修改</button>
                    <button class="btn btn-secondary" type="button" onclick="history.back()">回上頁</button>
                </div>
            </form>
        </div>


    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>
<script>
    
    $("form[id='change_password_form']").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(document.getElementById('change_password_form'));

        Swal.fire({
            title: '確定要更新使用者資料嗎?',
            showDenyButton: true,
            confirmButtonText: '是! 我要更新',
            denyButtonText: `不! 目前不需要`,
        }).then((result) => {
            if (result.isConfirmed) {
                BaseLib.Post("/changePassword",formData).then(
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