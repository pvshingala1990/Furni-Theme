<?php
get_header();
if (have_posts()) {
    while (have_posts()) {
        the_post();

        if (have_rows('page_layouts')) {
            while (have_rows('page_layouts')) {
                the_row();
                $layout = get_row_layout();
                get_template_part('page_layout_parts/' . $layout);
            }
        }
?>
        <div class="untree_co-section">
            <div class="container">
                <?php the_content(); ?>
            </div>
        </div>
<?php

    }
}
//footer Part
get_footer();
?>