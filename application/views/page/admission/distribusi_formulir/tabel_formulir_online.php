<style type="text/css">
	.btn-reject {
		background-color: #e20f0f;
	}
	.btn-approve{
		background-color: #1ace37;
	}

	hr.style-eight {
		height: 10px;
		border: 1;
		box-shadow: inset 0 9px 9px -3px rgba(11, 99, 184, 0.8);
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		-ms-border-radius: 5px;
		-o-border-radius: 5px;
		border-radius: 5px;
	}
</style>
<?php if (count($datadb) > 0 ): ?>
	<div id = "tblData" class="table-responsive">
		<table class="table table-striped table-bordered table-hover table-checkable tableData">
			<!-- <caption><strong>List Dokumen</strong></caption> -->
			<thead>
				<tr>
					<th>Tahun</th>
					<th>Formulir Code</th>
					<th style="width: 100px;">Activated by Candidate</th>
					<th>Nama Candidate</th>
					<th>Email</th>
					<th>Sekolah</th>
				</tr>
			</thead>
			<tbody> 
				<?php for ($i = 0; $i < count($datadb); $i++): ?>
							 <tr>
							 	<td><?php echo $datadb[$i]['Years'] ?></td>
							 	<td><?php echo $datadb[$i]['FormulirCode'] ?></td>
							 	<?php if ($datadb[$i]['StatusUsed'] == 0): ?>
							 		<?php $status_used = '<td style="color:  green;">No</td>'; ?>
							 	<?php else: ?>
							 		<?php $status_used = '<td style="color:  red;">Yes</td>'; ?>
							 	<?php endif ?>
							 	<?php echo $status_used ?>
							 	<td><?php echo $datadb[$i]['NameCandidate'] ?></td>
							 	<td><?php echo $datadb[$i]['Email'] ?></td>
							 	<td><?php echo $datadb[$i]['SchoolName'] ?></td>
							 </tr>
				<?php endfor; ?>
			</tbody>
		</table>
	</div>			
	<!-- <br> -->
	<!-- <hr class="style-eight" /> -->
	<script type="text/javascript">
		
	</script>
<?php else: ?>
<div align = 'center'>No Result Data...</div>		
<?php endif ?>


