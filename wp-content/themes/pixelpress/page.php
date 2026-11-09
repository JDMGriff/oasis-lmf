<?php

get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
        <main id="main-content" class="default-page">
            <header class="default-page__header">
                <div class="container mx-auto px-4">
                    <p class="default-page__eyebrow">Oasis LMF</p>
                    <h1 class="default-page__title"><?php the_title(); ?></h1>
                </div>
            </header>

            <div class="default-page__body">
                <div class="container mx-auto px-4">
                    <article class="default-page__content">
                        <?php the_content(); ?>
                    </article>
                </div>
            </div>
        </main>
        <?php
    }
}

get_footer();
