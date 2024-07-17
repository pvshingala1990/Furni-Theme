<?php $team_title = get_sub_field('team_title');
$team_relationship = get_sub_field('team_relationship'); ?>

<!-- Start Team Section -->
<div class="untree_co-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-5 mx-auto text-center">
                <?php if (!empty($team_title)) : ?>
                    <h2 class="section-title"><?php echo esc_html($team_title); ?></h2>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <?php if ($team_relationship) :

                $team_ids = wp_list_pluck($team_relationship, 'ID');

                $team_args = array(
                    'post_type' => 'team_member',
                    'post_status' => 'publish',
                    'posts_per_page' => 4,
                    'post__in' => $team_ids,
                    'orderby'=>'post__in'
                );

                $team_query = new WP_Query($team_args);

                if ($team_query->have_posts()) :
                    while ($team_query->have_posts()) :
                        $team_query->the_post(); ?>

                        <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">

                            <?php $default_img = get_stylesheet_directory_uri() . '/assets/images/person_default.jpg';
                            $team_img = get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>

                            <img src="<?php echo (!empty($team_img) ? esc_url($team_img) : esc_url($default_img)); ?>" class="img-fluid mb-5" alt="<?php the_title_attribute(); ?>">

                            <h3><a href="<?php the_permalink(); ?>"><span class=""><?php the_title(); ?></span></a></h3>

                            <?php $position = get_field('position'); ?>

                            <span class="d-block position mb-4"><?php echo esc_html($position); ?></span>

                            <p><?php the_excerpt(); ?></p>

                            <p class="mb-0"><a href="<?php the_permalink(); ?>" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>

                        </div>

                    <?php endwhile; ?>

                <?php else : ?>
                    <?php echo '<p>No team members found.</p>'; ?>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <?php echo '<p>No team members selected.</p>'; ?>
            <?php endif; ?>

        </div>
    </div>
</div>
<!-- End Team Section -->