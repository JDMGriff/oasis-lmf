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

            <a class="text-rm text-[var(--brand-red)] font-semibold mb-6 md:mb-0" href="/our-community/">
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
                    $contactName = get_field('contact_name', $memberId);
                    ?>

                    <div
                        class="aspect-square bg-white flex flex-col overflow-hidden"
                        aria-label="<?php echo esc_attr(get_the_title($memberId)); ?>"
                    >
                        <div class="w-full min-h-0 flex flex-1 items-center justify-center p-4 sm:p-8">
                            <?php if ($logo) : ?>
                                <img
                                    class="w-full h-full max-h-[100px] object-contain"
                                    src="<?php echo esc_url($logo['url']); ?>"
                                    alt="<?php echo esc_attr($logo['alt'] ?: get_the_title($memberId)); ?>"
                                >
                            <?php endif; ?>
                        </div>

                        <?php if($contactEmail): ?>
                            <div class="w-full shrink-0 border-t p-2 sm:p-4">
                                <h5 class="text-sm lg:text-lg font-semibold">
                                    <?php echo esc_html($contactName); ?>
                                </h5>

                                <a class="text-xs lg:text-sm text-[var(--brand-red)] underline" style="overflow-wrap: anywhere;" href="mailto:<?php echo esc_attr($contactEmail); ?>">
                                    <?php echo esc_html($contactEmail); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

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
