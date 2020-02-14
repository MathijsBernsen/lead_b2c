<?php
function leadB2C_customize_register($wp_customize)
{
    //All sections, settings and controls
    //Create section
    $wp_customize->add_section('customize_navbar_page', array(
        'title' => __('Header', 'lead') ,
        'priority' => 30
    ));

    //Upload background image
    $wp_customize->add_setting('logo_upload', array(
        'default' => '#000000',
        'transport' => 'refresh'
    ));

    //Media control background
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'logo_upload', array(
        'label' => __('Logo', 'lead-b2c') ,
        'section' => 'customize_navbar_page',
        'settings' => 'logo_upload'
    )));
}

add_action('customize_register', 'leadB2C_customize_register');

function add_viewport_meta_tag()
{
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
}

add_action('wp_head', 'add_viewport_meta_tag', '1');

function register_widget_areas()
{

    register_sidebar(array(
        'name' => 'Footer area one',
        'id' => 'footer_area_one',
        'description' => 'This widget area discription',
        'before_widget' => '<section class="footer-area footer-area-one">',
        'after_widget' => '</section>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));

}

add_action('widgets_init', 'register_widget_areas');

function leadB2C_customize_css()
{
?>
	<style type="text/css">

		.logo_container {
			background:	url("<?php echo wp_get_attachment_url(get_theme_mod('logo_upload')) ?>");
		}

	</style>
	<?php
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_head', 'leadB2C_customize_css');

function leadB2C_customize_scripts()
{
?>
  <script>alert("asd");</script>
  <?php
}
add_action('wp_footer', 'leadB2C_customize_scripts');

?>
