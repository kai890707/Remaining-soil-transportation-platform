<?php $session = \Config\Services::session(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url();?>">營建剩餘土石方憑證系統</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('contract/companyInfoView')?>">公司資訊</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('project/projectList')?>">聯單使用</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('contract/personalView')?>">個人資訊</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('contract/personalView')?>">QR Code簽核</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">車籍資訊</a>
                </li>

            </div>
        </div>
    </div>
</nav>