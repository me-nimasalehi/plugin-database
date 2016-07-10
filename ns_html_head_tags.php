<?php
/*
Plugin name: HTML HEAD TAGS
Plugin URI: nimasalehi.com/ns-html-head-tags
Description: A simple plugin to add CSS, JS, META, ... to HEAD of HTML.
Author: Nima Salehi
Author URI: nimasalehi.com
Version: 0.1
*/

// Call ns-html-head-tags function to load plugin menu in dashboard
add_action( 'admin_menu', 'ns_html_head_tags' );

// Create WordPress admin menu
if( !function_exists("ns_html_head_tags") )
{
function ns_html_head_tags(){

  $page_title = 'HTML HEAD TAGS';
  $menu_title = 'HTML HEAD TAGS';
  $capability = 'manage_options';
  $menu_slug  = 'ns_html_head_tags';
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

  // Call ns_update_html_head_tags function to update database
  add_action( 'admin_init', 'ns_update_html_head_tags' );

}
}

// Create function to register plugin settings in the database
if( !function_exists("ns_update_html_head_tags") )
{
function ns_update_html_head_tags() {
  register_setting( 'ns_html_head_tags_settings', 'html_head_tags' );
}
}

// Create WordPress plugin page
if( !function_exists("html_head_tags_page") )
{
function html_head_tags_page(){
?>

  <h1>Add HTML HEAD TAGS.</h1>
  <form method="post" action="options.php">
    <?php settings_fields( 'ns_html_head_tags_settings' ); ?>
    <?php do_settings_sections( 'ns_html_head_tags_settings' ); ?>
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
