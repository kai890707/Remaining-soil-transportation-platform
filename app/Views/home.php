<!-- 網頁主要進入點(/) -->
<?= $this->extend('layout_blade/home_layout') ?>
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
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow">
            <h2 class="text-center mb-2">使用者登入</h2>
            <form id="login_form">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">電子郵件</label>
                    <input type="email" class="form-control" id="account" name="user_email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">密碼</label>
                    <input type="password" class="form-control" id="password" name="user_password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remrberMeCheckBox" name="remrberMeCheckBox">
                    <label class="form-check-label" for="exampleCheck1">記住我</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg" id="login">登入</button>
                    <a type="button" class="btn btn-secondary btn-lg" href="<?php echo base_url('drverRegister') ?>">清運司機註冊</a>
                </div>

            </form>
        </div>


    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>
<script>
    
    if (localStorage.getItem('account')) {
        $('#account').val(localStorage.getItem('account'));
    }
    if (localStorage.getItem('password')) {
        $('#password').val(localStorage.getItem('password'));
        $('#remrberMeCheckBox').prop("checked", true);
    }
    $('#remrberMeCheckBox').click (function () {
        localStorage.setItem('account', $('#account').val());
        if (document.getElementById('remrberMeCheckBox').checked) {
            localStorage.setItem('password', $('#password').val());
        } else {
            localStorage.removeItem('password');
        }
      })

    $("form[id='login_form']").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(document.getElementById('login_form'));
        BaseLib.Post("/login",formData).then(
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
    })
  

</script>
<?= $this->endSection() ?>