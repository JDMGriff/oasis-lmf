<?php
    $blockTitle = get_field('block_title');
    $blockEyebrow = get_field('block_eyebrow_sub_title');
    $latestCaseStudies = get_field('latest_case_studies');
?>
<section class="latest-blogs py-10 lg:py-40 bg-white">
    <div class="container mx-auto px-4">
        <?php if($blockTitle): ?>
            <div class="w-full flex flex-col items-start md:flex-row md:items-center justify-between">
                <div>
                    <?php if ($blockEyebrow): ?>
                        <p class="title-mark-red">
                            <?php echo $blockEyebrow; ?>
                        </p>
                    <?php endif; ?>
                    <h3 class="mb-4">
                        <?php echo $blockTitle ?>
                    </h3>
                </div>

                <a class="text-rm text-[var(--brand-red)] font-semibold mb-6 md:mb-0" href="/case-studies/">
                    View all Case Studies 
                </a>
            </div>
        <?php endif; ?>

        <!-- Case Study Loop -->
        <?php if($latestCaseStudies): ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <?php foreach ($latestCaseStudies as $caseStudy):
                    $caseStudyId = $caseStudy->ID;
                    $date = get_field('date', $caseStudyId);
                    $perils = get_field('perils', $caseStudyId);
                    $company = get_field('company', $caseStudyId);
                ?>      
                    <article class="flex flex-col h-full">
                        <a href="<?php echo get_permalink($caseStudyId); ?>">
                            <?php echo get_the_post_thumbnail($caseStudyId, 'full', ['class' => 'w-full']); ?>
                        </a>

                        <div>
                            <div class="text-xs text-white bg-[var(--brand-red)] rounded-full px-2 py-1 inline-block mt-4 font-semibold">
                                <?php echo $date; ?>
                            </div>                        
                        </div>

                        <h5 class="text-xl font-semibold mt-3 mb-2"><?php echo get_the_title($caseStudyId); ?></h5>

                        <p class="mb-4">
                            <?php echo wp_trim_words(get_the_excerpt($caseStudyId), 25, '...'); ?>
                        </p>

                        <a class="latest-blogs-rm mt-auto font-medium inline-block w-max pb-1 border-b border-[var(--brand-red)]" href="<?php echo get_permalink($caseStudyId); ?>">
                            Read More
                        </a>
                    </article> 
                <?php endforeach; ?>  
            </div>
        <?php endif; ?>
    </div>
</section>
