<?php
/**
 * Overhead and Administrative functions file for PixelSpoke theme.
 * All functions in this file MUST be "pluggable" (aka
 * if ( ! function_exists( 'syn_add_script_version' ) ) { }
 * NOTE: WordPress core pluggable functions are going away, but if you want to overwrite them, you must call them in plugins rather than here in the theme.
 *
 *
 * The namespace we use for our function is syn_ harkening back to our days as Synotac
*/

/**
* Remove the post formats UI
* Overwrite in functions.php if you do want it
*/
if ( ! function_exists( 'syn_postformats' ) ) {
  function syn_postformats() {
    return '__return_false';
  }
  add_filter( 'enable_post_format_ui',  syn_postformats() );

}

/**
* Remove the generator meta tag and versions on feeds, etc.
*/
if ( ! function_exists( 'syn_remove_versions' ) && ! function_exists( 'syn_remove_version' )) {
  function syn_remove_versions() {
    // Remove generator meta tag
    remove_filter('wp_head', 'wp_generator');
    // Remove versions on feeds, etc
    $actions = array(
      'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head',
      'comments_atom_head', 'opml_head', 'app_head'
    );
    foreach ( $actions as $action )
      remove_action( $action, 'the_generator' );
  }

  add_action( 'init', 'syn_remove_versions', 2 );
}

/**
* Add better version number to scripts and stylesheets
*/
if ( ! function_exists( 'syn_add_script_version' ) ) {
  function syn_add_script_version( $url ) {
    // Separate on the version parameter if it matches this WP version
    $url_parts = explode( '?ver=' . $GLOBALS['wp_version'], $url );
    // If the version string is not part of the URL, return it unchanged
    if (count($url_parts) == 1) return $url;
    // Otherwise, get the last mtime for the file and use that
    $parsed_url = parse_url($url_parts[0]);
    // This is something like "/wp-content/themes/themename/filename.php"
    $url_path = $parsed_url['path'];

    // If the site is down a level, need to remove that directory
    // name from the path because otherwise it appears twice
    $parsed_site_url = parse_url(get_site_url());
    // And the path is either empty or a "/directory" if the
    // site is down a level from web-root.
    // The "|"s below are because of the slashes in the regex. Always strip
    // out one slash because ABSPATH has a trailing one and the $url_path has
    // a leading one.
	$psu_path = isset($parsed_site_url['path']) ? $parsed_site_url['path'] : '';
    $url_path = preg_replace('|^' . $psu_path . '/|', '', $url_path);
    $file_path = ABSPATH . $url_path;
    if (!file_exists($file_path)) return $url;
    $file_mtime = filemtime($file_path);
    return $url_parts[0] . '?ver=' . $file_mtime;
  }

  add_filter( 'script_loader_src', 'syn_add_script_version', 1 );
  add_filter( 'style_loader_src', 'syn_add_script_version', 1 );
}

/**
* Temp Maintenance - with http response 503 (Service Temporarily Unavailable) or custom message
* This could block users who are NOT an administrator from viewing the website or by IP address
* Logged in version & wp_die() from http://wpdaily.co/top-10-snippets/
*
* Can be placed at top of index.php if you are concerned that WordPress will fail completely
*
* If using regularly for a client, consider moving to main functions.php
*/
if ( ! function_exists( 'wp_maintenance_mode' ) ) {
  function wp_maintenance_mode() {
    define('SITE_DOWN_IPS_OK', '206.72.108.242'); //you can add more IP addresses separated by colons
    //define('SITE_DOWN_IPS_OK', ''); //you can add more IP addresses separated by colons
    define('SITE_DOWN', false); //change to true if doing maintenance
    $ok_ips = explode(':', SITE_DOWN_IPS_OK);

    //Check if site is down and redirect if so
    //First check is for admin logged in; Second is for okay IP addresses
    //    if(!current_user_can('edit_themes') || !is_user_logged_in()) {
    if ((SITE_DOWN) && (strpos($_SERVER['SCRIPT_NAME'], 'pagename.html') === false) && (!in_array($_SERVER['REMOTE_ADDR'], $ok_ips))) {
      //      wp_die('Maintenance, please come back soon.', 'Maintenance - please come back soon.', array('response' => '503'));

      // redirect to site down page: update URL
      session_write_close();
      header('Location: http://www.siteurl.com/maintenance.html');
      exit;
    }
  }
  //Uncomment action to use on live site
  //add_action('get_header', 'wp_maintenance_mode');
} //end if ( ! function_exists( 'wp_maintenance_mode' ) )

/**
* Hide WordPress updates
*
*/
// if ( ! function_exists( 'syn_hide_update' ) ) {
//   add_action('admin_menu','syn_hide_update');
//   function syn_hide_update() {
//     remove_action('admin_notices', 'update_nag', 3);
//   }
// }

/**
 * Change the failed login message for extra WordPress Secruty
 *
 */
if ( ! function_exists( 'syn_failed_login' ) ) {
  add_filter('login_errors', 'syn_failed_login');
  function syn_failed_login() {
      return 'Incorrect login information.';
  }
}

/**
 * Change the login logo
 *
 */
if ( ! function_exists( 'syn_login_logo' ) && ! function_exists( 'custom_login_logo' )) {
  add_action('login_head', 'syn_login_logo');
  function syn_login_logo() {
    echo '<style type="text/css">.login h1 a {background: url('.get_bloginfo('template_directory').'/img/login.png) 50% 50% no-repeat !important;}</style>';
  }
}

/**
 *  Change the login logo link (uncomment add_action to use)
 *
 */
if ( ! function_exists( 'syn_login_logo_url' ) && ! function_exists( 'my_login_logo_url' )) {
  add_filter( 'login_headerurl', 'syn_login_logo_url' );
  function syn_login_logo_url() {
    return get_bloginfo( 'url' );
  }
}

/**
 * Add a dashboard widget that links back to the Synotac docs website
 *
 * Edit synotac_resources to change content
 * Comment out add_action if you don't want this box to show up
 *
 * Documentation: wp_add_dashboard_widget($widget_id, $widget_name, $callback, $control_callback = null)
 *
 */
if ( ! function_exists( 'synotac_add_dashboard_resources' ) && ! function_exists( 'synotac_resources' )) {

  add_action('wp_dashboard_setup', 'synotac_add_dashboard_resources' );
  function synotac_add_dashboard_resources() {
    wp_add_dashboard_widget('synotac-resources', 'PixelSpoke Resources &amp; WordPress Documentation', 'synotac_resources');
  }

  function synotac_resources() {
    echo 'Looking for additional WordPress documentation? Visit <a href="http://docs.pixelspoke.com" target="_blank">PixelSpoke WordPress documentation</a>.<br /><br />Looking for Synotac? <a href="http://www.pixelspoke.com/name/" target="_blank">Learn about the new name</a>.<br /><br />Need help with your website or digital marketing? Call us at 503-517-2116';
  }
}

/**
 * Sets the post excerpt length to 60 characters.
 *
 * @return int
 */
if ( ! function_exists( 'synotac_excerpt_length' ) ) {
  add_filter( 'excerpt_length', 'synotac_excerpt_length' );
  function synotac_excerpt_length( $length ) {
    return 60;
  }
}

/**
 * Returns a "Continue Reading" link for excerpts
 * Used in synotac_auto_excerpt_more() and synotac_custom_excerpt_more() below
 *
 * @return string "Continue Reading" link
 */
if ( ! function_exists( 'synotac_continue_reading_link' ) ) {
  function synotac_continue_reading_link() {
    return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'synotac' ) . '</a>';
  }
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and synotac_continue_reading_link().
 *
 * @return string An ellipsis
 */
if ( ! function_exists( 'synotac_auto_excerpt_more' ) ) {
  add_filter( 'excerpt_more', 'synotac_auto_excerpt_more' );
  function synotac_auto_excerpt_more( $more ) {
    return ' &hellip;' . synotac_continue_reading_link();
  }
}

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * @return string Excerpt with a pretty "Continue Reading" link
 */
if ( ! function_exists( 'synotac_custom_excerpt_more' ) ) {
  add_filter( 'get_the_excerpt', 'synotac_custom_excerpt_more' );
  function synotac_custom_excerpt_more( $output ) {
    if ( has_excerpt() && ! is_attachment() ) {
      $output .= synotac_continue_reading_link();
    }
    return $output;
  }
}

/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 */
if ( ! function_exists( 'synotac_posted_in' ) ) {
  function synotac_posted_in() {
    // Retrieves tag list of current post, separated by commas.
    $tag_list = get_the_tag_list( '', ', ' );
    if ( $tag_list ) {
      $posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'synotac' );
    } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
      $posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'synotac' );
    } else {
      $posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'synotac' );
    }
    // Prints the string, replacing the placeholders.
    printf(
      $posted_in,
      get_the_category_list( ', ' ),
      $tag_list,
      get_permalink(),
      the_title_attribute( 'echo=0' )
    );
  }
}

/**
 * Prints HTML with meta information for the current post date/time and author.
 *
 */
if ( ! function_exists( 'synotac_posted_on' ) ) {
  function synotac_posted_on() {
  $date = get_the_date();
  $author_name = get_the_author();
  $author_link = get_author_posts_url(get_the_author_meta('ID'));
  $categories = get_the_category_list( ', ' );
  $tags = get_the_tag_list( '', ', ' );

  $output = '<div class="post-details"><p>Posted on '.$date.' by <a href="'. $author_link .'">'.$author_name.'</a>';

  $category_check = '';
    if ($categories) {
      $category_check = ' in '.$categories;
    }
    echo $output .$category_check.'</p></div>';
  }
}

/**
 * Horizontal Rule Shortcode
 *
 */
if ( ! function_exists( 'syn_hr' ) && ! function_exists( 'hr' )) {
  add_shortcode('hr', 'syn_hr');
  function syn_hr() {
    return '<div class="hr"><hr /></div>';
  }
}

/**
 * Horizontal Rule Shortcode for Clear
 *
 */
if ( ! function_exists( 'syn_clear' ) && ! function_exists( 'clear' )) {
  add_shortcode('clear', 'syn_clear');
  function syn_clear() {
    return '<div class="clear"><hr /></div>';
  }
}

if ( ! function_exists( 'acf_image' ) ) {
  function acf_image($aImageAttr) {
    $aImg = $aImageAttr[0];
    $class = $aImageAttr[1];
    $size = $aImageAttr[2];
    if ( is_array($aImg) ) :
      if ($size) :
        $widthString = $size . '-width';
        $heightString = $size . '-height';
        $imgW = $aImg['sizes'][$widthString];
        $imgH = $aImg['sizes'][$heightString];
        $imgSrc = $aImg['sizes'][$size];
      else:
        $imgW = $aImg['width'];
        $imgH = $aImg['height'];
        $imgSrc = $aImg['url'];
      endif;

      $imgStr = '<img src="' . $imgSrc . '" alt="' . $aImg['title'] . '"';
      $imgStr .= ( $imgW > 0 ? ' width="' . $imgW . '"' : '' );
      $imgStr .= ( $imgH > 0 ? 'height="' . $imgH . '"' : '');
      $imgStr .= ( $class ? ' class="' . $class . '"' : '' );
      $imgStr .= '>';
      return $imgStr;
    endif;
  }
}

if ( ! function_exists( 'acf_link' ) ) {
  function acf_link($options) { // link_text, link_destination, class
    $linkText = $options[0];
    $linkDestination = $options[1];
    $html = '<a href="' . $linkDestination . '"';
    if ( count($options) >= 3 ) {
      $html .= ' class="' . $options[2] . '"';
    }
    $html .= '>' . $linkText . '</a>';
    return $html;
  }
}

if ( ! function_exists( 'pix_slugify' ) ) {
  function pix_slugify($string) {
    $replace_chars = array( ' ', '-', '(', ')', '.', '/', ',', ':', ';', '+', '=' );
    $slug = str_replace($replace_chars, '', $string);
    $slug = strtolower($slug);
    return $slug;
  }
}

?>
