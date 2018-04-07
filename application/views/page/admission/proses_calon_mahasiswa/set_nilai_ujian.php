<style type="text/css">
	.row {
	    margin-right: 0px;
	    margin-left: 0px;
	}
</style>
<div class="row" style="margin-top: 30px;">
	<div class="col-md-12">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-reorder"></i>Set Nilai Ujian</h4>
			</div>
			<div class="widget-content">
				<div class = "row">	
					<div class="col-xs-3" style="">
						PilIh Prody
						<select class="select2-select-00 col-md-4 full-width-fix" id="selectPrody">
						    <option></option>
						</select>
					</div>
					<div  class="col-xs-4" align="right" id="pagination_link"></div>	
					<!-- <div class = "table-responsive" id= "register_document_table"></div> -->
				</div>
				<br>	
				<div class = 'row'>
					<div  class="col-xs-12" align="right" id="pagination_link"></div>
				</div>
				<div class = 'row'>
					<div id='loadTableData' class="col-md-12"></div>
				</div>
			</div>
		</div>
	</div> <!-- /.col-md-6 -->
</div>

<script type="text/javascript">
	$(document).ready(function () {
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
	    loadDataPrody();
	});

	function loadDataPrody()
	{
	    var url = base_url_js+"api/__getBaseProdiSelectOption";
	    $('#selectPrody').empty()
	    $.post(url,function (data_json) {
	          for(var i=0;i<data_json.length;i++){
	              var selected = (i==0) ? 'selected' : '';
	              //var selected = (data_json[i].RegionName=='Kota Jakarta Pusat') ? 'selected' : '';
	              $('#selectPrody').append('<option value="'+data_json[i].ID+'" '+selected+'>'+data_json[i].Name+'</option>');
	          }
	          $('#selectPrody').select2({
	             //allowClear: true
	          });
	    }).done(function () {
	      loadTableData();
	      $('#NotificationModal').modal('hide');
	    });
	}

	function loadTableData()
	{
		loading_page('#loadTableData');
		var url = base_url_js+'admission/proses-calon-mahasiswa/jadwal-ujian/set-nilai-ujian/pagination/'+page;
		var selectPrody = $("#selectPrody").find(':selected').val();
		var data = {
					selectPrody : selectPrody,
					};
		var token = jwt_encode(data,"UAP)(*");			
		$.post(url,{token:token},function (data_json) {
		    // jsonData = data_json;
		    var obj = JSON.parse(data_json); 
		    // console.log(obj);
		    setTimeout(function () {
	       	    $("#loadTableData").html(obj.loadTableData);
	            $("#pagination_link").html(obj.pagination_link);
		    },500);
		}).done(function() {
	      
	    }).fail(function() {
	      toastr.error('The Database connection error, please try again', 'Failed!!');;
	    }).always(function() {
	      // $('#btn-dwnformulir').prop('disabled',false).html('Formulir');
	    });
	}
</script>
