<?php
$title = get_field('title');
$copy = get_field('copy');
$usps = get_field('usps');
$button = get_field('button');
$bgImage = get_field('background_image');
?>

<section class="py-10 lg:py-40 bg-[var(--off-white)] bg-no-repeat relative">
    <div class="container mx-auto px-4 overflow-hidden">
        <!-- Red gradient Overlay -->
        <div class="gradient-overlay absolute left-0 top-0 inline-block z-[5] w-full h-full"></div>
        <!-- BG Image -->
        <img class="ods-bg-img absolute z-0 right-0 top-0 h-full w-auto" src="<?php echo esc_url($bgImage['url']); ?>" alt="ODS Backgorund Image">
        <!-- Content -->
        <div class="w-full lg:max-w-[50%] relative z-10">
            <?php if($title): ?>
                <h3 class="title-mark-white text-white">
                    <?php echo $title ?>
                </h3>
            <?php endif; ?>

            <?php if($copy): ?>
            <div class="text-white text-xl my-6">
                <?php echo $copy ?>
            </div>
            <?php endif; ?>

            <?php if($usps): ?>
                <div class="ods-usp-items flex justify-start mb-10">
                    <?php foreach($usps as $usp):
                        $item = $usp['item'];    
                    ?>
                        <p class="text-white text-xl">
                            <?php echo $item ?>
                        </p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if($button): ?>
                <a class="primary-cta-white" href="<?php echo $button['url']; ?>">
                    <?php echo $button['title']; ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
