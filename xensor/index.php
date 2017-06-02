<?php
defined( 'ABSPATH' ) or die( 'Idiot, this is a unauthorize access. Do it again and you get banned.' );
/**
*
* @link              http://lostwebdesigns.com
* @since             1.0.0
* @package           Wp_Cbf
*
* @wordpress-plugin
* Plugin Name:       Xensor Maintenance
* Plugin URI:        http://www.pixelmonmemories.ml
* Description:       Ability to put website into maintenance and redirect banned members to a page
* Version:           1.0.1
* Author:            Xensor, ChuChuYokai
* Author URI:        http://www.pixelmonmemories.ml
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       xensor-maintenance
* Domain Path:       /languages
*/

function admin_register_heads()
{
	$siteurl = get_option('siteurl');
	$url     = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/yourstyle.css';
	echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
	/*echo '<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>';*/
}
//add_action('admin_head', 'admin_register_heads');

function maint_admin_action()
{
	add_menu_page( 'Xensor', 'Xensor Maintenance', 'manage_options', 'xensor', 'maintenance', 'dashicons-admin-settings', 200  );
	add_submenu_page( 'xensor', 'Xensor Rules', 'Xensor Rules', 'manage_options', 'xensor_rules', 'rules' );

	add_submenu_page( 'xensor', 'Xensor Minecraft', 'Xensor Minecraft', 'manage_options', 'xensor_minecraft', 'minecraft' );
	add_submenu_page( 'xensor', 'Add new Rules', 'Add new Rules', 'manage_options', 'xensor_rules_add', 'add_rules' );


}


function redirect_member($page)
{
	$user_id = get_current_user_id();
	$member  = MS_Factory::load( 'MS_Model_Member', $user_id );

	global $wpdb;
	$maint = $wpdb->get_results( 'SELECT * FROM wprh_maint WHERE maint_id = 1', OBJECT );
	//Normal page display
	$bid        = $maint[0]->bid;
	$sid        = $maint[0]->sid;
	$gid        = $maint[0]->gid;
	$mid        = $maint[0]->mid;
	$ban_url    = $maint[0]->ban_url;

	$maints     = $maint[0]->maint;
	$ban_page   = $maint[0]->ban_page;
	$maint_page = $maint[0]->maint_page;
	foreach( $member->subscriptions as $subscription ){
		$membership = MS_Factory::load( 'MS_Model_Membership', $subscription->membership_id );
		// membership level matches the banned one
		if( $membership->id == $bid  ){
			if(is_page($ban_page)):
			wp_redirect( $ban_url );
			exit;
			endif;
		}
		elseif( $membership->id == $sid || $membership->id == $gid ){
			if(get_the_ID() != $maint_page){
				if($maints == 'yes'){
					if(get_the_ID() != 29761){
						wp_redirect( $mid );
						exit;
					}
				}
			}

		}
	}


}
// And here goes the uninstallation function:
function maints_uninstall()
{

	// drop a custom database table
	global $wpdb;
	$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}maint");
}

function maintenance()
{

	include(plugin_dir_path(__FILE__) . 'inc/maint_admin.php');

	
}

function minecraft()
{
	include(plugin_dir_path(__FILE__) . 'inc/xen_mine.php');

}
function save_posts()
{
	//Form data sent
	$dbhost          = $_POST['ban_id'];

	$dbname          = $_POST['staff_id'];

	$dbuser          = $_POST['gym_leader'];

	$dbpwd           = $_POST['maint_url'];

	$prod_img_folder = $_POST['ban_url'];
	$maint_status    = $_POST['maint_status'];
	$banned_page     = $_POST['ban_page'];
	$maint_pages     = $_POST['maint_page'];
	global $wpdb;
	if(isset($dbhost) && isset($dbname) && isset($dbuser) && isset($dbpwd) && isset($prod_img_folder) && isset($maint_status) && isset($maint_pages) && isset($banned_page))
	{
		$table_name = $wpdb->prefix . 'maint';
		$wpdb->update( $table_name, array(
				'bid'       => $dbhost,
				'sid'       => $dbname,
				'gid'       => $dbuser,
				'mid'       =>$dbpwd,
				'ban_url'   => $prod_img_folder,
				'maint'     => $maint_status,
				'ban_page'  =>$banned_page,
				'maint_page'=> $maint_pages
			),array('maint_id'=>1) );

		$maint = $wpdb->get_results( 'SELECT * FROM wprh_maint WHERE maint_id = 1', OBJECT );
		//Normal page display
		$bid     = $maint[0]->bid;
		$sid     = $maint[0]->sid;
		$gid     = $maint[0]->gid;
		$mid     = $maint[0]->mid;
		$ban_url = $maint[0]->ban_url;
		$maints  = $maint[0]->maint;
		?>
<div class="updated">
  <p> <strong>
    <?php _e('Options saved.' ); ?>
    </strong> </p>
</div>
<?php
	}
}

function rules()
{
	include(plugin_dir_path(__FILE__) . 'inc/xen_rules.php');
}
function prfx_custom_meta() {
    add_meta_box( 'prfx_meta', __( 'Meta Box Title', 'prfx-textdomain' ), 'prfx_meta_callback', 'post' );
}

function prfx_meta_callback( $post ) {
    echo 'This is a meta box';  
}

function add_rules()
{
	include(plugin_dir_path(__FILE__) . 'inc/xen_rules_add.php');

}

function show_rules()
{
	
	
	global $wpdb;
	$maint = $wpdb->get_results( 'SELECT * FROM wp_rules' );
	if(count($maint) > 0){
		
	$short ="";
	foreach($maint as $row){
		
	
	$short .="
	<h2>$row->name</h2>
	".wpautop($row->entry)."
	";
		
			
		}
		}else{
			echo"<p>Sorry nothing found</p>";
		}
		
		
		return $short;
}

function save_rules()
{
	global $wpdb;
	$name = stripslashes( $_POST['name']);
	$entry =stripslashes( wpautop($_POST['entry']));
	$table_name = $wpdb->prefix . 'rules';
	$wpdb->insert( 
	$table_name, 
	array( 
		'name' => $name, 
		'entry' => $entry 
	) 
);
?>

<div class="updated">
  <p> <strong>
   <?php $wpdb->print_error(); ?>  
    <?php _e('Options saved.' ); ?>
    </strong> </p>
</div>
<?php
}
add_shortcode( 'showrules', 'show_rules' );
add_action('show_rules','show_rules');
register_uninstall_hook(__FILE__, 'maint_uninstall');
add_action('admin_menu', 'maint_admin_action');
add_action('template_redirect', 'redirect_members');
?>
