<?php
if($_POST['oscimp_hidden'] == 'Y')
{
	edit_rules();
}
else
{
	$id = (filter_input(INPUT_GET, 'id')) ? filter_input(INPUT_GET, 'id'):NULL;
	global $wpdb;
$maint = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'rules WHERE id = '.$id.'', OBJECT );
$name = $maint[0]->name;
}
?>
<div class='wrap'>
		<p>
			Enter the details about the Rules
		</p>
		<div class="field-container">
			<form name="oscimp_form"  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				<input type="hidden" name="oscimp_hidden" value="Y">
				<h2>
					Editing <?php echo $name;?>
				</h2>
				<p>
					<label>
						Title:
					</label>
					<input type="text" class="form-control input-sm" value='<?php echo $name;?>' name="name" >
				</p>
				<p>
					<label>
						Entry:
					</label>
					<?php
					$content = $maint[0]->entry;
$editor_id = 'mycustomeditor';
$settings = array(
							'textarea_name'=> 'entry',
							'textarea_rows'=> 10,
						);
wp_editor( $content, $editor_id,$settings );
					  ?>
					<hr/>


				</p>

 <p class="submit">
      <input type="submit" class="button-primary" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />
    </p>
			</form>
		</div>
	</div>