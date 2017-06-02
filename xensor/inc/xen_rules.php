<div class="wrap">
	<h1 class="wp-heading-inline">Xensor's Rules</h1>

 <a href="http://localhost/pixel/wp-admin/admin.php?page=xensor_rules_add" class="page-title-action">Add New</a>
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
	$maint = $wpdb->get_results( 'SELECT * FROM wp_rules' );
	if(count($maint) > 0){
		
	
	foreach($maint as $row){
		
	
	echo"<tr>
	<td>$row->id</td>
	<td>$row->name</td>
	<td><a href='admin.php?page=xensor_rules&id=$row->id'>Delete</a></td>
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
if(isset($_GET['id'])){
	global $wpdb;
	$wpdb->delete( 'wp_rules', array( 'ID' => $_GET['id'] ) );
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