<div class="row" style="margin-top: 30px;">
	<div class="col-md-12">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-reorder"></i>Daftar Jadwal Ujian Kandidate Hari ini</h4>
				<div class="toolbar no-padding">
					<!--<div class="btn-group">
						<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
					</div>-->
				</div>
			</div>
			<div class="widget-content">
				<div id = "loadtableNow" class = "col-md-12">
					
				</div>
			</div>
			<hr/>
				<div class="col-xs-12" align = "right">
				   <button class="btn btn-inverse btn-notification hide" id="btn-confirm">Confirm</button>
				</div>
				<br>
		</div>
	</div> <!-- /.col-md-6 -->
</div>
<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="header"><i class="icon-reorder"></i>Daftar Jadwal Ujian Kandidate</h4>
            </div>
            <div class="widget-content">
                <div class = "row">	
					<div class="col-xs-3" style="">
						Nama / Sekolah
						<input class="form-control" id="Nama" placeholder="All..." "="">
					</div>
					<div class="col-xs-3" style="">
						No Formulir
						<input class="form-control" id="FormulirCode" placeholder="All..." "="">
					</div>
					<div  class="col-xs-6" align="right" id="pagination_link"></div>	
					<!-- <div class = "table-responsive" id= "register_document_table"></div> -->
				</div>
                <div class = 'row'>
                	<div id= "loadtable"></div>
                </div>
                <!-- -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		loadDataUjianNOW();
	});

	function loadDataUjianNOW(callback) {
	    // Some code
	    // console.log('test');
	    var table = '<table class="table table-striped table-bordered table-hover table-checkable datatable">'+
    	'<thead>'+
    		'<tr>'+
    			'<th style="width: 15px;">No</th>'+
    			'<th style="width: 15px;">Nama</th>'+
    			'<th style="width: 15px;">Email</th>'+
    			'<th style="width: 15px;">Sekolah</th>'+
    			'<th style="width: 15px;">Formulir Code</th>'+
    			'<th style="width: 15px;">Prody</th>'+
    			'<th style="width: 15px;">Tanggal</th>'+
    			'<th style="width: 15px;">Jam</th>'+
    			'<th style="width: 15px;">Lokasi</th>'+
    		'</tr>'+
    	'</thead>'+
    	'<tbody>'+
    	'</tbody>'+
    	'</table>';
    	//$("#loadtableNow").empty();
    	$("#loadtableNow").html(table);
	    if (typeof callback === 'function') { 
	        callback(); 
	    }
	}

	loadDataUjianNOW(function() {
	var url = base_url_js+'admission/proses-calon-mahasiswa/jadwal-ujian/daftar-jadwal-ujian/load-data-now'
	// loading_page('#loadtableNow');
		$.post(url,function (data_json) {
			var response = jQuery.parseJSON(data_json);
			var no = 1;
			// $("#loadingProcess").remove();
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
						'<td>'+response[i]['NameCandidate']+'</td>'+
						'<td>'+response[i]['Email']+'</td>'+
						'<td>'+response[i]['SchoolName']+'</td>'+
						'<td>'+response[i]['FormulirCode']+'</td>'+
						'<td>'+response[i]['prody']+'</td>'+
						'<td>'+response[i]['tanggal']+'</td>'+
						'<td>'+response[i]['jam']+'</td>'+
						'<td>'+response[i]['Lokasi']+'</td>'+
					'</tr>'	
					);
				no++;
			}
		}).done(function() {
  		    LoaddataTable('.datatable');
	    })
	});	

	/*function loadDataUjianNOW()
	{
		var url = base_url_js+'admission/proses-calon-mahasiswa/jadwal-ujian/daftar-jadwal-ujian/load-data-now'
		loading_page('#loadtableNow');
		$.post(url,function (data_json) {
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
						'<td>'+response[i]['Link']+'</td>'+
						status+
						'<td>'+response[i]['CreateAT']+'</td>'+
						'<td>'+response[i]['Name']+'</td>'+
					'</tr>'	
					);
				no++;
			}
		    LoaddataTable('.datatable');
		});
	}*/
</script>
