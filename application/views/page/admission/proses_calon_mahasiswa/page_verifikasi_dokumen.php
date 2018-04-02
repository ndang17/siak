<style type="text/css">
	.btn-reject {
		background-color: #e20f0f;
	}
	.btn-approve{
		background-color: #1ace37;
	}
</style>

<?php for ($i = 0; $i < count($datadb['data']); ++$i): ?>
	<div class = "row">
		<div class="col-xs-2" style="">
			<label class="control-label">Nama :</label>
			<br>
			<label class="control-label"><?php echo $datadb['data'][$i]['Name'] ?> </label>
		</div>
		<div class="col-xs-2" style="">
			<label class="control-label">Email :</label>
			<br>
			<label class="control-label"><?php echo $datadb['data'][$i]['Email'] ?> </label>
		</div>
		<div class="col-xs-2" style="">
			<label class="control-label">No Hp :</label>
			<br>
			<label class="control-label"><?php echo $datadb['data'][$i]['PhoneNumber'] ?> </label>
		</div>
	</div>
	<br>
	<div class = "row">	
		<div class="col-xs-2" style="">
			<label class="control-label">Program Study :</label>
			<br>
			<label class="control-label"><?php echo $datadb['data'][$i]['Name_programstudy'] ?> </label>
		</div>
		<div class="col-xs-2" style="">
			<label class="control-label">Alamat :</label>
			<br>
			<label class="control-label"><?php echo $datadb['data'][$i]['Alamat'] ?> </label>
		</div>
		<div class="col-xs-2" style="">
			<label class="control-label">Sekolah :</label>
			<br>
			<label class="control-label"><?php echo $datadb['data'][$i]['SMA'] ?> </label>
		</div>
	</div>
	<div id = "tblData" class="table-responsive">
		<table class="table table-striped table-bordered table-hover table-checkable">
			<caption><strong>List Dokumen <?php echo $datadb['data'][$i]['Name'] ?></strong></caption>
			<thead>
				<tr>
					<th class="checkbox-column">
						<input type="checkbox" class="uniform" value="nothing;nothing;nothing;nothing;nothing" id ="dataResultCheckAll<?php echo $i ?>">
					</th>
					<th class="hidden-xs">No</th>
					<th>Dokumen</th>
					<th>Required</th>
					<th>Attachment</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; ?>
				<?php for ($j = 0; $j < count($datadb['data'][$i]['document']); ++$j): ?>
					<tr>
						<td class="checkbox-column">
					  		<input type="checkbox" class="uniform" value ="<?php echo $datadb['data'][$i]['document'][$j]['ID_register_document'] ?>">
					  	</td>
						<td><?php echo $no ?></td>
						<td><?php echo $datadb['data'][$i]['document'][$j]['DocumentChecklist'] ?></td>
						<td><?php echo $datadb['data'][$i]['document'][$j]['Required'] ?></td>
						<td><?php echo $datadb['data'][$i]['document'][$j]['Attachment'] ?></td>
						<td><?php echo $datadb['data'][$i]['document'][$j]['Status'] ?></td>
					</tr>
				<?php $no++; ?>	
				<?php endfor; ?>	
			</tbody>
		</table>
	</div>
	<div class="col-xs-12" align = "right">
	   <button class="btn btn-inverse btn-notification btn-reject" id="btn-reject<?php echo $i ?>">Reject</button>
	   <button class="btn btn-inverse btn-notification btn-approve" id="btn-approve<?php echo $i ?>">Approve</button>
	</div>
	<br>
	<script type="text/javascript">
		$(document).on('click','#dataResultCheckAll<?php echo $i ?>', function () {
			$('input.uniform').not(this).prop('checked', this.checked);
		});
	</script>
<?php endfor; ?>

