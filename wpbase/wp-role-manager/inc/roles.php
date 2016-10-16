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
			<?php 
			$editableRoles = $roleManager->get_all_user_roles();
			// unset($editableRoles['administrator']);
			foreach ($editableRoles as $key => $value) :
			?>
			<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#collapse-<?php echo $key;?>"><i class="fa fa-th"></i>&nbsp;<?php echo $value["name"];?></a>

							</h4>
						</div>
						<div id="collapse-<?php echo $key;?>" class="panel-collapse collapse">
							<div class="panel-body">
								<?php foreach ($value["capabilities"] as $ckey => $cvalue): ?>
								<div class="form-group">
									<label for="<?php echo $ckey;?>" class=" col-md-4" >
										<?php _e($ckey, 'framework') ?>
									</label>
									<div class="col-md-1">
										<input type="checkbox" class="form-control" name="<?php echo $ckey;?>" value="<?php echo $cvalue;?>" <?php echo ($cvalue)?'checked':'';?> />
									</div>
								</div>
								<?php endforeach ?>
							</div>
							<div class="panel-footer"></div>
						</div>
					</div>
				</div>
			<?php endforeach;?>
		</form>
		</div>
	</div>
</div>
