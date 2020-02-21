<?php
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

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

function add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
}

add_action( 'wp_head', 'add_viewport_meta_tag' , '1' );


function register_widget_areas() {

  register_sidebar( array(
    'name'          => 'Footer area one',
    'id'            => 'footer_area_one',
    'description'   => 'This widget area discription',
    'before_widget' => '<section class="footer-area footer-area-one">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
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

wp_register_script( 'jQuery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', null, null, true );
wp_enqueue_script('jQuery');

function leadB2C_customize_scripts(){
	var_dump(get_bloginfo('template_url').'/assets/js/main.js');
	wp_enqueue_script('main.js', get_bloginfo('template_url').'/assets/js/main.js', array('jquery'));
}
add_action( 'wp_footer', 'leadB2C_customize_scripts' );

function admin_script(){
	var_dump(get_bloginfo('template_url').'/assets/js/main.js');
	wp_enqueue_script('admin_script.js', get_bloginfo('template_url').'/assets/js/admin_script.js');
}

add_action( 'admin_enqueue_scripts', 'admin_script' );


function review_menu() {
  add_menu_page(
      'review_menu_page',
      'Reviews',
      'manage_options',
      'review_page_slug',
      'view_review_render',
      'dashicons-star-filled'
     );
	add_submenu_page(
		'review_page_slug',
		'review_menu_page',
		'Add review',
    'manage_options',
		'sub_menu_item_one_review',
		'add_review_render'
	);
}
add_action('admin_menu', 'review_menu');


/////////////////////////////////////////////////////////////////////////////////
//Overview all Reviews
/////////////////////////////////////////////////////////////////////////////////

function view_review_render() {
	global $wpdb;
	$all_reviews = $wpdb->get_results( "SELECT * FROM wp_reviews");
	?>
	<style>
	table {
	  font-family: arial, sans-serif;
	  border-collapse: collapse;
	  max-width: 100%;
	}

	td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

	tr:nth-child(even) {
	  background-color: #dddddd;
	}
</style>
	<table>
	  <tr>
	    <th>ID</th>
	    <th>First name</th>
	    <th>Last name</th>
			<th>Company name</th>
			<th>KVK-Nummer</th>
			<th>Rating</th>
			<th>Message</th>
			<th>Created</th>
			<th>Last Modified</th>
			<th>Delete</th>
			<th>Edit</th>
	  </tr>
		<?php
		foreach ( $all_reviews as $review ) {
			?>
			<tr>
		    <td><?= $review->id; ?></td>
		    <td><?= $review->first_name; ?></td>
		    <td><?= $review->last_name; ?></td>
				<td><?= $review->company_name; ?></td>
				<td><?= $review->kvk_number; ?></td>
				<td><?= $review->rating; ?></td>
				<td><?= $review->message; ?></td>
				<td><?= $review->created; ?></td>
				<td><?= $review->last_modified; ?></td>
				<td><button type="submit" id="delete_review">Delete</button></td>
				<td><button type="submit" id="edit_review">Edit</button></td>
		  </tr>
			<?php
		}
		 ?>


	</table>
	<?php
}

/////////////////////////////////////////////////////////////////////////////////
//Add Reviews
/////////////////////////////////////////////////////////////////////////////////

function add_review_render() {
	global $wpdb;
	$reviews_table_name = $wpdb->prefix . 'reviews';
	$sql = "CREATE TABLE {$reviews_table_name} (
				id INT NOT NULL auto_increment,
				first_name varchar(25) NULL,
				last_name varchar(25) NULL,
				company_name varchar(50) NULL,
				kvk_number int(50) NULL,
				rating tinyint(1) NULL,
				message text NULL,
				created datetime DEFAULT CURRENT_TIMESTAMP,
				last_modified datetime DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY  (id))";

	dbDelta($sql);

	if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "submit_review") {
		$fields = array(
					'review_first_name',
					'review_last_name',
					'review_company_name',
					'review_kvk_number',
					'review_rating',
					'review_message'
				);

				foreach ($fields as $field) {
					if (isset($_POST[$field])) {
						$_POST[$field] = stripslashes(trim($_POST[$field]));
					}
				}

		$review_first_name = $_POST['review_first_name'];
		$review_last_name = $_POST['review_last_name'];
		$review_company_name = $_POST['review_company_name'];
		$review_kvk_number = $_POST['review_kvk_number'];
		$review_rating = $_POST['review_rating'];
		$review_message = $_POST['review_message'];

		$insert_review = "INSERT INTO $reviews_table_name
		(id, first_name, last_name, company_name, kvk_number, rating, message, created, last_modified)
		VALUES
		(NULL, '$review_first_name', '$review_last_name', '$review_company_name', '$review_kvk_number', '$review_rating', '$review_message', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
		$insert_result = $wpdb->query($insert_review);
		var_dump($insert_review);

	}
	?>


	<div class="padding_article">

	<div class="article-content" style="line-height: 3em;">
	<?php
		if($sub_success == 'Success') {
			echo '<div class="success">' . __( 'Thank you we will get back you soon.', 'post_new' ) . '</div>';
			$sub_success = null;
		}
		$errors = [];
		if (isset($errors) && sizeof($errors)>0 && $errors->get_error_code()) :
			echo '<ul class="errors">';
			foreach ($errors->errors as $error) {
				echo '<li>'.$error[0].'</li>';
			}
			echo '</ul>';
		endif;
	?>

	<h2>Review Form</h2>
	<span style="color: #000000;">Down below is a form where you can send your review.</span>
	 <form name="FindAPlate" id="FindAPlate" method="post" action="" >
	 <h3 class="cf_text">Your Details</h3>
		<table name="form_table_find_aPlate" >
			<tr>
				<td>First name*</td><td> <input  maxlength="150" size="30" title="" id="review_first_name" name="review_first_name" type="text" required /></td>
			</tr>
			<tr>
				<td>Last name</td><td> <input  maxlength="150" size="30" title="" id="review_last_name" name="review_last_name" type="text" /></td>
			</tr>
			<tr>
				<td>Company name</td><td> <input  maxlength="150" size="30" title="" id="review_company_name" name="review_company_name" type="text" /></td>
			</tr>
			<tr>
				<td>kvk number</td><td> <input  maxlength="150" size="30" title="" id="review_kvk_number" name="review_kvk_number" type="text" /></td>
			</tr>
			<tr>
				<td>Rating</td><td> <input  maxlength="150" size="30" title="" id="review_rating" name="review_rating" type="text" /></td>
			</tr>
			<tr>
				<td>Message</td><td><?php $kv_editor_args =  array('media_buttons' => false , 'teeny' => true ); wp_editor( '', 'review_message',  $kv_editor_args ); ?></td>
			</tr>
			<tr colspan="2" style="text-align: center;">
					<td>
						<input style="background-color: #F1F1F1; color: black; border: 1px solid #555555; border-radius: 4px;" colspan="1" type="hidden" name="action" value="submit_review" >
					</td>
					<td>
						<input style="background-color: #F1F1F1; color: black; border: 2px solid #555555; border-radius: 4px; width: 100%;" colspan="1" value="Submit" name="button_9" type="submit" />
					</td>
			</tr>
		</table>
	</form>
<?php } ?>
