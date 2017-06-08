<?php
class xen_mine
{
  /**
  * A reference the class responsible for rendering the submenu page.
  *
  * @var    Submenu_Page
  * @access private
  */

  /**
  * Adds a submenu for this plugin to the 'Tools' menu.
  */
  public function init()
  {
    add_action( 'admin_menu', array($this,'add_options_page' ));
  }
  /**
  * Creates the submenu item and calls on the Submenu Page object to render
  * the actual contents of the page.
  */
  public function add_options_page()
  {
    add_menu_page( 'Xensor', 'Xensor', 'edit_pages', 'xensor', 'maintenance', 'dashicons-admin-settings', 2  );

    add_submenu_page( 'xensor', 'Xensor Maintenance', 'Xensor Maintenance', 'edit_pages', 'xensor', 'maintenance' );
    add_submenu_page( 'xensor', 'Xensor Rules', 'Xensor Rules', 'edit_pages', 'xensor_rules', 'rules' );
    add_submenu_page( 'xensor', 'Xensor Minecraft', 'Xensor Minecraft', 'edit_pages', 'xensor_minecraft', 'minecraft' );
    add_submenu_page( 'xensor', 'Add new Rules', 'Add new Rules', 'edit_pages', 'xensor_rules_add', 'add_rules' );
    add_submenu_page( null, "Editing $name Rules", "Editing $name Rules", 'edit_pages', 'xensor_rules_edit', 'show_edit_rules' );

  }
  public function save_posts()
  {
    //Form data sent
    $dbhost          = filter_input(INPUT_POST, 'ban_id',FILTER_VALIDATE_INT);

    $dbname          = filter_input(INPUT_POST, 'staff_id',FILTER_VALIDATE_INT);

    $dbuser          = filter_input(INPUT_POST, 'gym_leader',FILTER_VALIDATE_INT);

    $dbpwd           = filter_input(INPUT_POST, 'maint_url');

    $prod_img_folder = filter_input(INPUT_POST, 'ban_url');
    $maint_status    = filter_input(INPUT_POST, 'maint_status');
    $banned_page     = filter_input(INPUT_POST, 'ban_page',FILTER_VALIDATE_INT);
    $maint_pages     = filter_input(INPUT_POST, 'maint_page',FILTER_VALIDATE_INT);
     $login_pages     = filter_input(INPUT_POST, 'login_page',FILTER_VALIDATE_INT);
    global $wpdb;
    if (isset($dbhost) && isset($dbname) && isset($dbuser) && isset($dbpwd) && isset($prod_img_folder) && isset($maint_status) && isset($maint_pages) && isset($banned_page)) {
      $table_name = $wpdb->prefix . 'maint';
      $wpdb->update( $table_name, array(
          'bid'       => $dbhost,
          'sid'       => $dbname,
          'gid'       => $dbuser,
          'mid'       =>$dbpwd,
          'ban_url'   => $prod_img_folder,
          'maint'     => $maint_status,
          'ban_page'  =>$banned_page,
          'maint_page'=> $maint_pages,
          'login_page'=>$login_pages,
        ),array('maint_id'=>1) );

      $maint = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'maint WHERE maint_id = 1', OBJECT );
      //Normal page display
      $bid     = $maint[0]->bid;
      $sid     = $maint[0]->sid;
      $gid     = $maint[0]->gid;
      $mid     = $maint[0]->mid;
      $ban_url = $maint[0]->ban_url;
      $maints  = $maint[0]->maint;
    }
  }

  public function save_rule()
  {
    global $wpdb;
    $name       = stripslashes( filter_input(INPUT_POST, 'name',FILTER_SANITIZE_STRING));
    $entry      = stripslashes( wpautop(filter_input(INPUT_POST, 'entry')));
    $table_name = $wpdb->prefix . 'rules';
    $wpdb->insert(
      $table_name,
      array(
        'name' => $name,
        'entry'=> $entry
      )
    );
  }

  public function redirect_members()
  {
    $user_id = get_current_user_id();
    $member  = MS_Factory::load( 'MS_Model_Member', $user_id );

    global $wpdb;
    $maint = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'maint WHERE maint_id = 1', OBJECT );
    //Normal page display
    $bid        = $maint[0]->bid;
    $sid        = $maint[0]->sid;
    $gid        = $maint[0]->gid;
    $mid        = $maint[0]->mid;
    $ban_url    = $maint[0]->ban_url;

    $maints     = $maint[0]->maint;
    $ban_page   = $maint[0]->ban_page;
    $maint_page = $maint[0]->maint_page;
    $login_page = $maint[0]->login_page;
    foreach ( $member->subscriptions as $subscription ) {
      $membership = MS_Factory::load( 'MS_Model_Membership', $subscription->membership_id );
      // membership level matches the banned one
      if ( $membership->id == $bid  ) {
        if (is_page($ban_page)):
        wp_redirect( $ban_url );
        exit;
        endif;
      }
      elseif ( $membership->id == $sid || $membership->id == $gid ) {
        if (get_the_ID() != $maint_page && get_the_ID() != $login_page) {
          if ($maints == 'yes') {
            if (get_the_ID() != 29761) {
              wp_redirect( $mid );
              exit;
            }
          }
        }

      }
    }
  }

  public function edit_rule($id)
  {

    global $wpdb;
    $name       = stripslashes( filter_input(INPUT_POST, 'name'));
    $entry      = stripslashes( wpautop(filter_input(INPUT_POST, 'entry')));
    $table_name = $wpdb->prefix . 'rules';
    $wpdb->update(
      $table_name,
      array(
        'name' => $name,
        'entry'=> $entry
      ),array('id'=>$id));
  }

  public function my_action($filename)
  {


    check_ajax_referer( 'my-special-string', 'security' );
    if (check_ajax_referer( 'my-special-string', 'security' ) != NULL) {




      if (file_exists($filename)) {
        require($filename );

      }
      else {
        die( "The file $filename does not exist");
      }

      $user = filter_input(INPUT_POST, 'user');
      $uuid = MojangAPI::getUuid($user);

      echo "<div class='updated'> <p>
      <strong>";


      if (!empty($uuid)) {
        echo  ("<dt>User id:</dt>
          <dd>$uuid</dd>");

        // Get his name history
        $history = MojangAPI::getNameHistory($uuid);
        echo  ('First username: <b>' . reset($history)['name'] . '</b><br>');

        // Print player's head
        $img = '<img src="' . MojangAPI::embedImage(MojangAPI::getPlayerHead($uuid)) . '" alt="Head of MTC">';
        echo  ('Skin:<br>' . $img . '<br>');
      }
      else {
        echo  ("User is not valid");
      }

      echo "</strong></p></div>";
    }
    else {
      echo"<strong>Sorry but the security code is incorrect</strong>";
    }
    die(); // this is required to return a proper result
  }
}
?>