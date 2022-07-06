<?= $this->include('base_component/header') ?>
<?= $this->include('base_component/css') ?>
<?= $this->renderSection('customCss') ?>
<?= $this->renderSection('main') ?>
<?= $this->renderSection('customJs') ?>
<?= $this->include('base_component/js') ?>
<?= $this->include('base_component/footer') ?>