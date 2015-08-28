<?php
/*
Plugin Name: Portfolio Simple X
Plugin URI: http://firmansyahmaulana.com/
Author: Firmansyah
Author URI: http://firmansyahmaulana.com/
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
	wp_enqueue_style( 'normalize' , plugin_dir_url( __FILE__ ) . 'css/normalize.css' );
	wp_enqueue_style( 'demo' , plugin_dir_url( __FILE__ ) . 'css/demo.css' );
	wp_enqueue_style( 'set' , plugin_dir_url( __FILE__ ) . 'css/set1.css' );
	wp_enqueue_style( 'set2' , plugin_dir_url( __FILE__ ) . 'css/set2.css' );
	wp_enqueue_style( 'set3' , plugin_dir_url( __FILE__ ) . 'css/custom.css' );
	wp_enqueue_style( 'firman-fonts', 'http://fonts.googleapis.com/css?family=Raleway:400,800,300', array(), $theme->Version, 'all' );
}
add_action( 'wp_enqueue_scripts' , 'style_portfoliox' );

// Add Shortcode
function portfoliox_shortcode($atts) {

	extract( shortcode_atts( array(
        'limit'			=> '',
        'order_by'		=> 'date',
        'style'			=> '',
        'order'			=> 'desc'
	), $atts ) );

	$gallery_args   = array(
			'post_type'         => 'portfoliox',
			'posts_per_page'    => $limit,
			'post_status'       => 'publish',
			'orderby'           => $order_by,
			'order'             => $order,
		); 
		
		$wp_query 	= null; 
		$wp_query 	= new WP_Query(); 
		$wp_query->query( $gallery_args ); 

		if ( '' == $style ) {
			$style = 'lily'; 
		}

	ob_start();
		echo '<div class="grid">';
		if ( $wp_query->have_posts() ) : 

			while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			
			<?php 

			$content = get_the_content();
			$content = strip_tags($content);

			switch ($style) {
				case 'zoe': ?>
					<figure class="effect-<?php echo $style; ?>">
						<?php the_post_thumbnail(); ?>
						<figcaption>
							<h2><span><?php the_title(); ?></span></h2>
							<p class="icon-links">
								<a href="<?php the_permalink(); ?>"><span class="icon-eye"></span></a>	
							</p>
							<p><?php echo substr($content, 0, 50); ?></p>
						</figcaption>			
					</figure>			
				<?php break;

				case 'julia': ?>
					<figure class="effect-<?php echo $style; ?>">
						<?php the_post_thumbnail(); ?>
						<figcaption>
							<h2><span><?php the_title(); ?></span></h2>
							<div>
								<p><?php echo substr($content, 0, 50); ?></p>	
							</div>
							<a href="<?php the_permalink(); ?>">View More</a>	
						</figcaption>			
					</figure>			
				<?php break;

				case 'hera': ?>
					<figure class="effect-<?php echo $style; ?>">
						<?php the_post_thumbnail(); ?>
						<figcaption>
							<h2><span><?php the_title(); ?></span></h2>
							<p>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-file-pdf-o"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-file-image-o"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-file-archive-o"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-file-code-o"></i></a>
							</p>
						</figcaption>			
					</figure>			
				<?php break;

				case 'winston': ?>
					<figure class="effect-<?php echo $style; ?>">
						<?php the_post_thumbnail(); ?>
						<figcaption>
							<h2><span><?php the_title(); ?></span></h2>
							<p>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-star-o"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-comments-o"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-envelope-o"></i></a>
							</p>
						</figcaption>			
					</figure>			
				<?php break;

				case 'terry': ?>
					<figure class="effect-<?php echo $style; ?>">
						<?php the_post_thumbnail(); ?>
						<figcaption>
							<h2><span><?php the_title(); ?></span></h2>
							<p>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-download"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-heart"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-share"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-tags"></i></a>
							</p>
						</figcaption>			
					</figure>			
				<?php break;

				case 'phoebe': ?>
					<figure class="effect-<?php echo $style; ?>">
						<?php the_post_thumbnail(); ?>
						<figcaption>
							<h2><span><?php the_title(); ?></span></h2>
							<p>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-user"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-heart"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-cog"></i></a>
							</p>
						</figcaption>			
					</figure>
				<?php break;

				case 'kira': ?>
					<figure class="effect-<?php echo $style; ?>">
						<?php the_post_thumbnail(); ?>
						<figcaption>
							<h2><span><?php the_title(); ?></span></h2>
							<p>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-home"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-download"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-heart"></i></a>
								<a href="<?php the_permalink(); ?>"><i class="fa fa-fw fa-share"></i></a>
							</p>
						</figcaption>			
					</figure>
				<?php break;

				case 'wdx': ?>
					<a href="<?php the_permalink(); ?>">
						<article class="template-version">
							<div class="pc-screen">
							    <?php the_post_thumbnail(); ?>
							    <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
							    <div class="pc-screen-content screen-dark-one" style="background-image: url('<?php echo $url; ?>');"></div>
							</div>
							<p><?php the_title(); ?></p>
						</article>
					</a>
				<?php break;

				case 'oscar' || 'marley' || 'lily' || 'sadie' || 'honey' || 'layla' || 'ruby' || 'roxy' || 'bubba' || 'romeo' || 'dexter' || 'sarah' || 'chico' || 'milo' || 'selena' || 'apollo' || 'steve' || 'moses' || 'jazz' || 'ming' || 'lexi' || 'duke' || 'goliath' : ?>
					<figure class="effect-<?php echo $style; ?>">
						<?php the_post_thumbnail(); ?>
						<figcaption>
							<h2><span><?php the_title(); ?></span></h2>
							<p><?php echo substr($content, 0, 50); ?></p>
							<a href="<?php the_permalink(); ?>">View more</a>
						</figcaption>			
					</figure>			
				<?php break;

				default: ?>
					<figure class="effect-<?php echo $style; ?>">
						<?php the_post_thumbnail(); ?>
						<figcaption>
							<h2><span><?php the_title(); ?></span></h2>
							<p><?php echo substr($content, 0, 50); ?></p>
							<a href="<?php the_permalink(); ?>">View more</a>
						</figcaption>			
					</figure>	
				<?php
				break;
			} ?>	

			<?php endwhile; ?>
		<?php wp_reset_postdata(); 
		endif; 
		echo '<div class="grid">'; ?>

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
						__( 'Goliath', 'portfoliox' )	=> 'goliath',
						__( 'Duke', 'portfoliox' )		=> 'duke',
						__( 'Lexi', 'portfoliox' )		=> 'lexi',
						__( 'Ming', 'portfoliox' )		=> 'ming',
						__( 'Jazz', 'portfoliox' )		=> 'jazz',
						__( 'Moses', 'portfoliox' )		=> 'moses',
						__( 'Steve', 'portfoliox' )		=> 'steve',
						__( 'Apollo', 'portfoliox' )	=> 'apollo',
						__( 'Selena', 'portfoliox' )	=> 'selena',
						__( 'Milo', 'portfoliox' )		=> 'milo',
						__( 'Chico', 'portfoliox' )		=> 'chico',
						__( 'Sarah', 'portfoliox' )		=> 'sarah',
						__( 'Dexter', 'portfoliox' )	=> 'dexter',
						__( 'Romeo', 'portfoliox' )		=> 'romeo',
						__( 'Bubba', 'portfoliox' )		=> 'bubba',
						__( 'Roxy', 'portfoliox' )		=> 'roxy',
						__( 'Ruby', 'portfoliox' )		=> 'ruby',
						__( 'Layla', 'portfoliox' )		=> 'layla',
						__( 'Honey', 'portfoliox' )		=> 'honey',
						__( 'Sadie', 'portfoliox' )		=> 'sadie',
						__( 'Lily', 'portfoliox' )		=> 'lily',
						__( 'Oscar', 'portfoliox' )		=> 'oscar',
						__( 'Marley', 'portfoliox' )	=> 'marley',
						__( 'Zoe', 'portfoliox' )		=> 'zoe',
						__( 'Julia', 'portfoliox' )		=> 'julia',
						__( 'Hera', 'portfoliox' )		=> 'hera',
						__( 'Winston', 'portfoliox' )	=> 'winston',
						__( 'Terry', 'portfoliox' )		=> 'terry',
						__( 'Phoebe', 'portfoliox' )	=> 'phoebe',
						__( 'Wdx', 'portfoliox' )	=> 'wdx'
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



