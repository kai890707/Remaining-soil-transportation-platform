<?= $this->include('base_component/header') ?>
<?= $this->include('base_component/css') ?>
<?= $this->renderSection('customCss') ?>
<?= $this->include('base_component/nav') ?>
<?= $this->renderSection('main') ?>
<?= $this->include('base_component/js') ?>
<?= $this->renderSection('customJs') ?>
<?= $this->include('base_component/footer') ?>