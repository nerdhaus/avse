<?php
/**
 * Helper classes to override default Timber behaviors.
 */

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

Timber::$dirname = array('templates', 'views');

class SpecialSite extends TimberSite {

	function __construct() {
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_theme_support( 'post-formats', array( 'standard', 'link', 'image', 'audio', 'status' ) );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	function add_to_context( $context ) {
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		return $context;
	}

	function add_to_twig( $twig ) {
		$twig->addExtension( new Twig_Extension_StringLoader() );
		return $twig;
	}

}

new SpecialSite();



class SpecialUser extends TimberUser {
}

class SpecialPost extends TimberPost {
}

class SpecialComment extends TimberComment {
}

class SpecialTerm extends TimberTerm {
}

class SpecialImage extends TimberImage {
}

class SpecialMenu extends TimberMenu {
}