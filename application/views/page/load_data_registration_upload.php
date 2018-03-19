<div id = "loadingProcess"></div>
<div class="col-md-12">
    <table class="table table-striped table-bordered table-hover table-checkable datatable">
    	<thead>
    		<tr>
    		<th style="width: 15px;">No</th>
    		<th>Nama</th>
    		<th>Email</th>
    		<th>Price Formulir</th>
    		<th>File Upload</th>
    		<th>Sekolah</th>
    		<th>Register At</th>
    		<th>Upload At</th>
    		</tr>
    	</thead>
    	<tbody>
    	</tbody>
    </table>
</div>
<script type="text/javascript">

	$(document).ready(function() {
		getJsonDataRegistrationUpload();
	}); // exit document Function

	function getJsonDataRegistrationUpload()
	{
		var url = base_url_js+'api/__getDataRegisterUpload';
		//var url_images = 'http://localhost/register/upload/';
		loading_page('#loadingProcess');
		$.post(url,function (data_json) {
			//var response = jQuery.parseJSON(data_json);
			var no = 1;
			//console.log(data_json)
			dataGet = data_json; // simpan data dalam dataget yang dideklarasikan di verfikasi_pembayaran_registration_online
			$("#loadingProcess").remove();
			for (var i = 0; i < data_json.length; i++) {
				var varFileUpload = '<td>'+
								'<a href="javascript:void(0);" onclick="showModalImage(\''+url_images+data_json[i].FileUpload+'\')">File Upload'+
								'</a>'+
								'</td>'	;
				if (data_json[i].FileUpload == null ) {
					varFileUpload = '<td style="'+
    							'color:  red;'+
								'">Bukti Pembayaran belum diupload'+
							  '</td>';
				}
				$(".datatable tbody").append(
					'<tr>'+
						'<td>'+no+'</td>'+
						'<td>'+data_json[i]['Name']+'</td>'+
						'<td>'+data_json[i]['Email']+'</td>'+
						'<td>'+data_json[i]['PriceFormulir']+'</td>'+
						varFileUpload+
						'<td>'+data_json[i]['SchoolName']+'</td>'+
						'<td>'+data_json[i]['RegisterAT']+'</td>'+
						'<td>'+data_json[i]['uploadAT']+'</td>'+
					'</tr>'	
					);
				no++;
			}
			if (data_json.length > 0 ) {
				$("#btn-proses").removeClass('hide');
			}
		    LoaddataTable('.datatable');
		});
	}

	function showModalImage(urlImage)
	{
		$('#NotificationModal .modal-header').addClass('hide');
		$('#NotificationModal .modal-body').html('<center>' +
		    '                    <img src="'+urlImage+'">'+
		    '                </center>');
		$('#NotificationModal .modal-footer').addClass('hide');
		$('#NotificationModal').modal({
		    //'backdrop' : 'static',
		    'show' : true
		});
	}	
</script>
