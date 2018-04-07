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
<div class="row" style="margin-top: 5px;">
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
                <!-- <div class = 'row'> -->
                	<div id= "loadtable"></div>
                <!-- </div> -->
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
  		    loadDataDataUjian(1);
	    })
	});	

	function loadDataDataUjian(page)
	{
		loading_page('#loadtable');
		var url = base_url_js+'admission/proses-calon-mahasiswa/jadwal-ujian/daftar-jadwal-ujian/pagination/'+page;
		var Nama = $("#Nama").val();
		var	FormulirCode = $("#FormulirCode").val();
		var data = {
					Nama : Nama,
					FormulirCode : FormulirCode,
					};
		var token = jwt_encode(data,"UAP)(*");			
		$.post(url,{token:token},function (data_json) {
		    // jsonData = data_json;
		    var obj = JSON.parse(data_json); 
		    // console.log(obj);
		    setTimeout(function () {
	       	    $("#loadtable").html(obj.loadtable);
	            $("#pagination_link").html(obj.pagination_link);
		    },1000);
		}).done(function() {
	      
	    }).fail(function() {
	      toastr.error('The Database connection error, please try again', 'Failed!!');;
	    }).always(function() {
	      // $('#btn-dwnformulir').prop('disabled',false).html('Formulir');
	    });
	}

	$(document).on("click", ".pagination li a", function(event){
	  event.preventDefault();
	  var page = $(this).data("ci-pagination-page");
	  loadDataDataUjian(page);
	});

    $(document).on("keyup", "#Nama", function(event){
    	var nama = $('#Nama').val();
    	var n = nama.length;
    	console.log(n);
    	if( this.value.length < 3 && this.value.length != 0 ) return;
    	   /* code to run below */
    	 loadDataDataUjian(1);
	  
	 });

    $(document).on("keyup", "#FormulirCode", function(event){
    	var nama = $('#FormulirCode').val();
    	var n = nama.length;
    	console.log(n);
    	if( this.value.length < 3 && this.value.length != 0 ) return;
    	   /* code to run below */
    	 loadDataDataUjian(1);
	  
	 });
</script>
