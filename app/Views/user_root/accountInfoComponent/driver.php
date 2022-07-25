<div class="mb-3">
    <input type="text" class="form-control" id="user_id" name="user_id"  value="<?php echo $info['user_id']?>" hidden>
</div>
<div class="mb-3">
    <label for="user_email" class="form-label">使用者帳號</label>
    <input type="text" class="form-control" id="user_email" name="user_email"  value="<?php echo $info['user_email']?>" disabled>
</div>
<div class="mb-3">
    <label for="company_name" class="form-label">公司名稱</label>
    <input type="text" class="form-control" id="company_name" name="clearingCompany_name" value="<?php echo $info['clearingCompany_name']?>" disabled>
</div>
<div class="mb-3">
    <label for="company_number" class="form-label">公司統編</label>
    <input type="text" class="form-control" id="company_number" name="clearingCompany_uniformNumbers"  value="<?php echo $info['clearingCompany_uniformNumbers']?>" disabled>
</div>
<div class="mb-3">
    <label for="driver_name" class="form-label">駕駛姓名</label>
    <input type="text" class="form-control" id="driver_name" name="driver_name" value="<?php echo $info['clearingDriver_name'];?>">
</div>
<div class="mb-3">
    <label for="id_number" class="form-label">駕駛身分證號碼</label>
    <input type="text" class="form-control" id="id_number" name="driver_identityCard" value="<?php echo $info['clearingDriver_identityCard'];?>">
</div>
<div class="mb-3">
    <label for="license" class="form-label">車牌</label>
    <input type="text" class="form-control" id="license" name="driver_licensePlate" value="<?php echo $info['clearingDriver_licensePlate'];?>">
</div>
<div class="mb-3">
    <label for="phone" class="form-label">聯絡電話</label>
    <input type="text" class="form-control" id="phone" name="driver_phone" value="<?php echo $info['clearingDriver_phone'];?>">
</div>
<div class="mb-3">
    <label for="blood_type" class="form-label">血型</label>
    <input type="text" class="form-control" id="blood_type" name="driver_bloodType" value="<?php echo $info['clearingDriver_bloodType'];?>">
</div>
<div class="d-grid gap-2 d-md-block">
    <button class="btn btn-danger" type="submit">保存</button>
    <button class="btn btn-secondary" type="button" onclick="history.back()">回上頁</button>
</div>