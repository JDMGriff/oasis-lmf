<?php
$showCTA = get_field('show_global_cta');
?>
<?php if($showCTA === true): ?>
    <?php include(locate_template('inc/global-cta.php')); ?>
<?php endif; ?>
