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
			<form id="emailForm" method="post" role="form" data-toggle="validator" class="form-horizontal">
				<div class="form-group">
					<label for="role" class=" col-md-2" >
						<?php _e('Role', 'framework') ?>
					</label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="role" value="" class="form-control required" required/>
					</div>
				</div>
				<div class="form-group">
				<button class="btn btn-default" type="submit">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
