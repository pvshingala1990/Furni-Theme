<?php
$help_img_1 = get_sub_field('grid_image_1');
$help_img_2 = get_sub_field('grid_image_2');
$help_img_3 = get_sub_field('grid_image_3');

//In case above image empty then By default set this images
$help_img1_replace = get_stylesheet_directory_uri() . '/assets/images/img-grid-1.jpg';
$help_img2_replace = get_stylesheet_directory_uri() . '/assets/images/img-grid-2.jpg';
$help_img3_replace = get_stylesheet_directory_uri() . '/assets/images/img-grid-3.jpg';

$help_title = get_sub_field('help_section_title');
$help_short_content = get_sub_field('help_section_short_content');

//Services help foreach loop 
$help_sevices = get_sub_field('help_sevices');

//End of box button
$help_button = get_sub_field('help_button'); ?>

<!-- Start We Help Section -->
<?php if (!empty($help_title) && !empty($help_short_content)) : ?>
    <div class="we-help-section">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="imgs-grid">
                        <div class="grid grid-1"><img src="<?php echo (!empty($help_img_1)) ? $help_img_1 : $help_img1_replace; ?>" alt="Untree.co"></div>
                        <div class="grid grid-2"><img src="<?php echo (!empty($help_img_2)) ? $help_img_2 : $help_img2_replace; ?>" alt="Untree.co"></div>
                        <div class="grid grid-3"><img src="<?php echo (!empty($help_img_3)) ? $help_img_3 : $help_img3_replace; ?>" alt="Untree.co"></div>
                    </div>
                </div>

                <?php if (count($help_sevices) > 0) : ?>
                    <div class="col-lg-5 ps-lg-5">
                        <h2 class="section-title mb-4"><?php echo esc_html($help_title); ?></h2>
                        <p><?php echo esc_html($help_short_content); ?></p>

                        <ul class="list-unstyled custom-list my-4">
                            <?php foreach ($help_sevices as $help) : ?>
                                <li><?php echo esc_html($help['help_services_name']); ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <?php if (!empty($help_button)) : ?>
                            <p><a herf="<?php echo esc_url($help_button['url']); ?>" target="<?php echo esc_url($help_button['target']); ?>" class="btn"><?php echo esc_html($help_button['title']); ?></a></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- End We Help Section -->
<?php endif; ?>