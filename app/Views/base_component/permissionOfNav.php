
<?php if(session()->get('permission_id')=="1"){?>
    <li class="nav-item">
        <a class="nav-link " href="<?php echo base_url('accountLobby')?>" >
            帳號創建
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="<?php echo base_url('logout')?>" >
            帳號管理
        </a>
    </li>
<?php}else if(session()->get('permission_id')=="2"){?>
<?php}else if(session()->get('permission_id')=="3"){?>
<?php}else if(session()->get('permission_id')=="4"){?>
<?php}else if(session()->get('permission_id')=="5"){?>
<?php}else if(session()->get('permission_id')=="6"){?>
<?php}?>