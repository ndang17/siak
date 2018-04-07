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
<hr class="style-eight" />
<?php for ($i = 0; $i < count($datadb['data']); $i++): ?>
	<div class = "row">
		<div class="col-xs-2" style="">
			<label class="control-label">Nama :</label>
			<br>
			<label class="control-label"><?php echo $datadb['data'][$i]['Name'] ?> </label>
		</div>
		<div class="col-xs-3" style="">
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
		<table class="table table-striped table-bordered table-hover table-checkable tableData<?php echo $i ?>">
			<caption><strong>List Dokumen <?php echo $datadb['data'][$i]['Name'] ?></strong></caption>
			<thead>
				<tr>
					<th class="checkbox-column">
						<input type="checkbox" class="uniform" value="nothing;nothing" id ="dataResultCheckAll<?php echo $i ?>">
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
				<?php $namaFile = 'nothing' ?>
				<?php for ($j = 0; $j < count($datadb['data'][$i]['document']); ++$j): ?>
				<?php 
					$attachment = "";
					 if ($datadb['data'][$i]['document'][$j]['Attachment'] != "") {
					 	$attachment = '<a href="'.$this->GlobalVariableAdi['url_registration'].'document/'.$datadb['data'][$i]['Email'].'/'.$datadb['data'][$i]['document'][$j]['Attachment'].'" target="_blank">'.$datadb['data'][$i]['document'][$j]['Attachment'].'</a>';
					 	$namaFile = $datadb['data'][$i]['document'][$j]['Attachment'];
					 }
					 else
					 {
					 	$namaFile = 'nothing';
					 }

				?>
					<tr>
						<td class="checkbox-column">
							<?php if ($datadb['data'][$i]['document'][$j]['Status'] == 'Done'): ?>
							<?php else: ?>
								<input type="checkbox" class="uniform<?php echo $i ?>" value ="<?php echo $datadb['data'][$i]['document'][$j]['ID_register_document'] ?>;<?php echo $namaFile ?>">
							<?php endif ?>
					  	</td>
						<td><?php echo $no ?></td>
						<td><?php echo $datadb['data'][$i]['document'][$j]['DocumentChecklist'] ?></td>
						<td><?php echo $datadb['data'][$i]['document'][$j]['Required'] ?></td>
						<td><?php echo $attachment ?></td>
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
	<!-- <br> -->
	<hr class="style-eight" />
	<script type="text/javascript">
		$(document).on('click','#dataResultCheckAll<?php echo $i ?>', function () {
			$('input.uniform<?php echo $i ?>').not(this).prop('checked', this.checked);
		});

		$(document).on('click','#btn-approve<?php echo $i ?>', function () {
			loading_button('#btn-approve<?php echo $i ?>');
			var ID_register_document = getValueChecbox<?php echo $i ?>('.tableData<?php echo $i ?>');
			  // console.log(ID_register_document);
			 if (ID_register_document.length == 0) {
			 	toastr.error("Silahkan checked dahulu", 'Failed!!');
			 }
			 else
			 {
			 	var msg = '';
			 	// console.log(ID_register_document);
			 	for (var i = 0; i < ID_register_document.length; i++) {
			 		var split = ID_register_document[i].split(';');
			 		if (split[0] != 'nothing') {
			 			if (split[1] == 'nothing') {
			 				msg = '<ul><li>Apakah anda yakin untuk mengkonfirmasi dokumen yang belum diupload ?</li>';
			 				break;
			 			}
			 		}
			 	}

			 	if(msg == '')
			 	{
		 			 //var getAllRegisterID;
		 			 $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Apakah anda yakin untuk melakukan request ini ?? </b> ' +
		 			     '<button type="button" id="confirmYesProcess" class="btn btn-primary" style="margin-right: 5px;" data-pass = "'+ID_register_document+'" action = "approve">Yes</button>' +
		 			     '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
		 			     '</div>');
		 			 $('#NotificationModal').modal('show');
			 	}
			 	else{
			 		msg += '</ul>'
			 		$('#NotificationModal .modal-body').html('<div style="text-align: left;"><b>'+msg+'</b></div> ' +
			 		    '<button type="button" id="confirmYesProcess" class="btn btn-primary" style="margin-right: 5px;" data-pass = "'+ID_register_document+'" action = "approve">Yes</button>' +
			 		    '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
			 		    '');
			 		$('#NotificationModal').modal('show');
			 	}
		 		 
			 }
			 $('#btn-approve<?php echo $i ?>').prop('disabled',false).html('Approve');

		});

		$(document).on('click','#btn-reject<?php echo $i ?>', function () {
			loading_button('#btn-reject<?php echo $i ?>');
			var ID_register_document = getValueChecbox<?php echo $i ?>('.tableData<?php echo $i ?>');
			  // console.log(ID_register_document);
			 if (ID_register_document.length == 0) {
			 	toastr.error("Silahkan checked dahulu", 'Failed!!');
			 }
			 else
			 {
			 	var msg = '';
			 	// console.log(ID_register_document);
			 	for (var i = 0; i < ID_register_document.length; i++) {
			 		var split = ID_register_document[i].split(';');
			 		if (split[0] != 'nothing') {
			 			if (split[1] == 'nothing') {
			 				msg = '<ul><li>Apakah anda yakin untuk mengkonfirmasi dokumen yang belum diupload ?</li>';
			 				break;
			 			}
			 		}
			 	}

			 	if(msg == '')
			 	{
		 			 //var getAllRegisterID;
		 			 $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Apakah anda yakin untuk melakukan request ini ?? </b> ' +
		 			     '<button type="button" id="confirmYesProcess" class="btn btn-primary" style="margin-right: 5px;" data-pass = "'+ID_register_document+'" action = "reject">Yes</button>' +
		 			     '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
		 			     '</div>');
		 			 $('#NotificationModal').modal('show');
			 	}
			 	else{
			 		msg += '</ul>'
			 		$('#NotificationModal .modal-body').html('<div style="text-align: left;"><b>'+msg+'</b></div> ' +
			 		    '<button type="button" id="confirmYesProcess" class="btn btn-primary" style="margin-right: 5px;" data-pass = "'+ID_register_document+'" action = "reject">Yes</button>' +
			 		    '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
			 		    '');
			 		$('#NotificationModal').modal('show');
			 	}
		 		 
			 }
			 $('#btn-reject<?php echo $i ?>').prop('disabled',false).html('Reject');

		});

		function getValueChecbox<?php echo $i ?>(element)
		{
		     var allVals = [];
		     $('.tableData<?php echo $i ?> :checked').each(function() {
		       allVals.push($(this).val());
		     });
		     return allVals;
		}
	</script>
<?php endfor; ?>
<?php if (count($datadb['data']) == 0): ?>
	<div align = 'center'>No Result Data...</div>
<?php endif ?>
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

    var url = base_url_js+'admission/proses-calon-mahasiswa/verifikasi-dokument/proses_document';
    var data_passing = $(this).attr('data-pass');
    var action = $(this).attr('action');
    var data = {
        data_passing : data_passing,
        action : action,
    };

    var token = jwt_encode(data,"UAP)(*");
    $.post(url,{token:token},function (data_json) {
        setTimeout(function () {
           toastr.options.fadeOut = 10000;
           toastr.success('Data berhasil disimpan', 'Success!');
           loadData_register_document(1);
           $('#NotificationModal').modal('hide');
        },500);
    });
});
</script>

