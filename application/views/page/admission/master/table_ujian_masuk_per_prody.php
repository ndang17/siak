<table class="table table-striped table-bordered table-hover table-checkable datatable">
	<thead>
		<tr>
			<?php for ($i = 0; $i < count($getColoumn['query']); $i++): ?>
				<th><?php echo $getColoumn['query'][$i] ?></th>
			<?php endfor; ?>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php for ($i = 0; $i < count($getData); $i++): ?>
			<tr>
				<?php if($getData[$i]['Active'] == 1): ?>
					<?php $status = '<td><i class="fa fa-check-circle" style="color: green;"></i></td>' ?>
					
				<?php else: ?>
					<?php $status = '<td><i class="fa fa-minus-circle" style="color: red;"></i></td>' ?>
				<?php endif ?>
				<td><?php echo $getData[$i]['ID'] ?></td>
				<td><?php echo $getData[$i]['NamaProgramStudy'] ?></td>
				<td><?php echo $getData[$i]['NamaUjian'] ?></td>
				<td><?php echo $getData[$i]['Bobot'] ?></td>
				<?php echo $status ?>
				<td><?php echo $getData[$i]['CreateAT'] ?></td>
				<td>
					<div class="btn-group">
					  <span data-smt="<?php echo $getData[$i]['ID'] ?>" class="btn btn-xs btn-edit">
					    <i class="fa fa-pencil-square-o"></i> Edit
					   </span>
					   <span data-smt="<?php echo $getData[$i]['ID'] ?>" class="btn btn-xs btn-Active" data-active = "<?php echo $getData[$i]['Active'] ?>">
					     <i class="fa fa-hand-o-right"></i> Change Active
					    </span>
					   <span data-smt="<?php echo $getData[$i]['ID'] ?>" class="btn btn-xs btn-delete">
					     <i class="fa fa-trash"></i> Delete
					    </span>
					</div>
				</td>
			</tr>		
		<?php endfor; ?>	
	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function() {
		LoaddataTable('.datatable');
	}); // exit document Function	
</script>
