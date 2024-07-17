<?php $test_title = get_sub_field('test_title');
$testimonial_relation = get_sub_field('testimonial_relation'); ?>

<!-- Start Testimonial Slider -->
<div class="testimonial-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center">
                <?php if (!empty($test_title)) : ?>
                    <h2 class="section-title"><?php echo esc_html($test_title); ?></h2>
                <?php endif; ?>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonial-slider-wrap text-center">

                    <div id="testimonial-nav">
                        <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                        <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                    </div>

                    <div class="testimonial-slider">
                        <?php if ($testimonial_relation) :

                            $testimonial_ids = wp_list_pluck($testimonial_relation, 'ID');

                            $test_args = array(
                                'post_type' => 'testimonial',
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                                'post__in' => $testimonial_ids,
                                'orderby' => 'post__in'
                            );

                            $testimonial_query = new WP_Query($test_args);

                            if ($testimonial_query->have_posts()) :

                                while ($testimonial_query->have_posts()) :

                                    $testimonial_query->the_post(); ?>

                                    <div class="item">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-8 mx-auto">
                                                <div class="testimonial-block text-center">
                                                    <blockquote class="mb-5"><?php the_content(); ?></blockquote>

                                                    <?php $default_img = get_stylesheet_directory_uri() . '/assets/images/testimonial_default.jpg';
                                                    $test_img = get_the_post_thumbnail_url(); ?>

                                                    <div class="author-info">
                                                        <div class="author-pic">
                                                            <img src="<?php echo (!empty($test_img) ? esc_url($test_img) : esc_url($default_img)); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid">
                                                        </div>
                                                        <h3 class="font-weight-bold"><?php the_title(); ?></h3>
                                                        <?php $profession = get_field('profession'); ?>
                                                        <span class="position d-block mb-3"><?php echo esc_html($profession); ?></span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endwhile; ?>

                            <?php else : ?>
                                <?php echo '<p>No testimonials found.</p>'; ?>
                            <?php endif; ?>

                            <?php wp_reset_postdata(); ?>

                        <?php else : ?>
                            <?php echo '<p>No testimonials selected.</p>'; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Testimonial Slider -->