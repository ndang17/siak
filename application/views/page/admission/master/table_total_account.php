<table class="table table-striped table-bordered table-hover table-checkable datatable">
	<thead>
		<tr>
			<?php foreach ($getColoumn['query'] as $key ): ?>
				<th><?php echo $key->Field ?></th>
			<?php endforeach ?>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($getData as $key): ?>
		<tr>
			<?php for ($i=0; $i < count($getColoumn['field']); $i++) { ?>
						<?php if($getColoumn['field'][$i] == 'Active'): ?>
							<?php if ($key->$getColoumn['field'][$i] == 1): ?>
								<td><i class="fa fa-check-circle" style="color: green;"></i></td>	
							<?php else: ?>
								<td><i class="fa fa-minus-circle" style="color: red;"></i></td>
							<?php endif ?>
						<?php else: ?>
							<td><?php echo $key->$getColoumn['field'][$i] ?></td>	
						<?php endif ?>
			<?php } ?>
							<td>
								<div class="btn-group">
								  <span data-smt="<?php echo $key->$getColoumn['field'][0] ?>" class="btn btn-xs btn-edit">
								    <i class="fa fa-pencil-square-o"></i> Edit
								   </span>
								   <span data-smt="<?php echo $key->$getColoumn['field'][0] ?>" class="btn btn-xs btn-Active" data-active = "<?php echo $key->Active ?>">
								     <i class="fa fa-hand-o-right"></i> Change Active
								    </span>
								   <span data-smt="<?php echo $key->$getColoumn['field'][0] ?>" class="btn btn-xs btn-delete">
								     <i class="fa fa-trash"></i> Delete
								    </span>
								</div>
							</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
