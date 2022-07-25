<?php $session = \Config\Services::session(); ?>
                     <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            登入
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="<?php echo base_url('/') ?>">一般登入</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('register') ?>">清運司機註冊</a></li>
                        </ul>
                    </li> -->
                
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo base_url();?>">營建剩餘土石方憑證系統</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <?php if(session()->has('user_email') && session()->get('permission_id') == "2"){?> 
            <?= $this->include('nav_component/contract');?>
        <?php }else if(session()->has('user_email') && session()->get('permission_id') == "3"){?>
            <?= $this->include('nav_component/company');?>
        <?php }else if(session()->has('user_email') && session()->get('permission_id') == "4"){?>
            <?= $this->include('nav_component/driver');?> 
        <?php }else if(session()->has('user_email') && session()->get('permission_id') == "5"){?>
            <?= $this->include('nav_component/shelter');?>
        <?php }else if(session()->has('user_email') && session()->get('permission_id') == "6"){?>
            <?= $this->include('nav_component/government');?>
        <?php }else if(session()->has('user_email') && session()->get('permission_id') == "1"){?>
            <?= $this->include('nav_component/root');?>
        <?php }else if(session()->has('user_email')){?>
            <ul class="navbar-nav  mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo base_url('logout')?>">登出</a>
                </li>
            </ul>
        <?php }else{?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo base_url('/') ?>">一般登入</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('drverRegister') ?>">清運司機註冊</a>
                </li>
            </ul>
        <?php }?>
    </div>
  </div>
</nav>