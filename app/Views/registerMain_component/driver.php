<div class="mb-3">
    <h3 class="text-center">清運司機帳號創建</h3>
</div>
<form id="drive_register_form">
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
        <label for="clearingCompanyId" class="form-label">公司名稱</label>
        <select class="form-select" aria-label="Default select example" name="clearingCompanyId" required>
            <option selected value="0">請選擇公司</option>
            <?php 
                foreach ($company as $key) {
            ?>
                    <option value="<?php echo $key['clearingCompany_id'] ?>"><?php echo $key['clearingCompany_name']?></option>
            <?php   }
            ?>
           
        </select>
    </div>
   
    <div class="mb-3">
        <label for="driver_name" class="form-label">駕駛姓名</label>
        <input type="text" class="form-control" id="driver_name" name="driver_name"required >
    </div>
    <div class="mb-3">
        <label for="driver_identityCard" class="form-label">駕駛身分證號碼</label>
        <input type="text" class="form-control" id="driver_identityCard" name="driver_identityCard"required>
    </div>
    <div class="mb-3">
        <label for="driver_licensePlate" class="form-label">車牌</label>
        <input type="text" class="form-control" id="driver_licensePlate" name="driver_licensePlate"required>
    </div>
    <div class="mb-3">
        <label for="driver_phone" class="form-label">聯絡電話</label>
        <input type="text" class="form-control" id="driver_phone" name="driver_phone"required>
    </div>
    <div class="mb-3"> 
        <label for="driver_bloodType" class="form-label">血型</label>
        <select class="form-select" aria-label="Default select example" name="driver_bloodType"required>
            <option selected value="0">請選擇血型</option>
            <option value="O">O型</option>
            <option value="A">A型</option>
            <option value="B">B型</option>
            <option value="AB">AB型</option>
         
        </select>
    </div>
    <div class="d-grid gap-2">
        <button class="btn btn-primary" type="submit">註冊</button>
    </div>
</form>
<script>
    $("form[id='drive_register_form']").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(document.getElementById('drive_register_form'));
        if (checkRegister(formData)) return;
        BaseLib.Post("/register/clearingDriver",formData).then(
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
        if(isNaN(formData.get('driver_phone'))){
            Swal.fire(
                '提醒!',
                '電話必須使用數字!',
                'info'
            )
            return true;
        }
        if(formData.get('clearingCompanyId') == "0"){
            Swal.fire(
                '提醒!',
                '請選擇公司!',
                'info'
            )
            return true;
        }
        if(formData.get('driver_bloodType') == "0"){
            Swal.fire(
                '提醒!',
                '請選擇血型!',
                'info'
            )
            return true;
        }
        return false;
    }

</script>