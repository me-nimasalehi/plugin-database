<?php
/*
Plugin name: PAGE HEAD INJECTOR
Plugin URI: nimasalehi.com/nimas-page-head-injector
Description: A plugin which enables the Wordpress administrator to add CSS, JS, META, etc. sections to the <HEAD> section of pages.
Author: Nima Salehi
Author URI: http://www.nimasalehi.com
Version: 1.0
*/

// Registers nimas-html-head-tags function to load the plugin menu in the dashboard.
add_action( 'admin_menu', 'nimas_page_head_injector' );

// Create menu in WordPress admin section.
if( !function_exists("nimas_page_head_injector") )
{
	function nimas_page_head_injector(){

	  $page_title = 'HTML HEAD TAGS';
	  $menu_title = 'HTML HEAD TAGS';
	  $capability = 'manage_options';
	  $menu_slug  = 'nimas_page_head_injector';
	  $function   = 'html_head_tags_page';
	  $icon_url   = 'dashicons-media-code';
	  $position   = 4;

	  add_menu_page( $page_title,
	                 $menu_title,
	                 $capability,
	                 $menu_slug,
	                 $function,
	                 $icon_url,
	                 $position );

	  // Call nimas_update_html_head_tags function to update database
	  add_action( 'admin_init', 'nimas_update_html_head_tags' );
	}
}

// Create function to register plugin settings in the database
if( !function_exists("nimas_update_html_head_tags") )
{
	function nimas_update_html_head_tags() {
	  register_setting( 'nimas_page_head_injector_settings', 'html_head_tags' );
	}
}

// Create WordPress plugin page
if( !function_exists("html_head_tags_page") )
{
	function html_head_tags_page(){
	?>
	  <h1>Add HTML HEAD TAGS.</h1>
	  <form method="post" action="options.php">
	    <?php settings_fields( 'nimas_page_head_injector_settings' ); ?>
	    <?php do_settings_sections( 'nimas_page_head_injector_settings' ); ?>
	    <table class="form-table">
	      <tr valign="top">
	      <th scope="row">HTML HEAD TAGS:</th>
	      </tr>
	      <tr><td><textarea rows="15" cols="100"  name="html_head_tags" >
	        <?php echo esc_attr( get_option('html_head_tags') ); ?>
	      </textarea></td></tr>
	    </table>
	  <?php submit_button(); ?>

	  </form>
	  <p>
	  Description: A simple plugin to add CSS, JS, META, ... to HEAD of HTML.<br>
	  Author: Nima Salehi |
	  Author URI: nimasalehi.com
	  </p>
	<?php
	}
}

add_action('wp_head','hook_css');

function hook_css()
{
  echo (get_option('html_head_tags'));
}
