<?php 
do_action('smart_formsmanage_clients_header');
$smartFormclients = new smartFormclients();
?>
<div class="container wprm-wrapper">
	<div class="row btn-row">
		<div class="col-xs-12">
			<h1>Edit Client(s) Details</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-10">
			<form id="emailForm" method="post" role="form" data-toggle="validator" class="form-horizontal">
			<?php 
			global $wpdb;
			$result = $wpdb->get_results('select * from ce_rednao_smart_forms_entry');
			foreach ($result as $key => $value) :

				$client = json_decode($value->data);

			?>
			<div class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#collapse-<?php echo $key;?>"><i class="fa fa-th"></i>&nbsp;<?php echo $client->client_name->value;?></a>

							</h4>
						</div>
						<div id="collapse-<?php echo $key;?>" class="panel-collapse collapse">

							<form class="form-horizontal" role="form" name="client_save_<?php echo $value->entry_id;?>" method="POST">
							<div class="panel-body">
								<div class="form-group">
									<label for="<?php echo 'entry_id_'.$value->entry_id;?>" class=" col-md-4" >
										<?php _e('Entry ID', 'framework') ?>
									</label>
									<div class="col-md-6">
										<input type="hidden" class="form-control" name="entry_id" value="<?php echo $value->entry_id;?>"/>
										<?php echo $value->entry_id;?>
									</div>
								</div>
								<?php $fieldList = array(); ?>
								<?php foreach ($client as $skey=> $row): ?>
								<div class="form-group">
									<label for="<?php echo $ckey;?>" class=" col-md-4" >
										<?php _e(str_replace('_',' ', $skey), 'framework') ?>
									</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="<?php echo $skey;?>" value="<?php echo $row->value;?>" />
										<?php $fieldList[] = $skey; ?>
									</div>
								</div>
								<?php endforeach ?>
							</div>
							<div class="panel-footer">
								<div class="form-group align">
									<button type="reset" class="btn btn-default" name="<?php echo 'btn_reset_'.$value->entry_id;?>">
										Reset
									</button>
									<button type="submit" class="btn btn-default" name="<?php echo 'btn_submit_'.$value->entry_id;?>">
										Save
									</button>
								</div>
								<input type='hidden' value="<?php echo join(',',$fieldList);?>" /name="fieldSet">
							</div>
						</form>
						</div>
					</div>
				</div>
			<?php endforeach;?>
		</form>
		</div>
	</div>
</div>
