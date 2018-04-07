<div id = "loadingProcess"></div>
<div class="col-md-12">
    <table class="table table-striped table-bordered table-hover table-checkable datatable">
    	<thead>
    		<tr>
	    		<th style="width: 15px;">No</th>
	    		<th>Prody</th>
	    		<th>Tanggal Ujian</th>
	    		<th>Jam Ujian</th>
	    		<th>Lokasi</th>
	    		<!-- <th>Active</th> -->
    		</tr>
    	</thead>
    	<tbody>
    	</tbody>
    </table>
</div>
	
<script type="text/javascript">
	$(document).ready(function() {
		getJsonTable();
	}); // exit document Function

	function getJsonTable()
	{
		var url = base_url_js+'admission/proses-calon-mahasiswa/set-jadwal-ujian/load_table_getjsonApi';
		 loading_page('#loadingProcess');
		$.post(url,function (data_json) {
			var response = jQuery.parseJSON(data_json);
			var no = 1;
			$("#loadingProcess").remove();
			for (var i = 0; i < response.length; i++) {
				var status = '<td style="'+
    							'color:  green;'+
								'">ON'+
							  '</td>';
				if (response[i]['Active'] == 0 ) {
					status = '<td style="'+
    							'color:  red;'+
								'">Off'+
							  '</td>';
				}

				$(".datatable tbody").append(
					'<tr>'+
						'<td>'+no+'</td>'+
						'<td>'+response[i]['Name']+'</td>'+
						'<td>'+response[i]['tanggal']+'</td>'+
						'<td>'+response[i]['jam']+'</td>'+
						'<td>'+response[i]['Lokasi']+'</td>'+
						// status+
						// '<td>'+response[i]['Lokasi']+'</td>'+
						// '<td>'+response[i]['Name']+'</td>'+
					'</tr>'	
					);
				no++;
			}
		    LoaddataTable('.datatable');
		});
	}	
</script>
