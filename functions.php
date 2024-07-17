<?php
// Enqueue parent theme stylesheet

//Remove the parent theme styles and css files
function child_enqueue_styles()
{
    // dequeue the Twenty Twenty-One parent style
    wp_dequeue_style('twenty-twenty-one-style');
    wp_enqueue_style('child-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'child_enqueue_styles', 11);

/* 
define the path for custom-script.js
 */
function enqueue_custom_scripts()
{
    wp_enqueue_script('custom-ajax-script', get_stylesheet_directory_uri() . '/assets/js/custom-script.js', array('jquery'), null, true);
    wp_localize_script('custom-ajax-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');




//function to add custom nav menu in Navigation Bar and Footer Bar:
function add_nav_menus()
{
    register_nav_menus(array(
        'footer_col_1' => 'Footer Col 1',
        'footer_col_2' => 'Footer Col 2',
        'footer_col_3' => 'Footer Col 3',
    ));
}
add_action('init', 'add_nav_menus');


// Acf theme option create a page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme information Settings',
        'menu_title'    => 'Information',
        'parent_slug'   => 'theme-general-settings',
    ));
}

// Allow SVG file uploads in ACF
function acf_svg_mime_types($mime_types)
{
    $mime_types['svg'] = 'image/svg+xml';
    $mime_types['svgz'] = 'image/svg+xml';
    return $mime_types;
}
add_filter('upload_mimes', 'acf_svg_mime_types');

// Custom Register testimonial post type
function register_testimonial_post_type()
{
    $args = array(
        'labels' => array(
            'name' => __('Testimonials'),
            'singular_name' => __('Testimonial')
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail')
    );
    register_post_type('testimonial', $args);
}
add_action('init', 'register_testimonial_post_type');

//Custom post type for Team Members
function create_custom_post_type()
{
    register_post_type(
        'team_member',
        array(
            'labels' => array(
                'name' => __('Team Members'),
                'singular_name' => __('Team Member')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'team-members'),
            'supports' => array('title', 'editor', 'thumbnail')
        )
    );
}
add_action('init', 'create_custom_post_type');


function create_blog_custom_post_type()
{
    $labels = array(
        'name'                  => _x('Blogs', 'Post Type General Name', 'text-domain'),
        'singular_name'         => _x('Blog', 'Post Type Singular Name', 'text-domain'),
        'menu_name'             => __('Blogs', 'text-domain'),
        'name_admin_bar'        => __('Blog', 'text-domain'),
        'archives'              => __('Blog Archives', 'text-domain'),
        'attributes'            => __('Blog Attributes', 'text-domain'),
        'parent_item_colon'     => __('Parent Blog:', 'text-domain'),
        'all_items'             => __('All Blogs', 'text-domain'),
        'add_new_item'          => __('Add New Blog', 'text-domain'),
        'add_new'               => __('Add New', 'text-domain'),
        'new_item'              => __('New Blog', 'text-domain'),
        'edit_item'             => __('Edit Blog', 'text-domain'),
        'update_item'           => __('Update Blog', 'text-domain'),
        'view_item'             => __('View Blog', 'text-domain'),
        'view_items'            => __('View Blogs', 'text-domain'),
        'search_items'          => __('Search Blog', 'text-domain'),
        'not_found'             => __('Not found', 'text-domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text-domain'),
        'featured_image'        => __('Featured Image', 'text-domain'),
        'set_featured_image'    => __('Set featured image', 'text-domain'),
        'remove_featured_image' => __('Remove featured image', 'text-domain'),
        'use_featured_image'    => __('Use as featured image', 'text-domain'),
        'insert_into_item'      => __('Insert into blog', 'text-domain'),
        'uploaded_to_this_item' => __('Uploaded to this blog', 'text-domain'),
        'items_list'            => __('Blogs list', 'text-domain'),
        'items_list_navigation' => __('Blogs list navigation', 'text-domain'),
        'filter_items_list'     => __('Filter blogs list', 'text-domain'),
    );

    $args = array(
        'label'                 => __('Blog', 'text-domain'),
        'description'           => __('A custom post type for blogs', 'text-domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'comments', 'revisions'),
        'taxonomies'            => array('category', 'post_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-post',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );

    register_post_type('blog', $args);
}

add_action('init', 'create_blog_custom_post_type');



add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
    add_theme_support('woocommerce');
}



/**
 * Content Wrappers.
 *
 * @see woocommerce_output_content_wrapper()
 * @see woocommerce_output_content_wrapper_end()
 */
add_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
add_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);



add_action('init', function () {
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


    // add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 10 );
    add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 5);
});





if (!function_exists('woocommerce_get_product_thumbnail')) {

    /**
     * Get the product thumbnail, or the placeholder if not set.
     *
     * @param string $size (default: 'woocommerce_thumbnail').
     * @param  array  $attr Image attributes.
     * @param  bool   $placeholder True to return $placeholder if no image is found, or false to return an empty string.
     * @return string
     */
    function woocommerce_get_product_thumbnail($size = 'full', $attr = array(), $placeholder = true)
    {
        global $product;

        if (!is_array($attr)) {
            $attr = array();
        }

        if (!is_bool($placeholder)) {
            $placeholder = true;
        }

        $attr['class'] = 'img-fluid product-thumbnail';

        $image_size = apply_filters('single_product_archive_thumbnail_size', $size);

        return $product ? $product->get_image($image_size, $attr, $placeholder) : '';
    }
}



if (!function_exists('woocommerce_template_loop_product_link_open')) {
    /**
     * Insert the opening anchor tag for products in the loop.
     */
    function woocommerce_template_loop_product_link_open()
    {
        global $product;

        $link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);

        echo '<a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link product-item">';
    }
}


if (!function_exists('woocommerce_template_loop_product_title')) {

    /**
     * Show the product title in the product loop. By default this is an H2.
     */
    function woocommerce_template_loop_product_title()
    {
        echo '<h3 class="product-title ' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title')) . '">' . get_the_title() . '</h3>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}

/* 
change the dropdown value sort blog post ajax call
 */

function sort_posts_ajax_handler()
{
    $orderby = $_POST['orderby'];

    // Default query args
    $args = array(
        'post_type' => 'blog',
        'posts_per_page' => get_sub_field('number_of_show_blogs'),
    );

    // Modify query based on orderby value
    switch ($orderby) {
        case 'date-asc':
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
            break;
        case 'date-desc':
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
        case 'title-asc':
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
            break;
        case 'title-desc':
            $args['orderby'] = 'title';
            $args['order'] = 'DESC';
            break;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
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

    wp_die();
}
add_action('wp_ajax_sort_posts', 'sort_posts_ajax_handler');
add_action('wp_ajax_nopriv_sort_posts', 'sort_posts_ajax_handler');
