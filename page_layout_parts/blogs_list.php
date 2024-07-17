<?php $number_of_show_blogs = get_sub_field('number_of_show_blogs'); ?>

<!-- Start Blog Section -->
<div class="blog-section">
    <div class="container">

        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 mb-5">
                <div class="post-entry laschf-sort">
                    <select class="form-control" id="archive-sort">
                        <option hidden disabled selected value="default">Sort by</option>
                        <option value="date-desc">Date (Newest - Oldest)</option>
                        <option value="date-asc">Date (Oldest - Newest)</option>
                        <option value="title-asc">Title (A - Z)</option>
                        <option value="title-desc">Title (Z - A)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row" id="post-container">
            <?php
            $blog_args = array(
                'post_type'      => 'blog',
                'posts_per_page' => $number_of_show_blogs,
                'orderby'        => 'date',
                'order'          => 'ASC',
            );

            $blog_query = new WP_Query($blog_args);

            if ($blog_query->have_posts()) :

                while ($blog_query->have_posts()) : $blog_query->the_post(); ?>

                    <div class="col-12 col-sm-6 col-md-4 mb-5">
                        <div class="post-entry">
                            <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" class="img-fluid">
                                <?php else : ?>
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/no-image.jpg'; ?>" alt="Default Image" class="img-fluid">
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
            ?>
        </div>
    </div>
</div>
<!-- End Blog Section -->

<script>
    jQuery(document).ready(function($) {
        $('#archive-sort').on('change', function() {
            var sortValue = $(this).val();

            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'sort_posts',
                    orderby: sortValue
                },
                success: function(response) {
                    $('#post-container').html(response);
                }
            });
        });
    });
</script>