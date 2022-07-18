<div class="mb-3">
    <h3 class="text-center">承造廠商帳號創建</h3>
</div>
<form id="contract_register_form">
    <div class="mb-3">
        <label for="user_email" class="form-label">使用者帳號</label>
        <input type="text" class="form-control" id="user_email" name="user_email" required>
    </div>
    <div class="mb-3">
        <label for="user_password" class="form-label">使用者密碼 <span class="text-danger">*密碼長度需大於6個字</span></label>
        <input type="password" class="form-control" id="user_password" name="user_password" required>
    </div>
    <div class="mb-3">
        <label for="re_user_password" class="form-label">再次輸入使用者密碼</label>
        <input type="password" class="form-control" id="re_user_password" name="re_user_password" required>
    </div>
    <div class="mb-3">
        <label for="contracting_companyName" class="form-label">公司名稱</label>
        <input type="text" class="form-control" id="contracting_companyName" name="contracting_companyName" >
    </div>
    <div class="mb-3">
        <label for="contracting_uniformNumbers" class="form-label">公司統編</label>
        <input type="text" class="form-control" id="contracting_uniformNumbers" name="contracting_uniformNumbers" >
    </div>
    <div class="mb-3">
        <label for="contracting_contractUserName" class="form-label">承造人姓名</label>
        <input type="text" class="form-control" id="contracting_contractUserName" name="contracting_contractUserName" >
    </div>
    <div class="mb-3">
        <label for="contracting_contractUserPhone" class="form-label">承造人電話</label>
        <input type="text" class="form-control" id="contracting_contractUserPhone" name="contracting_contractUserPhone">
    </div>
    <div class="mb-3">
        <label for="contracting_contractWatcherName" class="form-label">監造人姓名</label>
        <input type="text" class="form-control" id="contracting_contractWatcherName" name="contracting_contractWatcherName">
    </div>
    <div class="mb-3">
        <label for="contracting_contractWatcherPhone" class="form-label">監造人電話</label>
        <input type="text" class="form-control" id="contracting_contractWatcherPhone" name="contracting_contractWatcherPhone" >
    </div>
    <div class="mb-3">
        <label for="contracting_companyAddress" class="form-label">公司地址</label>
        <input type="text" class="form-control" id="contracting_companyAddress" name="contracting_companyAddress" >
    </div>
    <div class="d-grid gap-2">
        <button class="btn btn-primary" type="submit">註冊</button>
    </div>
</form>

<script>
    $("form[id='contract_register_form']").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(document.getElementById('contract_register_form'));
        if (checkRegister(formData)) return;
        BaseLib.Post("/register/contractingcompany",formData).then(
            (res)=>{
                BaseLib.ResponseCheck(res).then(()=>{
                    if(res.status =="success"){
                        window.location=BaseLib.base_Url
                    }
                })
            },
            (err)=>{
                console.log(err);
            })
    })
    function checkRegister(formData) {
        if(formData.get('user_password')!== formData.get('re_user_password')){
            Swal.fire(
                '輸入錯誤!',
                '二次輸入的密碼不符合!',
                'info'
            )
            return true;
        }
        if(formData.get('user_password').length<=6){
            Swal.fire(
                '提醒!',
                '密碼必須大於6個英文字!',
                'info'
            )
            return true;
        }
        if(isNaN(formData.get('contracting_contractUserPhone'))){
            Swal.fire(
                '提醒!',
                '電話必須使用數字!',
                'info'
            )
            return true;
        }
        if(isNaN(formData.get('contracting_contractWatcherPhone'))){
            Swal.fire(
                '提醒!',
                '電話必須使用數字!',
                'info'
            )
            return true;
        }
        return false;
    }

</script>