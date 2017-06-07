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
* Description:       This plugin allows you to enable maintenace, place banned members in a time out, set up rules and also verify minecraft accounts.
* Version:           1.0.3
* Author:            Xensor, ChuChuYokai
* Author URI:        http://www.pixelmonmemories.ml
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       xensor-maintenance
* Domain Path:       /languages
*/

// Include the dependencies needed to instantiate the plugin.
foreach ( glob( plugin_dir_path( __FILE__ ) . 'include/*.php' ) as $file ) {
  include_once $file;
}
$plugin = new xen_mine();
add_action( 'plugins_loaded', 'maint_admin_action' );
/**
* Starts the plugin.
*
* @since 1.0.0
*/

function maint_admin_action()
{
  $plugin = new xen_mine();

  $plugin->init();

}

function activate_plugin_name()
{
  $role = get_role( 'Editor' );
}
// Register our activation hook
register_activation_hook( __FILE__, 'activate_plugin_name' );

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


function redirect_member()
{
  $plugin = new xen_mine();
  $plugin->redirect_members();


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
  $plugin = new xen_mine();
  $plugin->save_posts();
  ?>
  <div class="updated">
    <p>
      <strong>
        <?php _e('Options saved.' ); ?>
      </strong>
    </p>
  </div>
  <?php

}

function rules()
{
  include(plugin_dir_path(__FILE__) . 'inc/xen_rules.php');
}

function add_rules()
{
  include(plugin_dir_path(__FILE__) . 'inc/xen_rules_add.php');

}


function show_rules()
{


  global $wpdb;
  $maint = $wpdb->get_results( 'SELECT * FROM wp_rules' );

  if (count($maint) > 0) {

    $short = "<ol>";
    foreach ($maint as $row) {

      if ($row->entry == '') {
        $short .= "<li>$row->name</li>";
      }
      else {
        $short .= "
        <h2>$row->name</h2>
        ".wpautop($row->entry)."
        ";
      }



    }
  }
  else {
    echo"<li>Sorry nothing found</li>";
  }

  $short .= '</ol>';
  return $short;
}
function show_rules_shortcode( $atts )
{

  global $wpdb;
  $maint = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'rules' );
  // Attributes
  $atts  = shortcode_atts(
    array(
      'list'=> 'false',
    ),
    $atts,
    'show_rules'
  );



  if ($atts['list'] == 'false') {
    if (count($maint) > 0) {
      $short = "";
      foreach ($maint as $row) {

        if ($row->entry != '' || $atts['list'] == 'false') {


          $short .= "
          <h2>$row->name</h2>
          ".wpautop($row->entry)."
          ";
        }
        else {
          $short .= "<li>$row->name</li>";
        }


      }
    }
    else {
      $short .= "<p>Sorry nothing found</p>";
    }
    $short .= '';
    return $short;
  }

  else {
    if (count($maint) > 0) {
      $short = "<ol>";
      foreach ($maint as $row) {

        if ($row->entry != '' || $atts['list'] == 'false' ) {


          $short .= "
          <h2>$row->name</h2>
          ".wpautop($row->entry)."
          ";
        }
        else {
          $short .= "<li>$row->name</li>";
        }


      }
    }
    else {
      $short .= "<p>Sorry nothing found</p>";
    }
    $short .= '</ol>';
    return $short;
  }


}

function save_rules()
{
  $plugin = new xen_mine();
  $plugin->save_rule();
  ?>

  <div class="updated">
    <p>
      <strong>

        <?php _e('Options saved.' ); ?>
      </strong>
    </p>
  </div>
  <?php
}

function edit_rules()
{
  if (filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT) != NULL) {
    $id = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);
  }
  else {
    $id = NULL;
  }
  $plugin = new xen_mine();
  $plugin->edit_rule($id);
  ?>

  <div class="updated">
    <p>
      <strong>

        <?php _e('Options saved.' ); ?>
      </strong>
    </p>
  </div>
  <?php
}

function show_edit_rules()
{
  include(plugin_dir_path(__FILE__) . 'inc/xen_rules_edit.php');

}




// The JavaScript
function my_action_javascript()
{
  //Set Your Nonce
  $ajax_nonce = wp_create_nonce( 'my-special-string' );
  ?>
  <script>
    jQuery(document).ready(function($){
        jQuery('#submit').click(function () {
            var users = jQuery('#user').val();
            var data = {
              action: 'my_action',
              security: '<?php echo $ajax_nonce; ?>',
              user: jQuery('#user').val(),
            };

            // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
            $.post( ajaxurl, data, function( response)  {
                jQuery('#feedback').html(response);
              });
          });
      });
  </script>
  <?php
}
add_action( 'admin_footer', 'my_action_javascript' );

// The function that handles the AJAX request
function my_action_callback()
{


  check_ajax_referer( 'my-special-string', 'security' );
  if (check_ajax_referer( 'my-special-string', 'security' ) != NULL) {


    $filename = plugin_dir_path( __FILE__ ) . '/inc/include/mojang-api.class.php';

    if (file_exists($filename)) {
      require($filename );

    }
    else {
      die( "The file $filename does not exist");
    }

    $user = filter_input(INPUT_POST, 'user');
    $uuid = MojangAPI::getUuid($user);

    echo "<table class='wp-list-table widefat fixed posts'>
    ";

  // Print player's head
      $img = '<img src="' . MojangAPI::embedImage(MojangAPI::getPlayerHead($uuid)) . '" alt="Head of MTC">';
      echo  ("<tr>
      <th>&nbsp;</th>
      <td colspan='2' align='center'>$img</td>
      </tr>");
    if (!empty($uuid)) {
      echo  ("<tr><th>User ID:</th>
      <td align='center'>$uuid</td>
      </tr>");

      // Get his name history
      $history = MojangAPI::getNameHistory($uuid);
      echo "<tr><th>First Name:</th>
      <td align='center'>". reset($history)['name'] ."</td>
      </tr>";
      

    
    }
    else {
      echo  ("<tr>
      <td colspan='2' align='center'>User is not valid</td>
      </tr>");
    }

    echo "</table>";
  }
  else {
    echo"<strong>Sorry but the security code is incorrect</strong>";
  }
  die(); // this is required to return a proper result
}
add_action( 'wp_ajax_my_action', 'my_action_callback' );


function my_custom_dashboard_widgets()
{
  global $wp_meta_boxes;

  wp_add_dashboard_widget('custom_help_widget', 'Minecraft Username Verification', 'custom_dashboard_help');
}

function custom_dashboard_help()
{
  include(plugin_dir_path(__FILE__) . 'inc/xen_mine.php');
}

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
add_shortcode('banned','redirect_member');
add_shortcode( 'showrules', 'show_rules_shortcode' );
add_action('show_rules','show_rules');
register_uninstall_hook(__FILE__, 'maint_uninstall');
//add_action('admin_menu', 'maint_admin_action');
add_action('wp', 'redirect_member');
?>
