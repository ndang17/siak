<table class="table table-striped table-bordered table-hover table-checkable datatable">
	<thead>
		<tr>
			<?php foreach ($getColoumn['query'] as $key ): ?>
				<th><?php echo $key->Field ?></th>
			<?php endforeach ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($getData as $key): ?>
		<tr>
			<?php for ($i=0; $i < count($getColoumn['field']); $i++) { ?>
						<?php if($getColoumn['field'][$i] == 'sct_active'): ?>
							<?php if ($key->$getColoumn['field'][$i] == 1): ?>
								<td><i class="fa fa-check-circle" style="color: green;"></i></td>	
							<?php else: ?>
								<td><i class="fa fa-minus-circle" style="color: red;"></i></td>
							<?php endif ?>
						<?php else: ?>
							<td><?php echo $key->$getColoumn['field'][$i] ?></td>	
						<?php endif ?>
			<?php } ?>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function() {
		LoaddataTable('.datatable');
	}); // exit document Function	
</script>
