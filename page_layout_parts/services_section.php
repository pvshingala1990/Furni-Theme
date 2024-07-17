<!-- Start Services Section -->
<div class="why-choose-section">
    <div class="container">

        <div class="row my-5">
            <?php
            $sevices_array = get_sub_field('services_loop');
            foreach ($sevices_array as $service) :
                $service_title = $service['service_title'];
                $service_img = $service['service_icon'];
                $service_content = $service['service_short_content'];
            ?>
                <div class="col-6 col-md-6 col-lg-3 mb-4">
                    <div class="feature">
                        <div class="icon">
                            <img src="<?php echo $service_img; ?>" alt="Image" class="imf-fluid">
                        </div>
                        <h3><?php echo esc_html($service_title); ?></h3>
                        <p><?php echo esc_html($service_content); ?></p>
                    </div>
                </div>
            <?php
            endforeach;
            ?>

        </div>

    </div>
</div>
<!-- End Services Section -->