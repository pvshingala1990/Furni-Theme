<?php $prd_part_title = get_sub_field('prd_part_title');
$prd_part_content = get_sub_field('prd_part_content');
$prd_part_button = get_sub_field('prd_part_button'); ?>

<!-- Start Product Section -->
<?php if (!empty($prd_part_title) && !empty($prd_part_content)) : ?>
    <div class="product-section">

        <div class="container">

            <div class="row">

                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">

                    <h2 class="mb-4 section-title"><?php echo esc_html($prd_part_title); ?></h2>

                    <p class="mb-4"><?php echo esc_html($prd_part_content); ?></p>

                    <?php if (!empty($prd_part_button)) : ?>
                        <p><a href="<?php echo esc_url($prd_part_button['url']) ?>" target="<?php echo $prd_part_button['target']; ?>" class="btn"><?php echo esc_html($prd_part_button['title']); ?></a></p>
                    <?php endif; ?>

                </div>

                <?php $prd_args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 3,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );

                $loop = new WP_Query($prd_args);

                if ($loop->have_posts()) :

                    while ($loop->have_posts()) : $loop->the_post();

                        global $product; ?>

                        <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">

                            <a class="product-item" href="<?php echo get_permalink(); ?>">

                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('full'); ?>" class="img-fluid product-thumbnail" alt="<?php the_title(); ?>">
                                <?php else : ?>
                                    <img src="<?php echo wc_placeholder_img_src(); ?>" class="img-fluid product-thumbnail" alt="<?php the_title(); ?>">
                                <?php endif; ?>

                                <h3 class="product-title"><?php the_title(); ?></h3>

                                <strong class="product-price"><?php echo $product->get_price_html(); ?></strong>

                                <span class="icon-cross">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/cross.svg" class="img-fluid" alt="Cross Icon">
                                </span>

                            </a>

                        </div>
                    <?php endwhile;

                    wp_reset_postdata();

                else : ?>

                    <p><?php esc_html_e('No products found'); ?></p>

                <?php endif; ?>

            </div>

        </div>

    </div>
<?php endif; ?>