<?php $session = \Config\Services::session(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url();?>">營建剩餘土石方憑證系統</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
        
                <?php if(session()->has('user_email')){?>
                  
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo base_url('logout')?>">
                            登出
                        </a>
                    </li>
                   
                <?php }else{?>
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            登入
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="<?php echo base_url('/') ?>">一般登入</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('register') ?>">清運司機註冊</a></li>
                        </ul>
                    </li>
                    
                <?php }?>
            </div>
        </div>
    </div>
</nav>