<?php
$footer_part_rep_img = get_stylesheet_directory_uri() . '/assets/images/sofa.png';
$footer_part_img = get_field('footer_startup_image', 'option');

$news_headline = get_field('newsletter_headline', 'option');
$news_icon = get_field('newsletter_image_icon', 'option');
$rep_news_icon = get_stylesheet_directory_uri() . '/assets/images/envelope-outline.svg';

$footer_short = get_field('footer_short_note', 'option');

$footer_copy_right = get_field('footer_copy_right', 'option');
?>

<!-- Start Footer Section -->
<footer class="footer-section">
    <div class="container relative">

        <div class="sofa-img">
            <img src="<?php echo (!empty($footer_part_img)) ? $footer_part_img : $footer_part_rep_img; ?>" alt="Image" class="img-fluid">
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="subscription-form">

                    <h3 class="d-flex align-items-center">
                        <span class="me-1"><img src="<?php echo (!empty($news_icon)) ? $news_icon : $rep_news_icon; ?>" alt="Image" class="img-fluid"></span>
                        <span><?php echo esc_html($news_headline); ?></span>
                    </h3>

                    <?php /* Newsletter form static now */ ?>
                    <form action="#" class="row g-3">
                        <div class="col-auto">
                            <input type="text" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="col-auto">
                            <input type="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary">
                                <span class="fa fa-paper-plane"></span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="row g-5 mb-5">
            <div class="col-lg-4">

                <div class="mb-4 footer-logo-wrap"><a href="<?php echo site_url(); ?>" class="footer-logo"><?php echo bloginfo('site_title'); ?></a></div>

                <?php if (!empty($footer_short)) : ?>
                    <p class="mb-4"><?php echo esc_html($footer_short); ?></p>
                <?php endif; ?>

                <ul class="list-unstyled custom-social">

                    <?php $ftr_link_facebook = get_field('ftr_link_facebook', 'option');
                    $ftr_link_twitter = get_field('ftr_link_twitter', 'option');
                    $ftr_link_instagram = get_field('ftr_link_instagram', 'option');
                    $ftr_link_linkedin = get_field('ftr_link_linkedin', 'option'); ?>

                    <?php if (!empty($ftr_link_facebook)) : ?>
                        <li><a href="<?php echo esc_url($ftr_link_facebook); ?>"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                    <?php endif; ?>

                    <?php if (!empty($ftr_link_twitter)) : ?>
                        <li><a href="<?php echo esc_url($ftr_link_twitter); ?>"><span class="fa fa-brands fa-twitter"></span></a></li>
                    <?php endif; ?>

                    <?php if (!empty($ftr_link_instagram)) : ?>
                        <li><a href="<?php echo esc_url($ftr_link_instagram); ?>"><span class="fa fa-brands fa-instagram"></span></a></li>
                    <?php endif; ?>

                    <?php if (!empty($ftr_link_linkedin)) : ?>
                        <li><a href="<?php echo esc_url($ftr_link_linkedin); ?>"><span class="fa fa-brands fa-linkedin"></span></a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="col-lg-8">
                <div class="row links-wrap">
                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <?php $footermenu = 'footer';
                            $locationmenu = get_nav_menu_locations();
                            $menuftr = wp_get_nav_menu_object($locationmenu[$footermenu]);
                            $menuitemftr = wp_get_nav_menu_items($menuftr->term_id, array('order' => 'DESC')); ?>

                            <ul class="list-unstyled">
                                <?php foreach ($menuitemftr as $key => $valueftr) : ?>
                                    <li><a href="<?php echo $valueftr->url; ?>"><?php echo $valueftr->title; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <?php $footer_col_1 = 'footer_col_1';
                        $location_1 = get_nav_menu_locations();
                        $menu_1 = wp_get_nav_menu_object($location_1[$footer_col_1]);
                        $menuitem1 = wp_get_nav_menu_items($menu_1->term_id, array('order' => 'DESC')); ?>

                        <ul class="list-unstyled">
                            <?php foreach ($menuitem1 as $key => $value_col_1) : ?>
                                <li><a href="<?php echo $value_col_1->url; ?>"><?php echo $value_col_1->title; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <?php $footer_col_2 = 'footer_col_2';
                        $location_2 = get_nav_menu_locations();
                        $menu_2 = wp_get_nav_menu_object($location_2[$footer_col_2]);
                        $menuitem2 = wp_get_nav_menu_items($menu_2->term_id, array('order' => 'DESC')); ?>

                        <ul class="list-unstyled">
                            <?php foreach ($menuitem2 as $key => $value_col_2) : ?>
                                <li><a href="<?php echo $value_col_2->url; ?>"><?php echo $value_col_2->title; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <?php $p_cat_args = array(
                                'taxonomy'   => 'product_cat',
                                'orderby'    => 'name',
                                'order'      => 'ASC',
                                'hide_empty' => false,
                            );
                            $product_categories = get_terms($p_cat_args);
                            $uncategorized_id = get_option('default_product_cat');

                            if (!empty($product_categories) && !is_wp_error($product_categories)) :
                                foreach ($product_categories as $category) :
                                    if ($category->term_id == $uncategorized_id) :
                                        continue;
                                    endif;
                                    echo '<li><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a></li>';
                                endforeach;
                            else :
                                echo '<li>No categories found.</li>';
                            endif; ?>
                        </ul>

                    </div>

                </div>
            </div>
        </div>

        <div class="border-top copyright">
            <div class="row pt-4">

                <div class="col-lg-6">
                    <?php if (!empty($footer_copy_right)) : ?>
                        <p class="mb-2 text-center text-lg-start"><?php echo $footer_copy_right; ?><!-- License information: https://untree.co/license/ --></p>
                    <?php endif; ?>
                </div>

                <div class="col-lg-6 text-center text-lg-end">
                    <ul class="list-unstyled d-inline-flex ms-auto">
                        <?php $footer_links = get_field('footer_url_link', 'option');
                        $ftrcounter = 1;
                        foreach ($footer_links as $link_value) :
                            $label_link = $link_value['label_link']; ?>

                            <li class="<?php echo ($ftrcounter == 1) ? 'me-4' : ''; ?>"><a href="<?php echo esc_url($label_link['url']); ?>" target="<?php echo $label_link['target']; ?>"><?php echo esc_html($label_link['title']); ?></a></li>

                            <?php $ftrcounter++; ?>
                        <?php endforeach; ?>

                    </ul>
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- End Footer Section -->

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/tiny-slider.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/custom.js"></script>
<?php wp_footer(); ?>
</body>

</html>