<?php

use Automattic\Jetpack\Import\Endpoints\End;

get_header(); ?>

<!-- Start Blog Section -->
<div class="blog-section">
    <div class="container">

        <div class="row">
            <?php $blog_args = array(
                'post_type'      => 'blog',
                'posts_per_page' => 2,
                'orderby'        => 'date',
                'order'          => 'ASC',
            );

            $blog_query = new WP_Query($blog_args);

            if ($blog_query->have_posts()) :

                while ($blog_query->have_posts()) :
                    $blog_query->the_post(); ?>

                    <div class="col-12 col-sm-6 col-md-4 mb-5">

                        <div class="post-entry">

                            <a href="<?php the_permalink(); ?>" class="post-thumbnail">

                                <?php if (has_post_thumbnail()) : ?>

                                    <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" class="img-fluid">

                                <?php $default_img = get_stylesheet_directory_uri() . '/assets/images/no-image.jpg';
                                else : ?>

                                    <img src="<?php echo $default_img; ?>" alt="Default Image" class="img-fluid">

                                <?php endif; ?>
                            </a>

                            <div class="post-content-entry">

                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                <div class="meta">

                                    <span>by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>

                                    <span>on <a href="<?php echo get_day_link(get_the_date('Y'), get_the_date('m'), get_the_date('d')); ?>"><?php echo get_the_date(); ?></a></span>

                                </div>

                            </div>

                        </div>

                    </div>
            <?php endwhile;

                wp_reset_postdata();

            else :

                echo '<p>No blog posts found.</p>';

            endif;

            wp_reset_query(); ?>
            
        </div>
    </div>
</div>
<!-- End Blog Section -->

<?php
get_footer();
?>