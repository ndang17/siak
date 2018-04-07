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
					<th class="checkbox-column">
						<input type="checkbox" class="uniform" value="nothing" id ="dataResultCheckAll">
					</th>
					<th>Tahun</th>
					<th>Formulir Code</th>
					<th style="width: 100px;">Activated by Candidate</th>
					<th>Status Jual</th>
					<!-- <th>Jual Oleh</th> -->
					<th>Nama Candidate</th>
					<th>Email</th>
					<th>Sekolah</th>
				</tr>
			</thead>
			<tbody> 
				<?php for ($i = 0; $i < count($datadb); $i++): ?>
							 <tr>
							 	<?php if ($datadb[$i]['StatusUsed'] == 1 && $datadb[$i]['StatusJual'] == 1): ?>
							 		<td></td>
							 	<?php else: ?>
						 			<td class="checkbox-column">
						 				<input type="checkbox" class="uniform" value ="<?php echo $datadb[$i]['FormulirCode'] ?>">
						 		  	</td>
							 	<?php endif ?>
						 		
							 	<td><?php echo $datadb[$i]['Years'] ?></td>
							 	<td><?php echo $datadb[$i]['FormulirCode'] ?></td>
							 	<?php if ($datadb[$i]['StatusUsed'] == 0): ?>
							 		<?php $status_used = '<td style="color:  green;">No</td>'; ?>
							 	<?php else: ?>
							 		<?php $status_used = '<td style="color:  red;">Yes</td>'; ?>
							 	<?php endif ?>
							 	<?php echo $status_used ?>
							 	<?php if ($datadb[$i]['StatusJual'] == 0): ?>
							 		<?php $status_jual = '<td style="color:  green;">IN</td>'; ?>
							 	<?php else: ?>
							 		<?php $status_jual = '<td style="color:  red;">Sold Out</td>'; ?>
							 	<?php endif ?>
							 	<?php echo $status_jual ?>
							 	<td><?php echo $datadb[$i]['NameCandidate'] ?></td>
							 	<td><?php echo $datadb[$i]['Email'] ?></td>
							 	<td><?php echo $datadb[$i]['SchoolName'] ?></td>
							 </tr>
				<?php endfor; ?>
			</tbody>
		</table>
	</div>			
	<div class="col-xs-12" align = "right">
	   <button class="btn btn-inverse btn-notification btn-approve" id="btn-approve">Confirm</button>
	</div>
	<!-- <br> -->
	<!-- <hr class="style-eight" /> -->
	<script type="text/javascript">
		$(document).on('click','#dataResultCheckAll', function () {
			$('input.uniform').not(this).prop('checked', this.checked);
		});

		$(document).on('click','#btn-approve', function () {
			loading_button('#btn-approve');
			var FormulirCode_arr = getValueChecbox('.tableData');
			  // console.log(ID_register_document);
			 if (FormulirCode_arr.length == 0) {
			 	toastr.error("Silahkan checked dahulu", 'Failed!!');
			 }
			 else
			 {
			 	//var getAllRegisterID;
				 $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Apakah anda yakin untuk melakukan request ini ?? </b> ' +
				     '<button type="button" id="confirmYesProcess" class="btn btn-primary" style="margin-right: 5px;" data-pass = "'+FormulirCode_arr+'" action = "approve">Yes</button>' +
				     '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
				     '</div>');
				 $('#NotificationModal').modal('show');
		 		 
			 }
			 $('#btn-approve').prop('disabled',false).html('Approve');

		});

		function getValueChecbox(element)
		{
		     var allVals = [];
		     $('.tableData :checked').each(function() {
		       allVals.push($(this).val());
		     });
		     return allVals;
		}
	</script>

	<script type="text/javascript">
	$(document).on('click','#confirmYesProcess', function () {
		$('#NotificationModal .modal-header').addClass('hide');
		$('#NotificationModal .modal-body').html('<center>' +
		    '                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>' +
		    '                    <br/>' +
		    '                    Loading Data . . .' +
		    '                </center>');
		$('#NotificationModal .modal-footer').addClass('hide');
		$('#NotificationModal').modal({
		    'backdrop' : 'static',
		    'show' : true
		});

		var url = base_url_js+'admission/distribusi-formulir/formulir-offline/submit_sellout';
		var data_passing = $(this).attr('data-pass');
		var action = $(this).attr('action');
		var data = {
		    data_passing : data_passing,
		    action : action,
		};
		console.log(data_passing);

		var token = jwt_encode(data,"UAP)(*");
			$.post(url,{token:token},function (data_json) {
			    setTimeout(function () {
			       toastr.options.fadeOut = 10000;
			       toastr.success('Data berhasil disimpan', 'Success!');
			       loadData(1);
			       $('#NotificationModal').modal('hide');
			    },500);
			});
	});
	</script>
<?php else: ?>
<div align = 'center'>No Result Data...</div>		
<?php endif ?>


