<div class="mb-3">
    <label for="government_name" class="form-label">單位名稱</label>
    <input type="text" class="form-control" id="government_name" name="government_name" value="<?php echo $info['government_name'];?>" >
</div>
<div class="mb-3">
    <label for="government_principalName" class="form-label">單位負責人</label>
    <input type="text" class="form-control" id="government_principalName" name="government_principalName"  value="<?php echo $info['government_principalName'];?>" >
</div>
<div class="mb-3">
    <label for="government_principalPhone" class="form-label">單位電話</label>
    <input type="text" class="form-control" id="government_principalPhone" name="government_principalPhone"  value="<?php echo $info['government_principalPhone'];?>" >
</div>
<div class="mb-3">
    <label for="government_address" class="form-label">單位地址</label>
    <input type="text" class="form-control" id="government_address" name="government_address"  value="<?php echo $info['government_address'];?>" >
</div>
<div class="d-grid gap-2 d-md-block">
    <button class="btn btn-danger" type="submit">保存</button>
    <button class="btn btn-secondary" type="button" onclick="history.back()">回上頁</button>
</div>