<?php
    $title = get_field('block_title');
    $introCopy = get_field('intro_copy');
    $members = get_field('members');
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
            $members = array_slice($members, 0, 12);
            ?>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mt-10">
                <?php foreach ($members as $member) :
                    $memberId = $member->ID;
                    $logo     = get_field('logo', $memberId);
                    ?>

                    <a
                        class="aspect-square bg-white flex items-center justify-center p-6"
                        href="<?php echo esc_url(get_permalink($memberId)); ?>"
                        aria-label="<?php echo esc_attr(get_the_title($memberId)); ?>"
                    >
                        <?php if ($logo) : ?>
                            <img
                                class="w-full h-full object-contain"
                                src="<?php echo esc_url($logo['url']); ?>"
                                alt="<?php echo esc_attr($logo['alt'] ?: get_the_title($memberId)); ?>"
                            >
                        <?php endif; ?>
                    </a>

                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    </div>
</section>
