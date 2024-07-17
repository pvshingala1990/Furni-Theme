<?php $why_choose_title = get_sub_field('why_choose_title');
$why_choose_content = get_sub_field('why_choose_content');
$why_choose_services = get_sub_field('why_choose_services');

$rep_why_image = get_stylesheet_directory_uri() . '/assets/images/why-choose-us-img.jpg';
$why_choose_image = get_sub_field('why_choose_image'); ?>

<!-- Start Why Choose Us Section -->
<?php if (!empty($why_choose_title) && !empty($why_choose_content)) : ?>

    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">

                    <h2 class="section-title"><?php echo esc_html($why_choose_title); ?></h2>

                    <p><?php echo esc_html($why_choose_content); ?></p>

                    <div class="row my-5">
                        <?php if (count($why_choose_services) > 0) :

                            foreach ($why_choose_services as $service_value) :
                                $icon = $service_value['service_image_icon'];
                                $title = $service_value['service_heading'];
                                $short_content = $service_value['service_short_content']; ?>

                                <?php if (!empty($title) && !empty($icon) && !empty($short_content)) : ?>
                                    <div class="col-6 col-md-6">
                                        <div class="feature">
                                            <div class="icon">
                                                <img src="<?php echo esc_url($icon); ?>" alt="Image" class="imf-fluid">
                                            </div>
                                            <h3><?php echo esc_html($title); ?></h3>
                                            <p><?php echo esc_html($short_content); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="<?php echo !empty($why_image) ? $why_image : $rep_why_image; ?>" alt="Image" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>
<!-- End Why Choose Us Section -->