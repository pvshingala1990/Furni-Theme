<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/tiny-slider.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" rel="stylesheet">
    <title><?php echo bloginfo('title'); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="<?php echo site_url(); ?>"><?php echo bloginfo('title'); ?><span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">

                    <?php
                    $menu_name = 'primary';
                    $locations = get_nav_menu_locations();
                    $menu = wp_get_nav_menu_object($locations[$menu_name]);
                    $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));
                    $this_item = current(wp_filter_object_list($menuitems, array('object_id' => get_queried_object_id())));
                    $activeids = array();
                    if ($this_item) {
                        $activeids[] = $this_item->ID;
                        $activeids[] = $this_item->menu_item_parent;
                    }
                    $menu = array();
                    foreach ($menuitems as $m) {
                        if (empty($m->menu_item_parent)) {
                            $menu[$m->ID] = array();
                            $menu[$m->ID]['ID']      =   $m->ID;
                            $menu[$m->ID]['title']       =   $m->title;
                            $menu[$m->ID]['url']         =   $m->url;
                            $menu[$m->ID]['children']    =   array();
                            $menu[$m->ID]['top']    =   1;
                        }
                    }
                    $submenu = array();
                    foreach ($menuitems as $m) {
                        if ($m->menu_item_parent) {
                            $submenu[$m->ID] = array();
                            $submenu[$m->ID]['ID']       =   $m->ID;
                            $submenu[$m->ID]['title']    =   $m->title;
                            $submenu[$m->ID]['url']  =   $m->url;
                            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
                        }
                    }
                    foreach ($menu as $key => $value) :
                        if (empty($value['children'])) : ?>
                            <li class="nav-item <?php echo (in_array($value['ID'], $activeids)) ? 'active' : ''; ?>">
                                <a href="<?php echo $value['url']; ?>" class="nav-link"><?php echo $value['title']; ?></a>
                            </li>
                        <?php else : ?>
                            <?php echo "Nothing for any submenu"; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>

                <!-- nav bar Icon links -->
                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <?php $image_icon_menus = get_field('image_icon_menu', 'option');
                    foreach ($image_icon_menus as $key => $menu_value) : ?>
                        <li>
                            <a class="nav-link" href="<?php echo $menu_value['header_menu_url']; ?>">
                                <img src="<?php echo $menu_value['header_menu_icon']; ?>">
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
               
            </div>
        </div>

    </nav>
    <!-- End Header/Navigation -->