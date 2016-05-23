<?php 
/************************************************************************************/
/*	Add Theme Support	*/		
/************************************************************************************/		
/**
 * For more information on add_theme_support visit 
 * http://codex.wordpress.org/Function_Reference/add_theme_support
 */
 
function simply_pure_theme_install() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( "custom-header", array('flex-height'=>true,'flex-width'=>true,'default-text-color'=>'000000'));
	add_theme_support( "custom-background", array('default-color'=>'ffffff') );
	add_editor_style( 'editor-style.css' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'gallery', 'caption' ) );
	load_theme_textdomain('simply-pure', get_template_directory() . '/languages');
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
			'primary'   => __( 'Primary menu', 'simply-pure' ),
	) );
}
add_action( 'after_setup_theme', 'simply_pure_theme_install' );

/**
 * setting  $content_width to avoid overflow of videos and images added by wordpress media gallery
 */
if ( ! isset( $content_width ) ) {
		$content_width = 900;	
}

/**
 * Register Widget Sidebars
 *
 * @version 1.0
 * @since   Simply Pure 1.0
 * @author Ritesh Sanap <riteshsanap@gmail.com>
 *
 */
function simply_pure_sidebar_widgets() {
	register_sidebars(3, array(
        'name' => __('Footer - Widget Area %1$s', 'simply-pure'),
        'description' => __('Footer Sidebar', 'simply-pure'),
        'id' => 'footer-area',
        'before_widget' => '<div id="%1$s" class="%2$s widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));

register_sidebars(3, array(
        'name' => __('Post Footer - Widget Area %1$s', 'simply-pure'),
        'description' => __('Footer Sidebar', 'simply-pure'),
        'id' => 'post-footer',
        'before_widget' => '<div id="%1$s" class="%2$s widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));
register_sidebar(array(
        'name' => __('Sidebar', 'simply-pure'),
        'description' => __('Below Header', 'simply-pure'),
        'id' => 'sidebar-area',
        'before_widget' => '<section id="%1$s" class="%2$s widget">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));

}
add_action('widgets_init', 'simply_pure_sidebar_widgets');
/**
 * Add Stylesheet and scripts
 *
 * @version 1.0
 * @since   Simply Pure 1.0
 * @author Ritesh Sanap <riteshsanap@gmail.com>
 *
 */
function simply_pure_scripts_styles() {
	/**
	 * Enqueue StyleSheet
	 */
	wp_enqueue_style( 'simply-pure-style', get_stylesheet_uri(), array(), '0.4');

	/**
	 * Add JavaScript to animate Sidebar, when the sidebar is active i.e. atleast has 1 widget
	 */
	if(is_active_sidebar('sidebar-area')) {
		/**
		 * The Below script should be added in the footer so $in_footer is set to true
		 */
		wp_enqueue_script('simply-pure-script', get_template_directory_uri(). '/script.js', array(), '0.1', true);
	}
	if ( is_singular() ) {
		/**
		 * Adding comment Reply script
		 */
		wp_enqueue_script( "comment-reply" ); 	
	} 
}
add_action( 'wp_enqueue_scripts', 'simply_pure_scripts_styles' );

function simply_pure_author_link() {

	$authId = get_the_author_meta('ID');
	$niceName = get_the_author_meta('user_nicename');

	$link = sprintf('<a href="%1$s" title="%2$s" rel="author" itemprop="url"><span itemprop="name">%3$s</span></a>',
		esc_url( get_author_posts_url($authId, $niceName) ),
		esc_attr( sprintf( __( 'Posts by %s', 'simply-pure' ), get_the_author() ) ),
		get_the_author()
	);
	$link = _x('Published by','author of a post','simply-pure').' <span class="entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">'. $link. '</span>';
	return $link;
}
function simply_pure_post_time() {
	$time = _x('on','Publication date','simply-pure').' <time itemprop="datePublished" datetime="'. get_the_time('c').'">'. get_the_time(__('F j, Y', 'simply-pure')) . '</time>';
	if(!get_the_title()) {
		$time = _x('on','Publication date','simply-pure').' <time itemprop="datePublished" datetime="'. get_the_time('c').'"><a rel="bookmark" href="'.get_the_permalink().'">'. get_the_time(__('F j, Y', 'simply-pure')) . '</a></time>';
	}
	
	return $time;
}

/**
 * Post Meta
 *
 * @version 1.0
 * @since   Simply Pure 1.0
 * @author Ritesh Sanap <riteshsanap@gmail.com>
 *
 * @return  string Simple HTML string
 */
function simply_pure_post_meta() {
	echo '<p class="post-meta">';
	printf( '%1$s %2$s %3$s', 
        simply_pure_author_link(), 
        simply_pure_categories(), 
        simply_pure_post_time()
	);
	edit_post_link(__('Edit','simply-pure'), ' - ');
	echo '</p>';
}

/**
 * Post Thumbnail
 *
 * @version 1.0
 * @since   Simply Pure 1.0
 * @author Ritesh Sanap <riteshsanap@gmail.com>
 *
 * @return  string 
 */
function simply_pure_post_thumbnail() {
	// Check if the post has the thumbnail
	// && if it is blank or not
	if(has_post_thumbnail() && '' != get_the_post_thumbnail()) {
		echo '<div class="post-thumbnail">';
		the_post_thumbnail();
		echo '</div>';
	}
}

/**
 * Random colored categories by addming random CSS classes from an array.
 *
 * @version 1.0
 * @since   Simply Pure 1.0
 * @author Ritesh Sanap <riteshsanap@gmail.com>
 * 
 * @return  string Output echo'ed
 */
function simply_pure_categories() {
	// get post categories
	$categories = get_the_category();

	// define CSS classes with different colors
	$colors = array('', 'post-green','post-blue','post-purple','post-red','post-yellow');
	$separator = ' '; // used for adding seperator in the categories
	$output = '';

	if($categories){ 
		foreach($categories as $category) {
			$color = array_rand($colors, 1); // call One random value from the array
			$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf(__('View all posts in %s','simply-pure'), $category->name ) ) . '" class="post-category '.$colors[$color].'">'.$category->cat_name.'</a>'.$separator;
		}
		$output = _x('Under','Before categories','simply-pure').'<span itemprop="keywords">'. $output. '</span>';
	return (trim($output, $separator));
	}

}
/**
 * Counts the number of sidebars with atleast a Single Widget
 * for more information visit : 
 * http://codex.wordpress.org/Function_Reference/is_active_sidebar
 *
 * @version 1.0
 * @since   Simply Pure 1.0
 * @author Ritesh Sanap <riteshsanap@gmail.com>
 *
 * @param   Array   $sidebars the List of sidebars that are active
 * @return  integer
 */
function simply_pure_sidebar_active_count($sidebars) {
	$count = 0;
	foreach ($sidebars as $sidebar) {
		if(is_active_sidebar($sidebar)) {
			$count++;
		}
	}
	return $count;
}
/**
 * Class output for Footer and Post Footer widgets
 *
 * @version 1.0
 * @since   Simply Pure 1.0
 * @author Ritesh Sanap <riteshsanap@gmail.com>
 *
 * @param   string   $position
 * @return  string
 */
function simply_pure_sidebars_class($position) {
	$sidebars = array();
	if($position == 'post-footer') {
		$sidebars = array('post-footer','post-footer-2','post-footer-3');
	} else {
		$sidebars = array('footer-area', 'footer-area-2', 'footer-area-3');
	}

	$class = 'pure-u-1';
	$class .= ' pure-u-sm-1-'. simply_pure_sidebar_active_count($sidebars);
	return $class;
}
function simply_pure_body_classes($classes) {
	if(get_theme_mod('sidebar_position') != 'right') {
		$classes[] = 'sidebar-left';
	}
	if(!is_active_sidebar('sidebar-area')) {
		$classes[] = 'header-full';
	} else {
		$classes[] = 'header-half';
	}

	if(!get_theme_mod('display_avatar', true)) {
		$classes[] = 'post-title-no-avatar';
	}
	return $classes;
}
add_filter( 'body_class', 'simply_pure_body_classes' );

function simply_pure_archive_title() {
	$title = NULL;
	if(is_archive()) {
		$title = __('Archive: ','simply-pure'). single_month_title(' ', false);
	}
	if(is_category()) {
		  $title = __('Category: ','simply-pure'). single_cat_title('', false);
	}
	if(is_tag()) {
		 $title = __('Tag: ','simply-pure'). single_tag_title('', false);
	}
	if(is_author()) {
		$title = __('Author: ','simply-pure'). get_the_author();
	}

	return $title;
}
/**
 * Modify Comment Fields output
 */
function simply_pure_alter_comments_field($fields) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$reqstr = _x('(Required)','Add after all required fields','simply-pure');
	$required_text = __(' "<span class="required">*</span>" marked fields are required', 'simply-pure');
	$aria_req = ( $req ? " aria-required='true' required" : '' );

	  $fields['author'] =
      '<div class="comment-form-author pure-control-group">' .
	  '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" class="pure-input-1-2" placeholder="'.__('Name', 'simply-pure').' '.$reqstr.'"' . $aria_req . '/>'.
      '<label for="author">' . __( 'Name', 'simply-pure' ) . '</label>'.
      '</div>';

    $fields['email'] =
      '<div class="comment-form-email pure-control-group">'.
      '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" class="pure-input-1-2" placeholder="'.__('Email', 'simply-pure').' '.$reqstr.'"' . $aria_req . '/>'.
      '<label for="email">' . __( 'Email', 'simply-pure' ). '</label>'.
      '</div>';

    $fields['url'] =
      '<div class="comment-form-url pure-control-group">'.
      '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" class="pure-input-1-2" placeholder="'.__('Website', 'simply-pure').'"/>'.
      '<label for="url">' . __( 'Website', 'simply-pure' ) . '</label>' .'</div>';

	return $fields;
}

add_filter('comment_form_default_fields', 'simply_pure_alter_comments_field');

/**
 * Adding Customizer
 */
require get_template_directory(). '/customizer.php';