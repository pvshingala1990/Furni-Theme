<?php $recent_blog_title = get_sub_field('recent_blog_title');
$recent_all_blog_link = get_sub_field('recent_all_blog_link'); ?>
<?php
$response = file_get_contents(get_stylesheet_directory_uri() . '/posts.json');
$posts = json_decode($response, true);

echo '<pre>';
print_r($posts);
echo '</pre>';

?>
<!-- Start Blog Section -->
<div class="blog-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6">
                <?php if (!empty($recent_blog_title)) : ?>
                    <h2 class="section-title"><?php echo esc_html($recent_blog_title); ?></h2>
                <?php endif; ?>
            </div>
            <div class="col-md-6 text-start text-md-end">
                <?php if (!empty($recent_all_blog_link)) : ?>
                    <a href="<?php echo esc_url($recent_all_blog_link['url']) ?>" target="<?php echo esc_url($recent_all_blog_link['target']) ?>" class="more"><?php echo esc_html($recent_all_blog_link['title']) ?></a>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">

            <?php $args = array(
                'post_type'      => 'blog',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
            );

            $blog_query = new WP_Query($args);

            if ($blog_query->have_posts()) :

                while ($blog_query->have_posts()) :

                    $blog_query->the_post(); ?>

                    <div class="col-12 col-sm-6 col-md-4 mb-5">
                        <div class="post-entry">
                            <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                <?php if (has_post_thumbnail()) : ?>

                                    <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" class="img-fluid">

                                <?php else :

                                    $default_img = get_stylesheet_directory_uri() . '/assets/images/no-image.jpg'; ?>

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
                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <?php echo '<p>No blog posts found.</p>'; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- End Blog Section -->