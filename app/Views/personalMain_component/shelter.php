<div class="mb-3">
    <label for="company_name" class="form-label">公司名稱</label>
    <input type="text" class="form-control" id="company_name" name="containmentCompany_name" value="<?php echo $info['containmentCompany_name'];?>" disabled>
</div>
<div class="mb-3">
    <label for="company_number" class="form-label">公司統編</label>
    <input type="text" class="form-control" id="company_number" name="containmentCompany_uniformNumbers" value="<?php echo $info['containmentCompany_uniformNumbers'];?>" disabled>
</div>
<div class="mb-3">
    <label for="boss_name" class="form-label">負責人姓名</label>
    <input type="text" class="form-control" id="boss_name" name="containmentCompany_principalName" value="<?php echo $info['containmentCompany_principalName'];?>">
</div>
<div class="mb-3">
    <label for="phone" class="form-label">負責人電話</label>
    <input type="text" class="form-control" id="phone" name="containmentCompany_principalPhone" value="<?php echo $info['containmentCompany_principalPhone'];?>">
</div>
<div class="mb-3">
    <label for="shelter_address" class="form-label">收容場所地址</label>
    <input type="text" class="form-control" id="shelter_address" name="containmentCompany_placeAddress" value="<?php echo $info['containmentCompany_placeAddress'];?>">
</div>
<div class="mb-3">
    <label for="company_address" class="form-label">收容公司地址</label>
    <input type="text" class="form-control" id="company_address" name="containmentCompany_address" value="<?php echo $info['containmentCompany_address'];?>">
</div>
<div class="d-grid gap-2 d-md-block">
    <button class="btn btn-danger" type="submit">保存</button>
    <button class="btn btn-secondary" type="button" onclick="history.back()">回上頁</button>
</div>