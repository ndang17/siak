<div class="row" style="margin-top: 30px;">
	<div class="col-md-12">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-reorder"></i>List Register</h4>
				<div class="toolbar no-padding">
					<!--<div class="btn-group">
						<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
					</div>-->
				</div>
			</div>
			<div class="widget-content">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-md-3 control-label">Upload Rek Koran:</label>
						<div class="col-md-6">
							<input type="file" data-style="fileinput" id="rekKoran">
						</div>
					</div>
				</div>
			</div>
			<hr/>
			<div id="dataRegVerified">
			    
			</div>
				<div class="col-xs-12" align = "right">
				    <button class="btn btn-inverse btn-notification hide" id="btn-proses">Proses</button>
				</div>
				<br>
		</div>
	</div> <!-- /.col-md-6 -->
	<div class="col-md-12">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-reorder"></i> List excecute pembayaran via rek koran excel</h4>
				<div class="toolbar no-padding">
					<!--<div class="btn-group">
						<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
					</div>-->
				</div>
			</div>
			<div class="widget-content no-padding" id="dataResultID">
				<table class="table table-striped table-checkable table-hover">
					<thead>
						<tr>
							<th class="checkbox-column">
								<input type="checkbox" class="uniform">
							</th>
							<th class="hidden-xs">First Name</th>
							<th>Last Name</th>
							<th>Status</th>
							<th class="align-center">Approve</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="checkbox-column">
								<input type="checkbox" class="uniform">
							</td>
							<td class="hidden-xs">Joey</td>
							<td>Greyson</td>
							<td><span class="label label-success">Approved</span></td>
							<td class="align-center">
								<span class="btn-group">
									<a href="javascript:void(0);" title="Approve" class="btn btn-xs bs-tooltip"><i class="icon-ok"></i></a>
								</span>
							</td>
						</tr>
						<tr>
							<td class="checkbox-column">
								<input type="checkbox" class="uniform">
							</td>
							<td class="hidden-xs">Wolf</td>
							<td>Bud</td>
							<td><span class="label label-info">Pending</span></td>
							<td class="align-center">
								<span class="btn-group">
									<a href="javascript:void(0);" title="Approve" class="btn btn-xs bs-tooltip"><i class="icon-ok"></i></a>
								</span>
							</td>
						</tr>
						<tr>
							<td class="checkbox-column">
								<input type="checkbox" class="uniform">
							</td>
							<td class="hidden-xs">Darin</td>
							<td>Alec</td>
							<td><span class="label label-warning">Suspended</span></td>
							<td class="align-center">
								<span class="btn-group">
									<a href="javascript:void(0);" title="Approve" class="btn btn-xs bs-tooltip"><i class="icon-ok"></i></a>
								</span>
							</td>
						</tr>
						<tr>
							<td class="checkbox-column">
								<input type="checkbox" class="uniform">
							</td>
							<td class="hidden-xs">Andrea</td>
							<td>Brenden</td>
							<td><span class="label label-danger">Blocked</span></td>
							<td class="align-center">
								<span class="btn-group">
									<a href="javascript:void(0);" title="Approve" class="btn btn-xs bs-tooltip"><i class="icon-ok"></i></a>
								</span>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="row">
					<div class="table-footer">
						<div class="col-md-12">
							<div class="table-actions">
								<label>Apply action:</label>
								<select class="select2" data-minimum-results-for-search="-1" data-placeholder="Select action...">
									<option value=""></option>
									<option value="Edit">Edit</option>
									<option value="Delete">Delete</option>
									<option value="Move">Move</option>
								</select>
							</div>
						</div>
					</div> <!-- /.table-footer -->
				</div> <!-- /.row -->
			</div> <!-- /.widget-content -->
		</div> <!-- /.widget -->
	</div> <!-- /.col-md-6 -->
	<!-- /Static Table -->
</div> <!-- /.row -->
<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4 class="header"><i class="icon-reorder"></i>List pembayaran yang telah dikonfirmasi</h4>
            </div>
            <div class="widget-content">
                <!--  -->
                sad
                <!-- -->
            </div>
            <hr/>
            <div id="page">
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	window.dataGet; // deklarasi menampus file table
	window.RegisterID; // deklarasi menampus file table
	window.url_images = 'http://localhost/register/upload/';
	$(document).ready(function () {
	    loadDataRegVerification();
	});

	function loadDataRegVerification()
	{
		$("#dataRegVerified").empty();
		loading_page('#dataRegVerified');
		var url = base_url_js+'loadDataRegistrationUpload';
		$.post(url,function (data_json) {
		    setTimeout(function () {
		        $("#dataRegVerified").html(data_json);
		    },2000);
		});
	}

	$(document).on('click','#btn-proses', function () {
		$("#dataRegVerified").empty();
		loading_page('#dataRegVerified');
	  if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
	  		toastr.error('The File APIs are not fully supported in this browser.', 'Failed!!');
	        return;
	      }   

	      input = document.getElementById('rekKoran');
	      if (!input) {
	        toastr.error('Um, couldnot find the fileinput element.', 'Failed!!');
	      }
	      else if (!input.files) {
	        toastr.error('This browser doesnot seem to support the `files', 'Failed!!');
	      }
	      else if (!input.files[0]) {
	        toastr.error('Please select a file before clicking Proses', 'Failed!!');
	      }
	      else {
	        file = input.files[0];
	        fr = new FileReader();
	        fr.onload = receivedText;
          	fr.readAsText(file);
          	//fr.readAsDataURL(file);
	      }
	     
	});

	function receivedText()
	{
		processData(fr.result);
	}

	function processData(allText) {
	    var allTextLines = allText.split(/\r\n|\n/);
	    var headers = allTextLines[0].split(',');
	    var lines = [];
	    var totalData = 0;
	    var totalDataChecking = 0;

	    for (var i=0; i<allTextLines.length; i++) {
	        var data = allTextLines[i].split(',');
	        if(i<5)
	        {
	        	if (data[4] == "DB" || data[4] == "CR") {
	        		toastr.error("Format tidak sesuai", 'Failed!!');
	        		break;
	        	}
	        }
	        else
	        {
	        	if (data[4] == "DB" || data[4] == "CR") {
	        		totalData++;
	        		lines.push(data);
	        	}

	        	if (data[0] == "Saldo Awal") {
	        		totalDataChecking = parseInt(i) - parseInt(5);
	        	}
	        }
	    }

	    if (totalData = totalDataChecking) {
	    	processData2(lines)
	    }
	    else
	    {
	    	toastr.error("Format tidak sesuai", 'Failed!!');
	    }	
		//console.log(lines);
		//console.log(dataGet);
		//console.log(totalData);
		//console.log(totalDataChecking);
	}

	function processData2(datacsv) {
	    var dataSaveTBL = []; 
	    for (var i = 0; i < dataGet.length; i++) {
	    	var PriceFormulirDB = dataGet[i]['PriceFormulir'];
	    	//console.log(PriceFormulirDB);
	    	//console.log(datacsv);
	    	for (var j = 0; j < datacsv.length; j++) {
	    		if (datacsv[j][4] == "CR") {
	    			var PriceFormulirCSV = datacsv[j][3];
	    			if (PriceFormulirDB == PriceFormulirCSV) {
	    				dataSaveTBL.push(dataGet[i]);
	    				RegisterID =dataGet[i]['ID'];
	    			}
	    		}
	    	}
	    	
	    }
	    console.log(dataSaveTBL);
	    generateTableConfirm(dataSaveTBL);
	}

	function generateTableConfirm(dataResult)
	{
		//$("#dataResultID").empty();
		var HeaderTable = '<table class="table table-striped table-checkable table-hover datatable">'+
						  		'<thead>'+
						  			'<tr>'+
						  				'<th class="checkbox-column">'+
						  					'<input type="checkbox" class="uniform" value="nothing" id ="dataResultCheckAll">'+
						  				'</th>'+
						  				'<th class="hidden-xs">Nama</th>'+
						  				'<th>Email</th>'+
						  				'<th>Price Formulir</th>'+
						  				'<th>File Upload</th>'+
						  				'<th>Sekolah</th>'+
						  				'<th>Register At</th>'+
						  				'<th>Upload At</th>'+
						  			'<tr>'+
						  		'</thead>'
						;
		var tbody = '<tbody>';
		
		for (var i = 0; i < dataResult.length; i++) {
			var varFileUpload = '<td>'+
								'<a href="javascript:void(0);" onclick="showModalImage(\''+url_images+dataResult[i].FileUpload+'\')">File Upload'+
								'</a>'+
								'</td>'	;
			if (dataResult[i].FileUpload == null ) {
				varFileUpload = '<td style="'+
							'color:  red;'+
							'">Bukti Pembayaran belum diupload'+
						  '</td>';
			}
			tbody += '<tr>'+
						  '<td class="checkbox-column">'+
						  	'<input type="checkbox" class="uniform" value ="'+dataResult[i]['ID']+'">'+
						  '</td>'+
						  '<td>'+dataResult[i]['Name']+'</td>'+
						  '<td>'+dataResult[i]['Email']+'</td>'+
						  '<td>'+dataResult[i]['PriceFormulir']+'</td>'+
						  varFileUpload+
						  '<td>'+dataResult[i]['SchoolName']+'</td>'+
						  '<td>'+dataResult[i]['RegisterAT']+'</td>'+
						  '<td>'+dataResult[i]['uploadAT']+'</td>'+
					  '</tr>'

				;
		}

		tbody += "</tbody>";

		var endD = "</table>";				
		$("#dataRegVerified").html('');
		$("#dataRegVerified").append(HeaderTable+tbody+endD);
		//LoaddataTable('.datatable');
		//$("#dataResultID").append(HeaderTable+tbody+endD);
	}

	$(document).on('click','#dataResultCheckAll', function () {
		$('input.uniform').not(this).prop('checked', this.checked);
	});

	   
</script>