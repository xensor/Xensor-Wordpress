<?php
if($_POST['oscimp_hidden'] == 'Y')
{
	save_posts();
}
else
{
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
	?>
	<div class='wrap'>
		<p>
			Enter additional information about your location
		</p>
		<div class="field-container">
			<form name="oscimp_form"  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				<input type="hidden" name="oscimp_hidden" value="Y">
				<?php    echo "<h4>" . __( 'Maintenance Settings', 'oscimp_trdom' ) . "</h4>"; ?>
				<p>
					<label>
						Banned Group:
					</label>
					<input type="text" name="ban_id" value="<?php echo $bid;?>">
				</p>
				<p>
					<label>
						Default Id:
					</label>
					<input type="text"  name="staff_id" value="<?php echo $sid; ?>" size="20">
				</p>
				<p>
					<label>
						Guest Id:
					</label>
					<input type="text" name="gym_leader" value="<?php echo $gid; ?>" size="20" >
				</p>
				<hr />
				<?php    echo "<h4>" . __( 'Maint Url Settings', 'oscimp_trdom' ) . "</h4>"; ?>
				<p>
					<label>
						Maintenance Redirect:
					</label>
					<input type="text"  name="maint_url" value="<?php echo $mid;?>"/>
				</p>
				<p>
					<label>
						Banned Page:
					</label>
					<input type="text"  value="<?php echo $ban_url;?>" name="ban_url">
				</p>
				<p>
					<label>
						Ban Page ID:
					</label>
					<input type="text"  name="ban_page" value="<?php echo $ban_page; ?>" size="20">
				</p>
				<p>
					<label>
						Maintenance Page ID:
					</label>
					<input type="text" name="maint_page" value="<?php echo $maint_page; ?>" size="20" >
				</p>
				<p>
					<label>
						login Page ID:
					</label>
					<input type="text"  name="login_page" value="<?php echo $login_page; ?>" size="20">
				</p>
				<p>
					<label>
						<?php _e("Maintenance Status: " ); ?>
					</label>
					<select name="maint_status" >
						<option value='yes' <?php
if($maints == 'yes')
{
echo 'selected';
}
else
{

}?>>
							Yes
						</option>
						<option value='no' <?php
if($maints == 'no')
{
echo 'selected';
}
else
{

}?>>
							No
						</option>
					</select>
				</p>
				<p class="submit">
					<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />
				</p>
			</form>
		</div>



	</div>
	</div>
	<?php
}
?>

