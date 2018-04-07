<script type="text/javascript" src="<?php echo base_url();?>assets/datepicker/bootstrap-datepicker.js"></script>
<link href="<?php echo base_url();?>assets/datepicker/datepicker.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
	.btn-save{
		background-color: #15a02c;
	}
</style>
<div class="row" style="margin-top: 30px;">
	<div class="col-md-12">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-reorder"></i>Set Jadwal Ujian</h4>
			</div>
			<div class="widget-content">
				<div class = "row">	
					<div class="col-xs-6" style="">
						Pilih Program Study
						<div id="program_study">
						</div>
					</div>
				</div>
				<br>
				<div class = "row">		
					<div class="col-xs-2" style="">
						Waktu Ujian
						<input class="form-control" id="datetime_ujian" placeholder="All..." "="">
					</div>
					<div class="col-xs-6" style="">
						Lokasi
						<textarea rows="3" cols="5" name="textarea" class="limited form-control" data-limit="150" maxlength="150" id = "Lokasi"></textarea>
					</div>
					<div  class="col-xs-4" align="right" id="pagination_link"></div>
				</div>
				<br>
				<div  class="row">
					<div class="col-xs-12" align = "left">
					   <button class="btn btn-inverse btn-notification btn-save" id="btn-save">Save</button>
					</div>
				</div>
				<br>
				<br>
				<hr>	
				<div id= "getTable"></div>
			</div>
		</div>
	</div> <!-- /.col-md-6 -->
</div>

<script type="text/javascript">
	$(document).ready(function () {
		LoadData();
        $('#datetime_ujian').prop('readonly',true);
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        $('#datetime_ujian').datetimepicker({
        	// startDate: today,
        	startDate: '+2d',
        });
	});

	$(document).on('click','#btn-save', function () {
		// show data
		loading_button('#btn-save');
		var program_study = getCheckbox('#tablechkProStudy');
		// console.log(program_study);
		var datetime_ujian = $("#datetime_ujian").val();
		var Lokasi = $("#Lokasi").val();
		var url = base_url_js+'admission/proses-calon-mahasiswa/set-jadwal-ujian/save';
		var data = {
		            program_study : program_study,
		            datetime_ujian : datetime_ujian,
		            Lokasi : Lokasi
		        };
		if (validationInput = validation(data)) {
			var token = jwt_encode(data,"UAP)(*");
			$.post(url,{token:token},function (data_json) {
			    // jsonData = data_json;
			    var obj = JSON.parse(data_json); 
			    if (obj.msg != '') {
			    	toastr.error(obj.msg, 'Failed!!');
			    }
			    else
			    {
			    	toastr.options.fadeOut = 10000;
			    	toastr.success('Data berhasil disimpan','Success!');
			    }
			    console.log(obj);
			}).done(function() {
	  		    setTimeout(function () {
	  	       	    loadTableJson(1);
	  		    },500);
		    }).fail(function() {
		      toastr.error('The Database connection error, please try again', 'Failed!!');;
		    }).always(function() {
		    	$('#btn-save').prop('disabled',false).html('Save');
		    });
		}
		else
		{
		   $('#btn-save').prop('disabled',false).html('Save');
		}	
		
	});

	function validation(arr)
	{
	  var toatString = "";
	  var result = "";
	  for(var key in arr) {
	     switch(key)
	     {
	      case  "Lokasi" :
            result = Validation_leastCharacter(3,arr[key],key);
            if (result['status'] == 0) {
              toatString += result['messages'] + "<br>";
            }
            break;
           case  "datetime_ujian" :
           case  "program_study" :
	           result = Validation_required(arr[key],key);
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

	function LoadData()
	{
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

    	  var url = base_url_js+'api/__getBaseProdiSelectOption';
    	  $.get(url,function (data_json) {
    	      var splitBagi = 5;
    	      var split = parseInt(data_json.length / splitBagi);
    	      var sisa = data_json.length % splitBagi;
    	      if (sisa > 0) {
    	            split++;
    	      }
    	      var getRow = 0;
    	      $('#program_study').append('<table class="table" id ="tablechkProStudy">');
    	      for (var i = 0; i < split; i++) {
    	      	if ((sisa > 0) && ((i + 1) == split) ) {
    	      	                    splitBagi = sisa;    
    	      	}
    	      	$('#tablechkProStudy').append('<tr id = "a'+i+'">');
    	      	for (var k = 0; k < splitBagi; k++) {
    	      		$('#a'+i).append('<td>'+
  	  	      						'<input type="checkbox" class = "chkProStudy" name="chkProStudy" value = "'+data_json[getRow].ID+'">&nbsp'+ data_json[getRow].Name+
  	  	      					 '</td>'
    	      						);
    	      		getRow++;
    	      	}
    	      	$('#a'+i).append('</tr>');
    	      }
    	      $('#tablechkProStudy').append('</table>');
    	  }).always(function() {
    	  	loadTableJson(1);
    	  });
	}

	function loadTableJson(page)
	{
		loading_page('#getTable');
		var url = base_url_js+'admission/proses-calon-mahasiswa/set-jadwal-ujian/load_table';
		$.post(url,function (data_json) {
		    // jsonData = data_json;
		    var obj = JSON.parse(data_json); 
		    // console.log(obj);
		    setTimeout(function () {
	       	    $("#getTable").html(obj);
	            // $("#pagination_link").html(obj.pagination_link);
		    },500);
		}).done(function() {
	      
	    }).fail(function() {
	      toastr.error('Duplicate Jadwal', 'Failed!!');;
	    }).always(function() {
	      	$('#NotificationModal').modal('hide');
	    });
	}

	function getCheckbox(name)
    {
    	var allVals = [];
    	$(name+' :checked').each(function() {
    	  allVals.push($(this).val());
    	});
    	return allVals;
    }
	
</script>
