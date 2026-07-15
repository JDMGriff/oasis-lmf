<?php 
    $title = get_Field('title', 'option');
    $copy = get_Field('copy', 'option');
    $button = get_field('button', 'option');
?>
<section class="py-20">
    <div data-aos="fade-up" class="container mx-auto px-4 text-center">
        <?php if($title): ?>
            <h3 class="title-mark inline-block">
                <?php echo $title ?>
            </h3>
        <?php endif; ?>

        <?php if($copy): ?>
            <div class="text-center text-xl my-6">
                <?php echo $copy ?>
            </div>
        <?php endif; ?>

        <?php if($button): ?>
            <a class="primary-cta" href="<?php echo $button['url'] ?>">
                <?php echo $button['title'] ?>
            </a>
        <?php endif; ?>
    </div>
</section>