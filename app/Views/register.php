<!-- 清運司機註冊頁面 -->
<?= $this->extend('layout_blade/register_layout') ?>
<?= $this->section('main') ?>

<div style="margin-top: 60px;">
    <h1 class="text-center mt-3 text-dark fw-bolder" style="font-size:45px">營建剩餘土石方</h1>
    <h1 class="text-center  text-white fs-2  fw-bolder">憑證系統</h1>

</div>

<div class="container">
    <div class="row mt-4 p-0  ">
        <div class=" col-11 bg-light shadow p-4 m-1  mx-auto shadow">
            <h2 class="text-center mb-2">清運司機註冊</h2>
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
                    <button type="button" class="btn btn-primary btn-lg" id="login">送出</button>
                </div>

            </form>
        </div>


    </div>
</div>

<?= $this->endSection() ?>
