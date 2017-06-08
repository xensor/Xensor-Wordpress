<div class="wrap">
	<h1 class="wp-heading-inline">Xensor's Rules</h1>

 <a href="admin.php?page=xensor_rules_add" class="page-title-action">Add New</a>
<hr class="wp-header-end">

		<table class="wp-list-table widefat fixed posts">
	<thead>
		<tr>
			<th>ID</th>
            <th>Name</th>
            <th>Options</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>ID</th>
            <th>Name</th>
            <th>Options</th>
		</tr>
	</tfoot>
	<tbody>
	<?php
	global $wpdb;
	$maint = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'rules' );
	if(count($maint) > 0){
		
	
	foreach($maint as $row){
		
	
	echo"<tr>
	<td>$row->id</td>
	<td>$row->name</td>
	<td><a href='admin.php?page=xensor_rules&id=$row->id'>Delete</a> <a href='admin.php?page=xensor_rules_edit&id=$row->id'>Edit</a></td>
	</tr>";
		
			
		}
		}else{
			echo"<tr>
			<td colspan='3'>Sorry no results</td>
			</tr>";
		}
		?>
	</tbody>
</table>
<?php
if(filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT) != Null){
	global $wpdb;
	$wpdb->delete( ''.$wpdb->prefix.'rules', array( 'ID' => filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT) ) );
	?>
	<div class="updated">
  <p> <strong>
   <?php $wpdb->print_error(); ?>  
    <?php _e('Options saved.' ); ?>
    </strong> </p>
</div>
	<?php
}
?>
	</div>