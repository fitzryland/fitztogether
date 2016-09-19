<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package PixelSpoke Boilerplate
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="icon" type="image/gif" href="http://fitz.to/gether/fitztogethericon.gif">

<?php wp_head(); ?>
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Raleway:600:latin', 'Roboto:300,500:latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'fitztogether' ); ?></a>


<?php
// include ( 'part-questionNameList.php' );
// shuffle($cp_questions);
// echo count($cp_questions) . '</br>';

// foreach ($cp_questions as $question_key => $question) :
// 	echo '"' . $question . '",</br>';
// endforeach;
?>

	<header class="site_header" id="js-header">

		<button class="site_header--toggle" id="js-header_toggle"></button>

		<div class="site_branding">
			<h1 class="site_branding--title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<div class="site_branding--desc"><?php the_field( 'site_description', 'option' ); ?></div>
		</div><!-- .site-branding -->

		<nav class="site_nav" role="navigation">
			<ul class="site_nav--list">
				<li>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">All</a>
				</li>
				<?php
				$cat_list_args = array(
						'title_li' => ''
					);
				wp_list_categories($cat_list_args);
				?>
			</ul>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->


	<div id="content" class="site_content">
