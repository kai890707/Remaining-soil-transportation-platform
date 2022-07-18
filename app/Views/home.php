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
            <form>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">電子郵件</label>
                    <input type="email" class="form-control" id="account" name="account" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">密碼</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remrberMeCheckBox" name="remrberMeCheckBox">
                    <label class="form-check-label" for="exampleCheck1">記住我</label>
                </div>
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-primary btn-lg" id="login">登入</button>
                    <a type="button" class="btn btn-secondary btn-lg" href="<?php echo base_url('drverRegister') ?>">清運司機註冊</a>
                </div>

            </form>
        </div>


    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('customJs') ?>
<script>
    function $(e) {
        return document.querySelector(e);
    }
    if (localStorage.getItem('account')) {
        $('#account').value = localStorage.getItem('account');
    }
    if (localStorage.getItem('password')) {
        $('#password').value = localStorage.getItem('password');
        $('#remrberMeCheckBox').checked = true;
    }
    $('#login').onclick = function() {
        localStorage.setItem('account', $('#account').value);
        if ($('#remrberMeCheckBox').checked) {
            localStorage.setItem('password', $('#password').value);
        } else {
            localStorage.removeItem('password');
        }
    }
</script>
<?= $this->endSection() ?>