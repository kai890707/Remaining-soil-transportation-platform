<div class="mb-3">
    <input type="text" class="form-control" id="user_id" name="user_id"  value="<?php echo $info['user_id']?>" hidden>
</div>
<div class="mb-3">
    <label for="user_email" class="form-label">使用者帳號</label>
    <input type="text" class="form-control" id="user_email" name="user_email"  value="<?php echo $info['user_email']?>" disabled>
</div>
<div class="mb-3">
    <label for="new_password" class="form-label">輸入欲修改之密碼</label>
    <input type="password" class="form-control" id="new_password" name="new_password"  value="">
</div>
<div class="mb-3">
    <label for="re_password" class="form-label">再次輸入欲修改之密碼</label>
    <input type="password" class="form-control" id="re_password" name="re_password"  value="">
</div>
<div class="mb-3">
    <label for="user_password" class="form-label">輸入舊密碼</label>
    <input type="password" class="form-control" id="user_password" name="user_password"  value="">
</div>
<div class="d-grid gap-2 d-md-block">
    <button class="btn btn-danger" type="submit">保存</button>
    <button class="btn btn-secondary" type="button" onclick="history.back()">回上頁</button>
</div>