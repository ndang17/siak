<div id = "loadingProcess"></div>
<div class="col-md-12">
    <table class="table table-striped table-bordered table-hover table-checkable datatable">
    	<thead>
    		<tr>
    		<th style="width: 15px;">No</th>
    		<th>Tahun</th>
    		<th>Formulir Code</th>
    		<th>Status</th>
    		<th>Create At</th>
    		<th>Created By</th>
    		</tr>
    	</thead>
    	<tbody>
    	</tbody>
    </table>
</div>
	
<script type="text/javascript">

	$(document).ready(function() {
		var selectTahun = "<?php echo $passSelectTahun ?>";
		getJsonFormulirOnline(selectTahun);
	}); // exit document Function

	function getJsonFormulirOnline(selectTahun)
	{
		var selectTahun = $("#selectTahun").val();
		var url = base_url_js+'admission/master-registration/getJsonFormulirOnline';
		var data = {
		    selectTahun : selectTahun
		};
		var token = jwt_encode(data,"UAP)(*");
		loading_page('#loadingProcess');
		$.post(url,{token:token},function (data_json) {
			var response = jQuery.parseJSON(data_json);
			var no = 1;
			$("#loadingProcess").remove();
			for (var i = 0; i < response.length; i++) {
				var status = '<td style="'+
    							'color:  green;'+
								'">IN'+
							  '</td>';
				if (response[i]['Status'] == 1 ) {
					status = '<td style="'+
    							'color:  red;'+
								'">Sold Out'+
							  '</td>';
				}
				$(".datatable tbody").append(
					'<tr>'+
						'<td>'+no+'</td>'+
						'<td>'+response[i]['Years']+'</td>'+
						'<td>'+response[i]['FormulirCode']+'</td>'+
						status+
						'<td>'+response[i]['CreateAT']+'</td>'+
						'<td>'+response[i]['Name']+'</td>'+
					'</tr>'	
					);
				no++;
			}
		    LoaddataTable('.datatable');
		});
	}	
</script>
