<?php
$blockTitle = get_field('block_title');
$faqs = get_field('faqs');
?>
<?php if($faqs): ?>
    <section class="py-10 lg:py-40 bg-[var(--off-white)]">
        <div class="container mx-auto px-4">
            <div data-aos="fade-up" class="">
                <!-- Block Title -->
                <?php if ($blockTitle) { ?>
                    <h3 class="title-mark uppercase mb-6">
                        <?php echo $blockTitle; ?>
                    </h3>
                <?php } ?>
                
                <?php foreach($faqs as $index => $faq):
                    $question = $faq['question'];
                    $answer = $faq['answer'];
                ?>
                    <details class="faq-item group mb-1 rounded-[4px]" <?php echo $index === 0 ? 'open' : ''; ?>>
                        <summary class="relative flex items-center justify-between gap-4 p-6 cursor-pointer list-none bg-white rounded-md overflow-hidden">
                            <span class="absolute inset-0 red-grad-bg opacity-0 group-open:opacity-100 transition-opacity duration-300 ease-in-out"></span>

                            <span class="relative font-semibold text-[var(--off-black)] group-open:text-white text-2xl font-['Poppins',sans-serif] transition-colors duration-300 ease-in-out">
                                <span class="text-base mr-2 text-[var(--brand-red)] group-open:text-white transition-colors duration-300 ease-in-out">
                                    <?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?>
                                </span>
                                <?php echo $question; ?>
                            </span>

                            <span class="relative text-xl group-open:hidden text-[var(--off-black)]">+</span>
                            <span class="relative text-xl hidden group-open:inline text-white">−</span>
                        </summary>

                        <div class="faq-answer">
                            <div class="faq-answer-inner px-4 pb-4 text-lg pt-4 mb-6">
                                <?php echo $answer; ?>
                            </div>
                        </div>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
