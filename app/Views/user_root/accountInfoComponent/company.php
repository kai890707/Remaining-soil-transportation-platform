<div class="mb-3">
    <input type="text" class="form-control" id="user_id" name="user_id"  value="<?php echo $info['user_id']?>" hidden>
</div>
<div class="mb-3">
    <label for="user_email" class="form-label">使用者帳號</label>
    <input type="text" class="form-control" id="user_email" name="user_email"  value="<?php echo $info['user_email']?>" disabled>
</div>
<div class="mb-3">
    <label for="company_name" class="form-label">公司名稱</label>
    <input type="text" class="form-control" id="company_name" name="clearingCompany_name" value="<?php echo $info['clearingCompany_name']?>" >
</div>
<div class="mb-3">
    <label for="company_number" class="form-label">公司統編</label>
    <input type="text" class="form-control" id="company_number" name="clearingCompany_uniformNumbers"  value="<?php echo $info['clearingCompany_uniformNumbers']?>">
</div>
<div class="mb-3">
    <label for="boss_name" class="form-label">負責人姓名</label>
    <input type="text" class="form-control" id="boss_name" name="clearingCompany_principalName"  value="<?php echo $info['clearingCompany_principalName']?>">
</div>
<div class="mb-3">
    <label for="id_number" class="form-label">身分證號碼</label>
    <input type="text" class="form-control" id="id_number" name="clearingCompany_identityCard"  value="<?php echo $info['clearingCompany_identityCard']?>">
</div>
<div class="mb-3">
    <label for="phone" class="form-label">聯絡電話</label>
    <input type="text" class="form-control" id="phone" name="clearingCompany_phone"  value="<?php echo $info['clearingCompany_phone']?>">
</div>
<div class="mb-3">
    <label for="company_address" class="form-label">清運公司地址</label>
    <input type="text" class="form-control" id="company_address" name="clearingCompany_address"  value="<?php echo $info['clearingCompany_address']?>">
</div>
<div class="d-grid gap-2 d-md-block">
    <button class="btn btn-danger" type="submit">保存</button>
    <button class="btn btn-secondary" type="button" onclick="history.back()">回上頁</button>
</div>