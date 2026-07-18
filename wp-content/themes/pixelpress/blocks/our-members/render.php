<?php
    $title = get_field('block_title');
    $introCopy = get_field('intro_copy');
    $members = get_field('members');
    $button = get_field('button');
?>

<section class="py-20 bg-[var(--off-white)]">
    <div class="container mx-aujto px-4">
        <div class="w-full flex flex-col items-start md:flex-row md:items-center justify-between">
            <div>
                <h3 class="title-mark mb-4">
                    <?php echo $title ?>
                </h3>
                <p><?php echo $introCopy ?></p>
            </div>

            <a class="text-rm text-[var(--brand-red)] font-semibold mb-6 md:mb-0" href="/events/">
                View all Members 
            </a>
        </div>

        <?php
        $members = get_field('members');

        if ($members) :
            $members = $members;
            ?>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mt-10">
                <?php foreach ($members as $member) :
                    $memberId = $member->ID;
                    $logo     = get_field('logo', $memberId);
                    $contactEmail = get_field('contact_email', $memberId);
                    ?>

                    <a
                        class="aspect-square bg-white flex items-center justify-center p-12"
                        href="mailto:<?php echo $contactEmail; ?>"
                        aria-label="<?php echo esc_attr(get_the_title($memberId)); ?>"
                    >
                        <?php if ($logo) : ?>
                            <img
                                class="w-full h-full max-h-[100px] object-contain"
                                src="<?php echo esc_url($logo['url']); ?>"
                                alt="<?php echo esc_attr($logo['alt'] ?: get_the_title($memberId)); ?>"
                            >
                        <?php endif; ?>
                    </a>

                <?php endforeach; ?>
            </div>
            
            <?php if($button): ?>
                <div class="flex items-center justify-center w-full mt-10">
                    <a class="primary-cta mx-auto" href="<?php echo esc_url($button['url']); ?>">
                        <?php echo $button['title']; ?>
                    </a>
                </div>
            <?php endif;?>

        <?php endif; ?>
    </div>
</section>
