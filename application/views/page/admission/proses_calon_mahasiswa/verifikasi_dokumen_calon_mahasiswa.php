<div class="row" style="margin-top: 30px;">
	<div class="col-md-12">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-reorder"></i>Verifikasi Dokumen Calon Mahasiswa</h4>
			</div>
			<div class="widget-content">
				<div class = "row">	
					<div class="col-xs-2" style="">
						Tahun
						<select class="select2-select-00 col-md-4 full-width-fix" id="selectTahun">
						    <option></option>
						</select>
					</div>
					<div class="col-xs-2" style="">
						Nama
						<input class="form-control" id="Nama" placeholder="All..." "="">
					</div>
					<div class="col-xs-2" style="">
						Status
						<select class="select2-select-00 col-md-4 full-width-fix" id="selectStatus">
						    <option value= "Belum Done" selected>Belum Done</option>
						    <option value= "Done">Done</option>
						</select>
					</div>
					<div  class="col-xs-6" align="right" id="pagination_link"></div>	
					<!-- <div class = "table-responsive" id= "register_document_table"></div> -->
				</div>
				<br>	
				<div id= "register_document_table"></div>
			</div>
		</div>
	</div> <!-- /.col-md-6 -->
</div>

<script type="text/javascript">
	$(document).ready(function () {
		loadTahun();
	    loadData_register_document(1);
	});

	$(document).on('change','#selectStatus', function () {
    	loadData_register_document(1);
    });

    $(document).on('change','#selectTahun', function () {
    	loadData_register_document(1);
    });

    $(document).on("keyup", "#Nama", function(event){
    	var nama = $('#Nama').val();
    	var n = nama.length;
    	console.log(n);
    	if( this.value.length < 3 && this.value.length != 0 ) return;
    	   /* code to run below */
    	 loadData_register_document(1);
	  
	 });

	function loadData_register_document(page)
	{
		loading_page('#register_document_table');
		var url = base_url_js+'admission/proses-calon-mahasiswa/verifikasi-dokument/register_document_table/pagination/'+page;
		var selectTahun = $("#selectTahun").find(':selected').val();
		var NamaCandidate = $("#Nama").val();
		 if (NamaCandidate == '') {NamaCandidate = '%'};
		var selectStatus = $("#selectStatus").find(':selected').val();
		var data = {
					selectTahun : selectTahun,
					NamaCandidate : NamaCandidate,
					selectStatus : selectStatus,					
					};
		var token = jwt_encode(data,"UAP)(*");			
		$.post(url,{token:token},function (data_json) {
		    // jsonData = data_json;
		    var obj = JSON.parse(data_json); 
		    // console.log(obj);
		    setTimeout(function () {
	       	    $("#register_document_table").html(obj.register_document_table);
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
	  loadData_register_document(page);
	 });

	function loadTahun()
    {
        var startTahun = 2018;
        var thisYear = (new Date()).getFullYear();
        var selisih = parseInt(thisYear) - parseInt(startTahun);
        for (var i = 0; i <= selisih; i++) {
            var selected = (i==0) ? 'selected' : '';
            $('#selectTahun').append('<option value="'+ ( parseInt(startTahun) + parseInt(i) ) +'" '+selected+'>'+( parseInt(startTahun) + parseInt(i) )+'</option>');
        }
        $('#selectTahun').select2({
          // allowClear: true
        });

        $('#selectStatus').select2({
          // allowClear: true
        });
    }
</script>
