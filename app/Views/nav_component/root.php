<ul class="navbar-nav me-auto mb-2 mb-lg-0">
     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="<?php echo base_url('root/accountLobby')?>" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            帳號創建
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="<?php echo base_url('register/2')?>">承造公司身分創建</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('register/3')?>">清運公司身分創建</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('register/4')?>">清運司機身分創建</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('register/5')?>">收容場所身分創建</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url('register/6')?>">政府單位身分創建</a></li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('root/accountManage')?>">帳號管理</a>
    </li>
</ul>
<ul class="navbar-nav  mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link " href="<?php echo base_url('logout')?>">登出</a>
    </li>
</ul>