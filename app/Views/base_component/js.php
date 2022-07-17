<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/baseLib.js'); ?>"></script>

<script>
    // PWA Service-work
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('<?php echo base_url('/service-worker.js') ?>')
            .then(reg => console.log('SW registered!', reg))
            .catch(err => console.log('Error!', err));
    }

    //init baseLib

    BaseLib.initLib('<?php echo base_url()?>');
</script>