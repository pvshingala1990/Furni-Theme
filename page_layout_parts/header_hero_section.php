<?php
$heading1 = get_sub_field('hero_heading_1');
$heading2 = get_sub_field('hero_heading_2');
$heading_tagline = get_sub_field('hero_heading_tagline');
$repeat_buttons = get_sub_field('hero_buttons');

$one_side_image = get_sub_field('hero_side_image');
$replace_side_image = get_stylesheet_directory_uri() . '/assets/images/couch.png';

$bgcolor = 'style="background:' . get_sub_field('background_color') . '"' . ';';
$bgblank = '';

?>
<!-- Start Hero Section -->
<div class="hero" <?php echo (!empty($bgcolor)) ? $bgcolor : ''; ?>>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">

                    <?php if (!empty($heading1)) : ?>
                        <h1>
                            <?php echo $heading1; ?>
                            <?php if (!empty($heading2)) : ?>
                                <span clsas="d-block"><?php echo esc_html($heading2); ?></span>
                            <?php endif; ?>
                        </h1>
                    <?php endif; ?>

                    <?php if (!empty($heading_tagline)) : ?>
                        <p class="mb-4"><?php echo esc_html($heading_tagline); ?></p>
                    <?php endif; ?>

                    <p>
                        <?php $count = 1;
                        foreach ($repeat_buttons as $repeat_button) : ?>
                            <a href="<?php echo esc_url($repeat_button['hero_repeat_button']['url']); ?>" target="<?php echo esc_url($repeat_button['hero_repeat_button']['target']); ?>" class="btn <?php echo ($count == 1) ? 'btn-secondary me-2' : 'btn-white-outline'; ?>"><?php echo esc_html($repeat_button['hero_repeat_button']['title']); ?></a>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap">
                    <img src="<?php echo (!empty($one_side_image)) ? $one_side_image : $replace_side_image; ?>" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->