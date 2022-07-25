<div class="mb-3">
    <input type="text" class="form-control" id="user_id" name="user_id"  value="<?php echo $info['user_id']?>" hidden>
</div>
<div class="mb-3">
    <label for="user_email" class="form-label">使用者帳號</label>
    <input type="text" class="form-control" id="user_email" name="user_email"  value="<?php echo $info['user_email']?>" disabled>
</div>
<div class="mb-3">
    <label for="company_name" class="form-label">公司名稱</label>
    <input type="text" class="form-control" id="company_name" name="contracting_companyName" value="<?php echo $info['contracting_companyName'];?>" >
</div>
<div class="mb-3">
    <label for="company_number" class="form-label">公司統編</label>
    <input type="text" class="form-control" id="company_number" name="contracting_uniformNumbers" value="<?php echo $info['contracting_uniformNumbers'];?>" >
</div>
<div class="mb-3">
    <label for="boss_name" class="form-label">承造人姓名</label>
    <input type="text" class="form-control" id="boss_name" name="contracting_contractUserName" value="<?php echo $info['contracting_contractUserName'];?>">
</div>
<div class="mb-3">
    <label for="boss_phone" class="form-label">承造人電話</label>
    <input type="text" class="form-control" id="boss_phone" name="contracting_contractUserPhone" value="<?php echo $info['contracting_contractUserPhone'];?>">
</div>
<div class="mb-3">
    <label for="watcher_name" class="form-label">監造人姓名</label>
    <input type="text" class="form-control" id="watcher_name" name="contracting_contractWatcherName" value="<?php echo $info['contracting_contractWatcherName'];?>">
</div>
<div class="mb-3">
    <label for="watcher_phone" class="form-label">監造人電話</label>
    <input type="text" class="form-control" id="watcher_phone" name="contracting_contractWatcherPhone" value="<?php echo $info['contracting_contractWatcherPhone'];?>">
</div>
<div class="mb-3">
    <label for="company_address" class="form-label">公司地址</label>
    <input type="text" class="form-control" id="company_address" name="contracting_companyAddress" value="<?php echo $info['contracting_companyAddress'];?>">
</div>
<div class="d-grid gap-2 d-md-block">
    <button class="btn btn-danger" type="submit">保存</button>
    <button class="btn btn-secondary" type="button" onclick="history.back()">回上頁</button>
</div>