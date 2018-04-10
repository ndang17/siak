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
						<!-- <div class = "row"> -->
							<div class="col-xs-2" style="">
								<label class="control-label">Set Baris Awal Data</label>
							</div>
							<div class="col-xs-2">
								<select class="col-md-12 full-width-fix angkaSelect" id="baris">
								  <option></option>
								</select>
							</div>
							<div class="col-xs-2" style="">
								<label class="control-label">Set Kolom Price</label>
							</div>
							<div class="col-xs-2">
								<select class="col-md-12 full-width-fix angkaSelect" id="kolomPrice">
								  <option></option>
								</select>
							</div>
							<div class="col-xs-2" style="">
								<label class="control-label">Set Kolom Debit</label>
							</div>
							<div class="col-xs-2">
								<select class="col-md-12 full-width-fix angkaSelect" id="kolomDebit">
								  <option></option>
								</select>
							</div>
						</div>
					<!-- </div> -->
				</div>
				<div class="form-horizontal">
					<div class="form-group">
						<!-- <div class = "row"> -->
							<div class="col-xs-2" style="">
								<label class="control-label">Set Kolom Kredit</label>
							</div>
							<div class="col-xs-2">
								<select class="col-md-12 full-width-fix angkaSelect" id="kolomKredit">
								  <option></option>
								</select>
							</div>
							<div class="col-xs-2" style="">
								<label class="control-label">Set Nama Debit</label>
							</div>
							<div class="col-xs-2">
								<input type="text" id = "DeBitName" class="form-control" value = "DB">
							</div>
							<div class="col-xs-2" style="">
								<label class="control-label">Set Nama Credit</label>
							</div>
							<div class="col-xs-2">
								<input type="text" id = "CreditName" class="form-control" value = "CR">
							</div>
					</div>
					<!-- </div> -->
				</div>
				<div class="form-horizontal">
					<div class="form-group">
						<!-- <div class = "row"> -->
							<div class="col-xs-2" style="">
								<label class="control-label">Set Nama Line Akhir Data</label>
							</div>
							<div class="col-xs-2">
								<input type="text" id = "LineAkhirData" class="form-control" value = "Saldo Awal">
							</div>
							<div class="col-xs-2" style="">
								<label class="control-label">Upload Rek Koran:</label>
							</div>
							<div class="col-xs-2">
								<input type="file" data-style="fileinput" id="rekKoran">
							</div>
							<div class="col-xs-1">
								<button class="btn btn-inverse btn-notification hide" id="btn-proses">Proses</button>
							</div>
							
						</div>
					<!-- </div> -->
				</div>
			</div>
			<hr/>
			<div id="dataRegVerification">
			    
			</div>
			<div id = "tblResultCSV" class = "col-md-12 hide">
				<table class="table table-striped table-bordered table-hover table-checkable datatable2">
					<caption><strong>Hasil Pencarian Ke File CSV</strong></caption>
					<thead>
						<tr>
							<th class="checkbox-column">
								<input type="checkbox" class="uniform" value="nothing;nothing;nothing;nothing;nothing" id ="dataResultCheckAll">
							</th>
							<th class="hidden-xs">Nama</th>
							<th>Email</th>
							<th>Price Formulir</th>
							<th>File Upload</th>
							<th>Sekolah</th>
							<th>Register At</th>
							<th>Upload At</th>
							<th>Total Searching</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
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
                <h4 class="header"><i class="icon-reorder"></i>List pembayaran yang telah dikonfirmasi</h4>
            </div>
            <div class="widget-content">
                <!--  -->
                <div id="dataRegVerified">
                </div>
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
	//window.RegisterID; // deklarasi menampung file table
	//window.url_images = 'http://localhost/register/upload/';
	window.url_images = '<?php echo $this->GlobalVariableAdi['url_registration'] ?>'+'upload/';
	$(document).ready(function () {
	    loadDataRegVerification();
	    loadDataRegVerified();
	    loadSelectbaris();
	});

	function loadSelectbaris()
	{
		// var thisYear = (new Date()).getFullYear();
		var angkaAwal = 20;
		var startAngka = 1;
		var selisih = parseInt(angkaAwal) - parseInt(startAngka);
		for (var i = 0; i <= selisih; i++) {
		    var selected = (i==5) ? 'selected' : '';
		    $('.angkaSelect').append('<option value="'+ ( parseInt(startAngka) + parseInt(i) ) +'" '+selected+'>'+( parseInt(startAngka) + parseInt(i) )+'</option>');
		}

		 $("#kolomPrice option").filter(function() {
		   //may want to use $.trim in here
		   return $(this).val() == 4; 
		 }).prop("selected", true);

		 $("#kolomDebit option").filter(function() {
		   //may want to use $.trim in here
		   return $(this).val() == 5; 
		 }).prop("selected", true);


		 $("#kolomKredit option").filter(function() {
		   //may want to use $.trim in here
		   return $(this).val() == 5; 
		 }).prop("selected", true);

		$('.angkaSelect').select2({
		  // allowClear: true
		});

	}

	function loadDataRegVerified()
	{
		$("#dataRegVerified").empty();
		loading_page('#dataRegVerified');
		var url = base_url_js+'loadDataRegistrationVerified';
		$.post(url,function (data_json) {
		    setTimeout(function () {
		        $("#dataRegVerified").html(data_json);
		    },500);
		});
	}

	function loadDataRegVerification()
	{
		$("#dataRegVerification").empty();
		loading_page('#dataRegVerification');
		var url = base_url_js+'loadDataRegistrationUpload';
		$.post(url,function (data_json) {
		    setTimeout(function () {
		        $("#dataRegVerification").html(data_json);
		    },500);
		});
	}

	$(document).on('click','#btn-proses', function () {
		$("#dataRegVerification").empty();
		loading_page('#dataRegVerification');
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

	    var DeBitName = $("#DeBitName").val().trim();
	    var CreditName = $("#CreditName").val().trim();
	    var baris = $("#baris").val();
	    var kolom = $("#kolom").val();
	    var kolomKredit = $("#kolomKredit").val();
	    var kolomDebit = $("#kolomDebit").val();
	    var LineAkhirData = $('#LineAkhirData').val().trim();
	    var dataValidation = {
	    						DeBitName : DeBitName,
	    						CreditName : CreditName,
	    						LineAkhirData : LineAkhirData
	    					};

	    if (validation(dataValidation)) {
	    	baris = parseInt(baris) - parseInt(1); // karena array dimulai dari 0
	    	kolom = parseInt(kolom) - parseInt(1); // karena array dimulai dari 0
	    	kolomKredit = parseInt(kolomKredit) - parseInt(1); // karena array dimulai dari 0
	    	kolomDebit = parseInt(kolomDebit) - parseInt(1); // karena array dimulai dari 0
	    	for (var i=0; i<allTextLines.length; i++) {
	    	    var data = allTextLines[i].split(',');
	    	    if(i<baris)
	    	    {
	    	    	if (data[kolomDebit] == DeBitName || data[kolomKredit] == CreditName) {
	    	    		toastr.error("Format tidak sesuai", 'Failed!!');
	    	    		break;
	    	    	}
	    	    }
	    	    else
	    	    {
	    	    	if (data[kolomDebit] == DeBitName || data[kolomKredit] == CreditName) {
	    	    		totalData++;
	    	    		lines.push(data);
	    	    	}

	    	    	if (data[0] == LineAkhirData) {
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
	    }	// exit if				
	}

  function validation(arr)
  {
  	// console.log(arr);
    var toatString = "";
    var result = "";
    for(var key in arr) {
       switch(key)
       {
        case  "DeBitName" :
        case  "CreditName" :
        case  "LineAkhirData" :
              result =  Validation_required(arr[key],key);
              if (result['status'] == 0) {
                toatString += result['messages'] + "<br>";
              }
              break;
       }

    }
    if (toatString != "") {
      toastr.error(toatString, 'Failed!!');
      return false;
    }

    return true;
  }

	function processData2(datacsv) {
	    var dataSaveTBL = []; 
	    //console.log(dataGet);
	    for (var i = 0; i < dataGet.length; i++) {
	    	var PriceFormulirDB = dataGet[i]['PriceFormulir'];
	    	var count = 0;
	    	for (var j = 0; j < datacsv.length; j++) {
	    		if (datacsv[j][4] == "CR") {
	    			var PriceFormulirCSV = datacsv[j][3];
	    			if (PriceFormulirDB == PriceFormulirCSV) {
	    				//console.log(PriceFormulirDB);
	    				count++;
	    			}
	    		}
	    	}
	    	//console.log(count + " -- PriceFormulirDB : " +PriceFormulirDB);
	    	if (count > 0) {
	    		var valueToPush = { }
	    		for(var key in dataGet[i]) {
	    			valueToPush[key] = dataGet[i][key];
	    		}
	    		valueToPush['count'] = count;
	    		dataSaveTBL.push(valueToPush);
	    	}
	    }
	    console.log(dataSaveTBL);
	    generateTableConfirm(dataSaveTBL);
	}

	function generateTableConfirm(dataResult)
	{
		$.fn.dataTable.ext.errMode = 'throw';
		$(".datatable2 tbody").empty();
		$(".datatable2").addClass("hide");
		$("#btn-confirm").addClass("hide");
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
			var total_searching = '<td>1</td>';
			if (dataResult[i]['count'] > 1) {
				total_searching ='<td style="'+
							'color:  red;'+
							'">'+dataResult[i]['count']+
						  '</td>';
			}
			
			$(".datatable2 tbody").append( '<tr>'+
					  '<td class="checkbox-column">'+
					  	'<input type="checkbox" class="uniform" value ="'+dataResult[i]['ID']+";"+dataResult[i]['FileUpload']+";"+dataResult[i]['Email']+";"+dataResult[i]['count']+";"+dataResult[i]['PriceFormulir']+'">'+
					  '</td>'+
					  '<td>'+dataResult[i]['Name']+'</td>'+
					  '<td>'+dataResult[i]['Email']+'</td>'+
					  '<td>'+dataResult[i]['PriceFormulir']+'</td>'+
					  varFileUpload+
					  '<td>'+dataResult[i]['SchoolName']+'</td>'+
					  '<td>'+dataResult[i]['RegisterAT']+'</td>'+
					  '<td>'+dataResult[i]['uploadAT']+'</td>'+
					  total_searching+
				  '</tr>'

			);	
		}

		setTimeout(function () {
		     $("#dataRegVerification").html('');
		     $("#btn-confirm").removeClass('hide');
		     $(".datatable2").removeClass('hide');
		     $("#tblResultCSV").removeClass('hide');
		     //LoaddataTable('.datatable2');
		},500);			
	}

	$(document).on('click','#dataResultCheckAll', function () {
		$('input.uniform').not(this).prop('checked', this.checked);
		  /*$(".uniform", $(".datatable2").fnGetNodes()).each(function () { 
		  	$(this).prop("checked", true);
		  	//$('input.uniform').not(this).prop('checked', this.checked);
		  });*/
	});

	$(document).on('click','#btn-confirm', function () {
		loading_button('#btn-confirm');
		var RegisterID = getValueChecbox('.datatable2');
		 if (RegisterID.length == 0) {
		 	toastr.error("Silahkan checked dahulu", 'Failed!!');
		 }
		 else
		 {
		 	var msg = '';
		 	console.log(RegisterID);
		 	for (var i = 0; i < RegisterID.length; i++) {
		 		var split = RegisterID[i].split(';');
		 		if (split[0] != 'nothing') {
		 			if (split[1] == 'null') {
		 				msg = '<ul><li>Apakah anda yakin untuk mengkonfirmasi yang belum melakukan upload bukti pembayaran ?</li>';
		 				break;
		 			}
		 		}
		 	}

		 	for (var i = 0; i < RegisterID.length; i++) {
		 		var split = RegisterID[i].split(';');
		 		if (split[0] != 'nothing') {
		 			if (split[3] > 1) {
		 				msg += '<li>Apakah anda yakin untuk menkonfirmasi bahwa price number = '+split[4]+' memiliki lebih dari satu data pada file Rekening Koran ?</li>';
		 				break;
		 			}
		 		}
		 	}

		 	if(msg == '')
		 	{
	 			 //var getAllRegisterID;
	 			 $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Apakah anda yakin untuk melakukan request ini ?? </b> ' +
	 			     '<button type="button" id="confirmYesProcess" class="btn btn-primary" style="margin-right: 5px;" data-pass = "'+RegisterID+'">Yes</button>' +
	 			     '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
	 			     '</div>');
	 			 $('#NotificationModal').modal('show');
	 		     console.log(RegisterID);
		 	}
		 	else{
		 		msg += '</ul>'
		 		$('#NotificationModal .modal-body').html('<div style="text-align: left;"><b>'+msg+'</b></div> ' +
		 		    '<button type="button" id="confirmYesProcess" class="btn btn-primary" style="margin-right: 5px;" data-pass = "'+RegisterID+'">Yes</button>' +
		 		    '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
		 		    '');
		 		$('#NotificationModal').modal('show');
		 	}
	 		 
		 }
		 $('#btn-confirm').prop('disabled',false).html('Confirm');
	});

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

        var url = base_url_js+'finance/confirmed-verifikasi-pembayaran-registration_online';
        var arrdata = $(this).attr('data-pass');
        var data = {
            arrdata : arrdata,
        };

        var token = jwt_encode(data,"UAP)(*");
        $.post(url,{token:token},function (data_json) {
            setTimeout(function () {
               toastr.options.fadeOut = 10000;
               toastr.success('Data berhasil disimpan', 'Success!');
               loadDataRegVerification();
               loadDataRegVerified();
               $("#tblResultCSV").addClass('hide');
               $('#NotificationModal').modal('hide');
               $("#btn-confirm").addClass("hide");
               //window.location.reload(true);
            },500);
        });

	});
</script>
