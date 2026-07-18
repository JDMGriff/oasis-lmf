<?php
$title = get_field('title');
$introCopy = get_field('intro_copy');
$mainCopy = get_field('main_copy');
?>

<section class="red-grad-bg-with-logomark py-10 lg:py-40 bg-cover bg-center bg-[var(--off-white)]">
    <div class="container mx-auto px-4">
        <div class="grid auto-rows-auto grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-20">
            <div class="flex flex-col">
                <?php if($title): ?>
                    <h3 class="title-mark-white text-white mb-6">
                        <?php echo $title ?>
                    </h3>
                <?php endif; ?>
        
                <?php if($introCopy): ?>
                    <span class="text-white text-xl">
                        <?php echo $introCopy ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Main Copy -->
            <div class="text-white text-base">
                <?php echo $mainCopy ?>
            </div>
        </div>
    </div>
</section>
