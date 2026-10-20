<?php
    $title = get_field('block_title');
    $introCopy = get_field('intro_copy');
    $selectedMembers = get_field('members');
    $button = get_field('button');

    $memberPostType = 'member';
    $selectedMemberIds = [];
    if (is_array($selectedMembers) && !empty($selectedMembers)) {
        $selectedMemberIds = array_values(array_filter(array_map(
            static fn($member) => (int) (is_object($member) ? $member->ID : $member),
            $selectedMembers
        )));
        $firstMember = reset($selectedMembers);
        $memberPostType = get_post_type(is_object($firstMember) ? $firstMember->ID : $firstMember) ?: $memberPostType;
    } elseif (!post_type_exists($memberPostType)) {
        foreach (get_post_types([], 'objects') as $postType) {
            if (strtolower((string) $postType->label) === 'members') {
                $memberPostType = $postType->name;
                break;
            }
        }
    }

    $dialogTitleId = 'member-contact-title-' . sanitize_html_class($block['id'] ?? uniqid());

    $memberQuery = [
        'post_type'      => $memberPostType,
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ];

    if ($selectedMemberIds) {
        $memberQuery['post__in'] = $selectedMemberIds;
        $memberQuery['orderby'] = 'post__in';
        unset($memberQuery['order']);
    }

    $members = get_posts($memberQuery);
?>

<section class="py-20 bg-[var(--off-white)]">
    <div class="container mx-auto px-4">
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

        <?php if ($members) : ?>

            <div class="logo-card-grid grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 mt-10">
                <?php foreach ($members as $member) :
                    $memberId = $member->ID;
                    $memberSlug = sanitize_html_class($member->post_name ?: sanitize_title($member->post_title));
                    $logo     = get_field('logo', $memberId);
                    $contactEmail = get_field('contact_email', $memberId);
                    $contactName = get_field('contact_name', $memberId);
                    ?>

                    <?php if ($contactEmail) : ?>
                        <button
                            class="logo-card logo-card--<?php echo esc_attr($memberSlug); ?> member-contact-trigger"
                            type="button"
                            data-member-name="<?php echo esc_attr(get_the_title($memberId)); ?>"
                            data-contact-name="<?php echo esc_attr($contactName); ?>"
                            data-contact-email="<?php echo esc_attr($contactEmail); ?>"
                            aria-label="Contact <?php echo esc_attr(get_the_title($memberId)); ?>"
                        >
                    <?php else : ?>
                        <div class="logo-card logo-card--<?php echo esc_attr($memberSlug); ?>" aria-label="<?php echo esc_attr(get_the_title($memberId)); ?>">
                    <?php endif; ?>
                        <span class="logo-card__image">
                            <?php if ($logo) : ?>
                                <img
                                    class="logo-card__logo"
                                    src="<?php echo esc_url($logo['url']); ?>"
                                    alt="<?php echo esc_attr($logo['alt'] ?: get_the_title($memberId)); ?>"
                                >
                            <?php endif; ?>
                        </span>
                    <?php echo $contactEmail ? '</button>' : '</div>'; ?>

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

<dialog class="member-contact-dialog" aria-labelledby="<?php echo esc_attr($dialogTitleId); ?>">
    <button class="member-contact-dialog__close" type="button" aria-label="Close contact details">&times;</button>
    <p class="text-sm font-semibold uppercase tracking-wide text-[var(--brand-red)] mb-2">Member contact</p>
    <h4 id="<?php echo esc_attr($dialogTitleId); ?>" class="member-contact-dialog__member mb-5"></h4>
    <p class="member-contact-dialog__name font-semibold"></p>
    <a class="member-contact-dialog__email" href=""></a>
    <div class="flex flex-wrap gap-3 mt-6">
        <a class="primary-cta member-contact-dialog__send" href="">Send email</a>
        <button class="member-contact-dialog__copy" type="button">Copy address</button>
    </div>
</dialog>
