<?php
// Enqueue jQuery from a CDN
function my_enqueue_scripts() {
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css', array(), null );
    wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null, true );
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js', array(), null, true );
    
    // Enqueue the index.js file from the assets folder
    wp_enqueue_script( 'my-script', get_template_directory_uri() . '/js/index.js', array( 'jquery' ), null, true );
    wp_localize_script( 'my-script', 'my_ajax_obj', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

}
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts' );


// Register Custom Post Type Project
function create_project_cpt() {

	$labels = array(
		'name' => _x( 'Projects', 'Post Type General Name', 'test' ),
		'singular_name' => _x( 'Project', 'Post Type Singular Name', 'test' ),
		'menu_name' => _x( 'Projects', 'Admin Menu text', 'test' ),
		'name_admin_bar' => _x( 'Project', 'Add New on Toolbar', 'test' ),
		'archives' => __( 'Project Archives', 'test' ),
		'attributes' => __( 'Project Attributes', 'test' ),
		'parent_item_colon' => __( 'Parent Project:', 'test' ),
		'all_items' => __( 'All Projects', 'test' ),
		'add_new_item' => __( 'Add New Project', 'test' ),
		'add_new' => __( 'Add New', 'test' ),
		'new_item' => __( 'New Project', 'test' ),
		'edit_item' => __( 'Edit Project', 'test' ),
		'update_item' => __( 'Update Project', 'test' ),
		'view_item' => __( 'View Project', 'test' ),
		'view_items' => __( 'View Projects', 'test' ),
		'search_items' => __( 'Search Project', 'test' ),
		'not_found' => __( 'Not found', 'test' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'test' ),
		'featured_image' => __( 'Featured Image', 'test' ),
		'set_featured_image' => __( 'Set featured image', 'test' ),
		'remove_featured_image' => __( 'Remove featured image', 'test' ),
		'use_featured_image' => __( 'Use as featured image', 'test' ),
		'insert_into_item' => __( 'Insert into Project', 'test' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Project', 'test' ),
		'items_list' => __( 'Projects list', 'test' ),
		'items_list_navigation' => __( 'Projects list navigation', 'test' ),
		'filter_items_list' => __( 'Filter Projects list', 'test' ),
	);
	$args = array(
		'label' => __( 'Project', 'test' ),
		'description' => __( 'Projects for Test', 'test' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-admin-site',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'project', $args );

}
add_action( 'init', 'create_project_cpt', 0 );

// Register Taxonomy Project Type
function create_projecttype_tax() {

	$labels = array(
		'name'              => _x( 'Project Types', 'taxonomy general name', 'test' ),
		'singular_name'     => _x( 'Project Type', 'taxonomy singular name', 'test' ),
		'search_items'      => __( 'Search Project Types', 'test' ),
		'all_items'         => __( 'All Project Types', 'test' ),
		'parent_item'       => __( 'Parent Project Type', 'test' ),
		'parent_item_colon' => __( 'Parent Project Type:', 'test' ),
		'edit_item'         => __( 'Edit Project Type', 'test' ),
		'update_item'       => __( 'Update Project Type', 'test' ),
		'add_new_item'      => __( 'Add New Project Type', 'test' ),
		'new_item_name'     => __( 'New Project Type Name', 'test' ),
		'menu_name'         => __( 'Project Type', 'test' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( 'Project Type for Taxonomy Projects', 'test' ),
		'hierarchical' => false,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
	);
	register_taxonomy( 'projecttype', array('project'), $args );

}
add_action( 'init', 'create_projecttype_tax' );

// Create an Ajax endpoint to get the latest projects
add_action( 'wp_ajax_nopriv_get_latest_projects', 'get_latest_projects' );
add_action( 'wp_ajax_get_latest_projects', 'get_latest_projects' );

function get_latest_projects() {
    // Check if the user is logged in
    if ( is_user_logged_in() ) {
        // If the user is logged in, show the last 6 published projects
        $num_posts = 6;
    } else {
        // If the user is not logged in, show the last 3 published projects
        $num_posts = 3;
    }
    
    // Set up the query arguments
    $args = array(
        'post_type' => 'project',
        'posts_per_page' => $num_posts,
        'tax_query' => array(
            array(
                'taxonomy' => 'projecttype',
                'field' => 'slug',
                'terms' => 'architecture'
            )
        ),
        'orderby' => 'date',
        'order' => 'DESC'
    );
    
    // Run the query
    $query = new WP_Query( $args );
    
    // Check if there are any posts
    if ( $query->have_posts() ) {
        $data = array();
        // Loop through the posts and add them to the data array
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_data = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'link' => get_permalink()
            );
            array_push( $data, $post_data );
        }
        // Reset the post data
        wp_reset_postdata();
        // Return the data as a JSON object
        $response = array(
            'success' => true,
            'data' => $data
        );
        wp_send_json( $response );
    } else {
        // If there are no posts, return an error message
        $response = array(
            'success' => false,
            'message' => 'No projects found'
        );
        wp_send_json( $response );
    }
    exit;
};

function hs_give_me_coffee() {
    $api_url = 'https://coffee.alexflipnote.dev/random.json';

    $response = wp_remote_get( $api_url );

    $body = wp_remote_retrieve_body( $response );
    $coffee_data = json_decode( $body );

    if ( ! $coffee_data ) {
        return 'Sorry, there was an error decoding the coffee data.';
    }
	echo '<img src="' . $coffee_data->file . '" class="img-fluid">';
};
add_shortcode('hs_give_me_coffees', 'hs_give_me_coffee');

function check_ip_address() {
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $ip_parts = explode('.', $ip_address);

    if ($ip_parts[0] == '77' && $ip_parts[1] == '29') {
        wp_redirect('https://example.com/');
        exit;
    }
}
add_action('template_redirect', 'check_ip_address');
