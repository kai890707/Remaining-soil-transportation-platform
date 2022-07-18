<div class="mb-3">
    <h3 class="text-center">收容場所帳號創建</h3>
</div>
<form id="shelter_register_form">
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
        <label for="containmentCompany_name" class="form-label">公司名稱</label>
        <input type="text" class="form-control" id="containmentCompany_name" name="containmentCompany_name">
    </div>
    <div class="mb-3">
        <label for="containmentCompany_uniformNumbers" class="form-label">公司統編</label>
        <input type="text" class="form-control" id="containmentCompany_uniformNumbers" name="containmentCompany_uniformNumbers">
    </div>
    <div class="mb-3">
        <label for="containmentCompany_principalName" class="form-label">負責人姓名</label>
        <input type="text" class="form-control" id="containmentCompany_principalName" name="containmentCompany_principalName">
    </div>
    <div class="mb-3">
        <label for="containmentCompany_principalPhone" class="form-label">負責人電話</label>
        <input type="text" class="form-control" id="containmentCompany_principalPhone" name="containmentCompany_principalPhone">
    </div>
    <div class="mb-3">
        <label for="containmentCompany_placeAddress" class="form-label">收容場所地址</label>
        <input type="text" class="form-control" id="containmentCompany_placeAddress" name="containmentCompany_placeAddress">
    </div>
    <div class="mb-3">
        <label for="containmentCompany_address" class="form-label">收容公司地址</label>
        <input type="text" class="form-control" id="containmentCompany_address" name="containmentCompany_address">
    </div>
    <div class="d-grid gap-2">
    <button class="btn btn-primary" type="submit">註冊</button>
    </div>
</form>

<script>
    $("form[id='shelter_register_form']").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(document.getElementById('shelter_register_form'));
        if (checkRegister(formData)) return;
        BaseLib.Post("/register/containmentcompany",formData).then(
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
        if(isNaN(formData.get('containmentCompany_principalPhone'))){
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