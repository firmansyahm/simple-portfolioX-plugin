<?php
/*
Plugin Name: Portfolio Simple X
Plugin URI: http://firmansyahmaulana.com/ , ihsanatkia.com
Author: Firmansyah , Ihsan 
Author URI: http://firmansyahmaulana.com/ , ihsanatkia.com
Version: 1.0
Text Domain: portfoliox
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Register Custom Post Type
function post_portfoliox() {

	$labels = array(
		'name'                => _x( 'Portfolio', 'Post Type General Name', 'portfoliox' ),
		'singular_name'       => _x( 'Portfolio', 'Post Type Singular Name', 'portfoliox' ),
		'menu_name'           => __( 'Portfolio', 'portfoliox' ),
		'name_admin_bar'      => __( 'Portfolio', 'portfoliox' ),
		'parent_item_colon'   => __( 'Portfolio:', 'portfoliox' ),
		'all_items'           => __( 'All Portfolio', 'portfoliox' ),
		'add_new_item'        => __( 'Add New Portfolio', 'portfoliox' ),
		'add_new'             => __( 'Add New', 'portfoliox' ),
		'new_item'            => __( 'New Portfolio', 'portfoliox' ),
		'edit_item'           => __( 'Edit Portfolio', 'portfoliox' ),
		'update_item'         => __( 'Update Portfolio', 'portfoliox' ),
		'view_item'           => __( 'View Portfolio', 'portfoliox' ),
		'search_items'        => __( 'Search Portfolio', 'portfoliox' ),
		'not_found'           => __( 'Not found', 'portfoliox' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'portfoliox' ),
	);
	$args = array(
		'label'               => __( 'Portfolio', 'portfoliox' ),
		'description'         => __( 'Portfolio Description', 'portfoliox' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'portfoliox', $args );

}
add_action( 'init', 'post_portfoliox', 0 );


//add style
function style_portfoliox() {
	wp_enqueue_style( 'portfoliox-component' , plugin_dir_url( __FILE__ ) . 'css/component.css' );
	wp_enqueue_style( 'portfoliox-default' , plugin_dir_url( __FILE__ ) . 'css/default.css' );
	wp_enqueue_style( 'portfoliox-style' , plugin_dir_url( __FILE__ ) . 'css/style.css' );
	wp_enqueue_style( 'portfoliox-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700', array(), $theme->Version, 'all' );

	wp_enqueue_script( 'portfoliox-modernizr', plugin_dir_url( __FILE__ ) . '/js/modernizr.custom.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'portfoliox-toucheffects', plugin_dir_url( __FILE__ ) . '/js/toucheffects.js', array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts' , 'style_portfoliox' );

// Add Shortcode
function portfoliox_shortcode($atts) {

	extract( shortcode_atts( array(
        'limit'			=> '',
        'order_by'		=> 'date',
        'style'			=> '',
        'order'			=> 'desc',
        'column'		=> 'column-2'
	), $atts ) );

		$portfoliox_args   = array(
			'post_type'         => 'portfoliox',
			'posts_per_page'    => $limit,
			'post_status'       => 'publish',
			'orderby'           => $order_by,
			'order'             => $order,
		); 
		
		//load query
		$wp_query 	= null; 
		$wp_query 	= new WP_Query(); 
		$wp_query->query( $portfoliox_args ); 

		//check style
		if ( '' == $style ) {
			$style = 'cs-style-1'; 
		}

		//check column
		if ( '' == $column ) {
			$column = 'column-2'; 
		}

	ob_start();
		echo '<div class="portfolio"><ul class="grid ' . $style . ' ' . $column . '">';
		if ( $wp_query->have_posts() ) : 

			while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
			?>
				<li>
					<figure>
						<?php if ( 'cs-style-4' == $style ): ?>
								<div>
						<?php endif ?>

						<?php the_post_thumbnail(); ?>

						<?php if ( 'cs-style-4' == $style ): ?>
								<div>
						<?php endif ?>
						<figcaption>
							<h3><?php the_title(); ?></h3>
							<span><?php the_category(', '); ?></span>
							<a href="<?php the_permalink(); ?>">Take a look</a>
						</figcaption>
					</figure>
				</li>	
			<?php endwhile; ?>
		<?php wp_reset_postdata(); 
		endif; 
		echo '</ul></div>'; ?>

	<?php return ob_get_clean();

}
add_shortcode( 'portfoliox_shortcode', 'portfoliox_shortcode' );

if ( function_exists( 'vc_map' ) ) {

	add_action( 'vc_before_init', 'portfoliox_vc' );
	function portfoliox_vc() {
		
		$params = array(
				array(
					'type'			=> 'textfield',
					'heading'		=> __( 'Limit', 'portfoliox' ),
					'param_name'	=> 'limit',
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> __( 'Order by ', 'portfoliox' ),
					'param_name'	=> 'order_by',
					'value'			=> array(
						__( 'Recent', 'portfoliox' )	=> 'date',
						__( 'Random', 'portfoliox' )	=> 'rand',
						__( 'ID', 'portfoliox' )		=> 'ID',
						__( 'Author', 'portfoliox' )	=> 'author',
						__( 'Title', 'portfoliox' )	=> 'title',
						__( 'Name', 'portfoliox' )		=> 'name',
						__( 'Type', 'portfoliox' )		=> 'type',
						__( 'Comment_count', 'portfoliox' )	=> 'comment_count'
					),
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> __( 'Order ', 'portfoliox' ),
					'param_name'	=> 'order',
					'value'			=> array(
						__( 'Asc', 'portfoliox' )	=> 'asc',
						__( 'Desc', 'portfoliox' )	=> 'desc'
					),
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> __( 'Select Style ', 'portfoliox' ),
					'param_name'	=> 'style',
					'value'			=> array(
						__( 'Style 1', 'portfoliox' )	=> 'cs-style-1',
						__( 'Style 2', 'portfoliox' )	=> 'cs-style-2',
						__( 'Style 3', 'portfoliox' )	=> 'cs-style-3',
						__( 'Style 4', 'portfoliox' )	=> 'cs-style-4',
						__( 'Style 5', 'portfoliox' )	=> 'cs-style-5',
						__( 'Style 6', 'portfoliox' )	=> 'cs-style-6',
						__( 'Style 7', 'portfoliox' )	=> 'cs-style-7',
					),
				),

				array(
					'type'			=> 'dropdown',
					'heading'		=> __( 'Select Column ', 'portfoliox' ),
					'param_name'	=> 'column',
					'value'			=> array(
						__( '2', 'portfoliox' )	=> 'column-2',
						__( '3', 'portfoliox' )	=> 'column-3',
						__( '4', 'portfoliox' )	=> 'column-4',
					),
				),
			);

		vc_map( array(
			'name'				=> __( 'PortfolioX' , 'portfoliox' ),
			'base'				=> 'portfoliox_shortcode',
			'category'			=> 'PortfolioX',
			'admin_enqueue_js' 	=> '',
			'params'			=> $params,
			'description' 		=> __( 'PortolioX Shortcode.', 'portfoliox' ),
		   )
		);
	}
} //if VC plugin active



