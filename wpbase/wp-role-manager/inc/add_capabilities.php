<?php 
do_action('wp_role_manager_header');
$roleManager = new roleManager();
?>
<div class="container wprm-wrapper">
	<div class="row btn-row">
		<div class="col-xs-10">
			<a href="?page=wp-role-manager" class="btn btn-default"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Roles</a>
			<a href="?page=wp-role-manager-add-new" class="btn btn-default"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Add New Role</a>
			<a href="?page=wp-role-manager-add-capabilities" class="btn btn-default"><i class="fa fa-user-secret" aria-hidden="true"></i>&nbsp;Add New Capabilities</a>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-10">
			<form id="emailForm" role="form" data-toggle="validator" class="form-horizontal">
				<div class="form-group">
					<label for="role" class=" col-md-2 col-xs-4" >
						<?php _e('Role', 'framework') ?>
					</label>
					<div class="col-md-4 col-xs-8">
						<select class="form-control" name="role" id="role" value="" class="form-control required" required>
							<option value="">--- Select the role ---</option>
							<?php 
							$editableRoles = $roleManager->get_all_user_roles();
							unset($editableRoles['administrator']);
							?>

							<?php foreach ($editableRoles as $key => $value): ?>
							<option value="<?php echo $key;?>"><?php echo $value["name"];?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="role" class=" col-md-2 col-xs-4" >
					<?php _e('Capability', 'framework') ?>
				</label>
				<div class="col-md-4 col-xs-8">
					<input type="text" class="form-control" name="capability" id="capability" value="" class="form-control required" required/>
				</div>
			</div>	
			<div class="form-group">
				<button class="btn btn-default" type="button">Add</button>
			</div>
		</form>
	</div>
</div>
</div>
