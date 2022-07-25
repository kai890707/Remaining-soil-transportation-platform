<div class="mb-3">
    <h3 class="text-center">政府單位帳號創建</h3>
</div>
<form id="government_register_form">
    <div class="mb-3">
        <label for="user_email" class="form-label">使用者帳號</label>
        <input type="email" class="form-control" id="user_email" name="user_email" required>
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
        <label for="government_name" class="form-label">單位名稱</label>
        <input type="text" class="form-control" id="government_name" name="government_name"required >
    </div>
    <div class="mb-3">
        <label for="government_principalName" class="form-label">負責人姓名</label>
        <input type="text" class="form-control" id="government_principalName" name="government_principalName" required>
    </div>
    <div class="mb-3">
        <label for="government_principalPhone" class="form-label">負責人電話</label>
        <input type="text" class="form-control" id="government_principalPhone" name="government_principalPhone"required>
    </div>
    <div class="mb-3">
        <label for="government_address" class="form-label">單位地址</label>
        <input type="text" class="form-control" id="government_address" name="government_address"required>
    </div>
    <div class="d-grid gap-2">
        <button class="btn btn-primary" type="submit">註冊</button>
    </div>
</form>

<script>
    $("form[id='government_register_form']").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(document.getElementById('government_register_form'));
        if (checkRegister(formData)) return;
        BaseLib.Post("/register/government",formData).then(
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
        if(isNaN(formData.get('government_principalPhone'))){
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