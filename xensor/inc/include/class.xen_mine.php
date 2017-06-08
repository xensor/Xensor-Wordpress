<?php
class xen_mine
{
	/**
	* A reference the class responsible for rendering the submenu page.
	*
	* @var    Submenu_Page
	* @access private
	*/
	private $submenu_page;

	/**
	* Initializes all of the partial classes.
	*
	* @param Submenu_Page $submenu_page A reference to the class that renders the
	*                                                                   page for the plugin.

	public function __construct(  )
	{

	}*/

	/**
	* Adds a submenu for this plugin to the 'Tools' menu.
	*/
	public function init()
	{
		add_action( 'admin_menu', array($this,'add_options_page' ) );
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
	}

	public function redirect_member($page)
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
				if(get_the_ID() != $maint_page && get_the_ID() != 30182){
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
	public function maintenances()
	{

		require(plugin_dir_path(__FILE__) . 'inc/maint_admin.php');


	}
}
?>